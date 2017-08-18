<?php
namespace Waterfox\Payvision\Service;

use Exception;
use Waterfox\Payvision\PayvisionException;
class BaseService {

    // 網關
    protected $_getWay = NULL;

    // 網關組合參數
    protected $_action = NULL;
    protected $_operation = NULL;
    protected $_parameters = [

        // 商家賬戶類型 - E-commerce
        'merchantAccountType' => 1
    ];

    protected $_requiredList = [];
    protected $_sendParamList = [];

    protected $_trackingMemberCode;

    // CA 文件路徑
    protected $_caCertificatesFile = NULL;

    // 返回結果屬性
    public $_responseArray = [];

    protected function __construct() {
        // 根據 debug 狀態切換網關
        if ( config('app.debug') ) {

            $this->_getWay = config(CONFIG_PREFIX.'developmentGateway');
        } else {

            $this->_getWay = config(CONFIG_PREFIX.'produtionGateway');
        }

        $this->_parameters['memberId'] = config(CONFIG_PREFIX.'memberId');
        $this->_parameters['memberGuid'] = config(CONFIG_PREFIX.'memberGuid');

        $this->_parameters['countryId'] = translatorCountry( config(CONFIG_PREFIX.'country') );
        $this->_parameters['currencyId'] = translatorCurrency( config(CONFIG_PREFIX.'currency') );

        if ( !function_exists('curl_init') ) {
            throw new PayvisionExecption( 'curl module not availble' );
        }
    }

    // 設置商戶信息
    public function setMemberIdAndMemberGuid( $_memberId = NULL, $_memberGuid = NULL ) {
        if( $_memberId ) {
            $this->_parameters['memberId'] = $_memberId;
        }

        if( $_memberGuid ) {
            $this->_parameters['memberGuid'] = $_memberGuid;
        }
    }

    // 設置商家賬戶類型
    public function setMerchantAccountType( $_merchantAccountType = NULL ) {
        if( $_merchantAccountType ) {

            $this->_parameters['merchantAccountType'] = $_merchantAccountType;
        }
    }

    // 設置所屬國家和貨幣ID
    public function setCountryIdAndCurrencyId( $_country = NULL, $_currency = NULL ) {
        if( $_countryId ) {
            $this->_parameters['countryId'] = translatorCountry( $_country );
        }

        if( $_currencyId ) {
            $this->_parameters['currencyId'] = translatorCurrency( $_currency );
        }
    }

    // 設置CA文件
    public function setCAFile() {

        if ( file_exists($file) ) {

            $this->_caCertificatesFile = $file;
        }

        return false;
    }

    public function call() {
        // 發送請求前 必填項檢查
        $this->_parameters = array_filter($this->_parameters);
        if( !empty( $diff = array_diff( $this->_requiredList, array_keys($this->_parameters) ) ) ) {

            throw new PayvisionException('有必填項未填寫: '.implode(', ', $diff));
        }

        if( is_null($this->_operation) ) {

            throw new PayvisionException('action 或 operationName 未指定');
        }

        // 發送請求前組合參數
        $param = array_intersect_key( $this->_parameters, array_flip($this->_sendParamList) );

        // 發送請求
        $response = $this->curlSend(json_encode($param));

        // 轉換結果为数组
        $response = json_decode($response, true);
        return $response;
    }

    // 設置TrackingMemberCode
    protected function setTrackingMemberCode( $_trackingMemberCode = NULL ) {
        if( $_trackingMemberCode ) {

            $this->_parameters['trackingMemberCode'] = $_trackingMemberCode;
        }
    }

    // 處理JSON數據
    public function processJsonResult( array $response ) {
        
        if ( isset($response['Result']) ) {

            $this->_responseArray['code'] = $response['Result'];
        }

        if ( isset($response['Message']) ) {

            $this->_responseArray['message'] = $response['Message'];
        }

        if ( isset($response['TrackingMemberCode']) ) {

            $this->_responseArray['trackingMemberCode'] = $response['TrackingMemberCode'];
        }

        if ( isset($response['TransactionId'])) {

            $this->_responseArray['transactionId'] = $response['TransactionId'];
        }

        if ( isset($response['TransactionGuid'])) {

            $this->_responseArray['transactionGuid'] = $response['TransactionGuid'];
        }

        if ( isset($response['TransactionDateTime'])) {

            $this->_responseArray['transactionDatetime'] = $response['TransactionDateTime'];
        }

        if ( isset($response['Cdc']) ) {

            if ( isset($response['Cdc']['Name']) ) {

                $this->_responseArray['cdcName'] = $response['Cdc']['Name'];
            }

            if ( isset($response['Cdc']['Items']) ) {

                foreach($response['Cdc']['Items'] as $item) {

                    $this->_responseArray['cdcData'][$item['Key']] = $item['Value'];
                }
            }
        }
    }

    // curl 發送網關請求
    protected function curlSend($param = []) {
        $url = $this->_getWay.urlencode($this->_operation);

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FORBID_REUSE => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($param)
            ]
        ];

        payvisionDebugLog('Payvision GetWay: '.$url);
        payvisionDebugLog('Payvision Param: '.$param);

        $ch = curl_init();

        curl_setopt_array($ch, $options);

        if ( $this->_caCertificatesFile ) {

            curl_setopt($ch, CURLOPT_CAINFO, $this->_caCertificatesFile);
        }

        if (!$result = curl_exec($ch)) {

            trigger_error(curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }
}