<?php
namespace Waterfox\Payvision\Service;

use Waterfox\Payvision\PayvisionException;

class PaymentService extends BaseService{

    public function __construct() {

        parent::__construct();

        $this->_operation = 'Payment';

        $this->setTrackingMemberCode('payment'.date('YmdHis'));

        $this->_sendParamList = [
            'memberId',
            'memberGuid',
            'countryId',
            'amount',
            'currencyId',
            'trackingMemberCode',
            'cardNumber',
            'cardholder',
            'cardExpiryMonth',
            'cardExpiryYear',
            'cardCvv',
            'merchantAccountType',
            'dbaName',
            'dbaCity',
            'avsAddress',
            'avsZip',
            'additionalInfo'
        ];

        $this->_requiredList = [
            'memberId',
            'memberGuid',
            'countryId',
            'amount',
            'currencyId',
            'trackingMemberCode',
            'cardNumber',
            'cardExpiryMonth',
            'cardExpiryYear',
            'merchantAccountType'
        ];
    }

    // 設置付款金額及貨幣單位
    public function setAmountAndCurrencyId ($amount, $currencyId = NULL) {

        if ( is_numeric($amount) && $amount > 0 ) {

            $this->_parameters['amount'] = $amount;

            if( $currencyId && ctype_digit($currencyId) ) {

                $this->_parameters['currencyId'] = $currencyId;
            }
        } else {

            throw new PayvisionException('付款金額 沒有設置 或 是無效值');
        }
    }

    // 設置卡號及持卡人
    public function setCardNumberAndHolder($cardNumber, $cardHolder = NULL) {

        $this->_parameters['cardNumber'] = $cardNumber;

        if ($cardHolder) {

            $this->_parameters['cardholder'] = $cardHolder;
        }
    }

    // 設置卡過期年月
    public function setCardExpiry($expirationYear, $expirationMonth) {
        if ( (int)$expirationYear && (int)$expirationMonth ) {

            $this->_parameters['cardExpiryYear'] = $expirationYear;
            $this->_parameters['cardExpiryMonth'] = $expirationMonth;
        } else {

            throw new PayvisionException('過期年月 沒有設置 或 是無效值');
        }
    }

    // 設置AVS郵政地址, AVS街道地址
    public function setAvsAddress ($avsAddress, $avsZip) {

        $this->_parameters['avsAddress'] = $avsAddress;
        $this->_parameters['avsZip'] = $avsZip;
    }
}