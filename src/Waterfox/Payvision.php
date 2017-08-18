<?php
namespace Waterfox\Payvision;

use Waterfox\Payvision\Service\PaymentService;
class Payvision {

    // 參數數組
    private $_paramters = [];
 
    private $_paymentService;
    public function __construct( PaymentService $paymentService ) {

        $this->_paymentService = $paymentService;
    }

    // 處理支付
    public function payment( $data = NULL ) {

        $data = $this->joinParam($data);

        if( $data['setCAFile'] ) {
            $this->_paymentService->setCAFile( $data['setCAFile'] );
        }

        if( config('app.debug') ) {

            $data = array_merge($data, config(CONFIG_PREFIX.'developmentCardInfo'));
        }

        $this->_paymentService->setMemberIdAndMemberGuid($data['memberId'], $data['memberGuid']);
        $this->_paymentService->setMerchantAccountType($data['merchantAccountType']);
        $this->_paymentService->setCountryIdAndCurrencyId($data['country'], $data['currency']);
        $this->_paymentService->setAmountAndCurrencyId($data['amount'], $data['currency']);
        $this->_paymentService->setCardNumberAndHolder($data['cardNumber'], $data['cardholder']);
        $this->_paymentService->setCardExpiry($data['cardExpiryYear'], $data['cardExpiryMonth']);
        $this->_paymentService->setAvsAddress($data['avsAddress'], $data['avsZip']);

        $response = $this->_paymentService->call();

        if( isset($response['PaymentResult']) ) {

            $this->_paymentService->processJsonResult($response['PaymentResult']);
            return $this->_paymentService->_responseArray;
        } else {

            return false;
        }
    }

    // 重复支付
    public function recurringPayment( $data = NULL ) {

        $data['merchantAccountType'] = 4;
        return $this->payment($data);
    }

    // 拼接参数数组
    private function joinParam() {
        if( is_null($data) ) {

            $data = $this->_paramters;
        } elseif( $this->_paramters ) {

            $data = array_merge($data, $this->_paramters);
        }
        return $data;
    }

    // 获取实例
    public function getInstace() {

        return $this;
    }

    public function __set($name, $value) {

        $this->_paramters[$name] = $value;
    }
}