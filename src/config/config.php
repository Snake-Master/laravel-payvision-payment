<?php

return [
    // 正式網關
    'produtionGateway' => 'https://processor.payvisionservices.com/Gatewayv2/BasicOperationsService.svc/json/',

    // 測試網關
    'developmentGateway' => 'https://testprocessor.payvisionservices.com/Gatewayv2/BasicOperationsService.svc/json/',
    
    // 是否啟用日誌
    'enableLog' => false,

    // payvision 商戶認證字段
    'memberId' => '',
    'memberGuid' => '',

    // 設置所屬國家和貨幣
    'country' => 'HKG',
    'currency' => 'HKD',

    // 測試用卡信息
    'developmentCardInfo' => [
        'amount' => 0.01,
        'cardNumber' => '4907639999990022',
        'cardExpiryYear' => '2020',
        'cardExpiryMonth' => '12',
        'cardCvv' => '029'
    ]
];