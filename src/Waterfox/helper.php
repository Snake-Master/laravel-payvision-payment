<?php

if( !function_exists('config') ) {

    // 設置/獲取配置文件的函數式實現
    function config($key = null, $default = null) {
        if (is_null($key)) {
            return app('config');
        }
    
        if (is_array($key)) {
            return app('config')->set($key);
        }
    
        return app('config')->get($key, $default);
    }
}

if( !function_exists('translatorCountry') ) {
    
    // 獲取國家代碼映射
    function translatorCountry( $key = null ) {
        $translations = [
            'AFG' => '004', //Afghanistan
            'ALA' => '248', //Åland Islands
            'ALB' => '008', //Albania
            'DZA' => '012', //Algeria
            'ASM' => '016', //American Samoa
            'AND' => '020', //Andorra
            'AGO' => '024', //Angola
            'AIA' => '660', //Anguilla
            'ATA' => '010', //Antarctica
            'ATG' => '028', //Antigua and Barbuda
            'ARG' => '032', //Argentina
            'ARM' => '051', //Armenia
            'ABW' => '533', //Aruba
            'AUS' => '036', //Australia
            'AUT' => '040', //Austria
            'AZE' => '031', //Azerbaijan
            'BHS' => '044', //Bahamas
            'BHR' => '048', //Bahrain
            'BGD' => '050', //Bangladesh
            'BRB' => '052', //Barbados
            'BLR' => '112', //Belarus
            'BEL' => '056', //Belgium
            'BLZ' => '084', //Belize
            'BEN' => '204', //Benin
            'BMU' => '060', //Bermuda
            'BTN' => '064', //Bhutan
            'BOL' => '068', //Bolivia, Plurinational State of
            'BES' => '535', //Bonaire, Sint Eustatius and Saba
            'BIH' => '070', //Bosnia and Herzegovina
            'BWA' => '072', //Botswana
            'BVT' => '074', //Bouvet Island
            'BRA' => '076', //Brazil
            'IOT' => '086', //British Indian Ocean Territory
            'BRN' => '096', //Brunei Darussalam
            'BGR' => '100', //Bulgaria
            'BFA' => '854', //Burkina Faso
            'BDI' => '108', //Burundi
            'KHM' => '116', //Cambodia
            'CMR' => '120', //Cameroon
            'CAN' => '124', //Canada
            'CPV' => '132', //Cape Verde
            'CYM' => '136', //Cayman Islands
            'CAF' => '140', //Central African Republic
            'TCD' => '148', //Chad
            'CHL' => '152', //Chile
            'CHN' => '156', //China
            'CXR' => '162', //Christmas Island
            'CCK' => '166', //Cocos (Keeling) Islands
            'COL' => '170', //Colombia
            'COM' => '174', //Comoros
            'COG' => '178', //Congo
            'COD' => '180', //Congo, the Democratic Republic of the
            'COK' => '184', //Cook Islands
            'CRI' => '188', //Costa Rica
            'CIV' => '384', //Côte d'Ivoire
            'HRV' => '191', //Croatia
            'CUB' => '192', //Cuba
            'CUW' => '531', //Curaçao
            'CYP' => '196', //Cyprus
            'CZE' => '203', //Czech Republic
            'DNK' => '208', //Denmark
            'DJI' => '262', //Djibouti
            'DMA' => '212', //Dominica
            'DOM' => '214', //Dominican Republic
            'ECU' => '218', //Ecuador
            'EGY' => '818', //Egypt
            'SLV' => '222', //El Salvador
            'GNQ' => '226', //Equatorial Guinea
            'ERI' => '232', //Eritrea
            'EST' => '233', //Estonia
            'ETH' => '231', //Ethiopia
            'FLK' => '238', //Falkland Islands (Malvinas)
            'FRO' => '234', //Faroe Islands
            'FJI' => '242', //Fiji
            'FIN' => '246', //Finland
            'FRA' => '250', //France
            'GUF' => '254', //French Guiana
            'PYF' => '258', //French Polynesia
            'ATF' => '260', //French Southern Territories
            'GAB' => '266', //Gabon
            'GMB' => '270', //Gambia
            'GEO' => '268', //Georgia
            'DEU' => '276', //Germany
            'GHA' => '288', //Ghana
            'GIB' => '292', //Gibraltar
            'GRC' => '300', //Greece
            'GRL' => '304', //Greenland
            'GRD' => '308', //Grenada
            'GLP' => '312', //Guadeloupe
            'GUM' => '316', //Guam
            'GTM' => '320', //Guatemala
            'GGY' => '831', //Guernsey
            'GIN' => '324', //Guinea
            'GNB' => '624', //Guinea-Bissau
            'GUY' => '328', //Guyana
            'HTI' => '332', //Haiti
            'HMD' => '334', //Heard Island and McDonald Islands
            'VAT' => '336', //Holy See (Vatican City State)
            'HND' => '340', //Honduras
            'HKG' => '344', //Hong Kong
            'HUN' => '348', //Hungary
            'ISL' => '352', //Iceland
            'IND' => '356', //India
            'IDN' => '360', //Indonesia
            'IRN' => '364', //Iran, Islamic Republic of
            'IRQ' => '368', //Iraq
            'IRL' => '372', //Ireland
            'IMN' => '833', //Isle of Man
            'ISR' => '376', //Israel
            'ITA' => '380', //Italy
            'JAM' => '388', //Jamaica
            'JPN' => '392', //Japan
            'JEY' => '832', //Jersey
            'JOR' => '400', //Jordan
            'KAZ' => '398', //Kazakhstan
            'KEN' => '404', //Kenya
            'KIR' => '296', //Kiribati
            'PRK' => '408', //Korea, Democratic People's Republic of
            'KOR' => '410', //Korea, Republic of
            'KWT' => '414', //Kuwait
            'KGZ' => '417', //Kyrgyzstan
            'LAO' => '418', //Lao People's Democratic Republic
            'LVA' => '428', //Latvia
            'LBN' => '422', //Lebanon
            'LSO' => '426', //Lesotho
            'LBR' => '430', //Liberia
            'LBY' => '434', //Libya
            'LIE' => '438', //Liechtenstein
            'LTU' => '440', //Lithuania
            'LUX' => '442', //Luxembourg
            'MAC' => '446', //Macao
            'MKD' => '807', //Macedonia, The Former Yugoslav Republic of
            'MDG' => '450', //Madagascar
            'MWI' => '454', //Malawi
            'MYS' => '458', //Malaysia
            'MDV' => '462', //Maldives
            'MLI' => '466', //Mali
            'MLT' => '470', //Malta
            'MHL' => '584', //Marshall Islands
            'MTQ' => '474', //Martinique
            'MRT' => '478', //Mauritania
            'MUS' => '480', //Mauritius
            'MYT' => '175', //Mayotte
            'MEX' => '484', //Mexico
            'FSM' => '583', //Micronesia, Federated States of
            'MDA' => '498', //Moldova, Republic of
            'MCO' => '492', //Monaco
            'MNG' => '496', //Mongolia
            'MNE' => '499', //Montenegro
            'MSR' => '500', //Montserrat
            'MAR' => '504', //Morocco
            'MOZ' => '508', //Mozambique
            'MMR' => '104', //Myanmar
            'NAM' => '516', //Namibia
            'NRU' => '520', //Nauru
            'NPL' => '524', //Nepal
            'NLD' => '528', //Netherlands
            'NCL' => '540', //New Caledonia
            'NZL' => '554', //New Zealand
            'NIC' => '558', //Nicaragua
            'NER' => '562', //Niger
            'NGA' => '566', //Nigeria
            'NIU' => '570', //Niue
            'NFK' => '574', //Norfolk Island
            'MNP' => '580', //Northern Mariana Islands
            'NOR' => '578', //Norway
            'OMN' => '512', //Oman
            'PAK' => '586', //Pakistan
            'PLW' => '585', //Palau
            'PSE' => '275', //Palestinian Territory, Occupied
            'PAN' => '591', //Panama
            'PNG' => '598', //Papua New Guinea
            'PRY' => '600', //Paraguay
            'PER' => '604', //Peru
            'PHL' => '608', //Philippines
            'PCN' => '612', //Pitcairn
            'POL' => '616', //Poland
            'PRT' => '620', //Portugal
            'PRI' => '630', //Puerto Rico
            'QAT' => '634', //Qatar
            'REU' => '638', //Réunion
            'ROU' => '642', //Romania
            'RUS' => '643', //Russian Federation
            'RWA' => '646', //Rwanda
            'BLM' => '652', //Saint Barthélemy
            'SHN' => '654', //Saint Helena, Ascension and Tristan da Cunha
            'KNA' => '659', //Saint Kitts and Nevis
            'LCA' => '662', //Saint Lucia
            'MAF' => '663', //Saint Martin (French part)
            'SPM' => '666', //Saint Pierre and Miquelon
            'VCT' => '670', //Saint Vincent and the Grenadines
            'WSM' => '882', //Samoa
            'SMR' => '674', //San Marino
            'STP' => '678', //Sao Tome and Principe
            'SAU' => '682', //Saudi Arabia
            'SEN' => '686', //Senegal
            'SRB' => '688', //Serbia
            'SYC' => '690', //Seychelles
            'SLE' => '694', //Sierra Leone
            'SGP' => '702', //Singapore
            'SXM' => '534', //Sint Maarten (Dutch part)
            'SVK' => '703', //Slovakia
            'SVN' => '705', //Slovenia
            'SLB' => '090', //Solomon Islands
            'SOM' => '706', //Somalia
            'ZAF' => '710', //South Africa
            'SGS' => '239', //South Georgia and the South Sandwich Islands
            'SSD' => '728', //South Sudan
            'ESP' => '724', //Spain
            'LKA' => '144', //Sri Lanka
            'SDN' => '729', //Sudan
            'SUR' => '740', //Suriname
            'SJM' => '744', //Svalbard and Jan Mayen
            'SWZ' => '748', //Swaziland
            'SWE' => '752', //Sweden
            'CHE' => '756', //Switzerland
            'SYR' => '760', //Syrian Arab Republic
            'TWN' => '158', //Taiwan, Province of China
            'TJK' => '762', //Tajikistan
            'TZA' => '834', //Tanzania, United Republic of
            'THA' => '764', //Thailand
            'TLS' => '626', //Timor-Leste
            'TGO' => '768', //Togo
            'TKL' => '772', //Tokelau
            'TON' => '776', //Tonga
            'TTO' => '780', //Trinidad and Tobago
            'TUN' => '788', //Tunisia
            'TUR' => '792', //Turkey
            'TKM' => '795', //Turkmenistan
            'TCA' => '796', //Turks and Caicos Islands
            'TUV' => '798', //Tuvalu
            'UGA' => '800', //Uganda
            'UKR' => '804', //Ukraine
            'ARE' => '784', //United Arab Emirates
            'GBR' => '826', //United Kingdom
            'USA' => '840', //United States
            'UMI' => '581', //United States Minor Outlying Islands
            'URY' => '858', //Uruguay
            'UZB' => '860', //Uzbekistan
            'VUT' => '548', //Vanuatu
            'VEN' => '862', //Venezuela, Bolivarian Republic of
            'VNM' => '704', //Viet Nam
            'VGB' => '092', //Virgin Islands, British
            'VIR' => '850', //Virgin Islands, U.S.
            'WLF' => '876', //Wallis and Futuna
            'ESH' => '732', //Western Sahara
            'YEM' => '887', //Yemen
            'ZMB' => '894', //Zambia
            'ZWE' => '716', //Zimbabwe
        ];
        if ( $key && isset($translations[$key]) ) {

            return $translations[$key];
        }
        return false;
    }
}

if( !function_exists('translatorCurrency') ) {
    
    // 獲取貨幣代碼映射
    function translatorCurrency($key = null) {
        $translations = [
            'AED' => '784', // United Arab Emirates dirham
            'AFN' => '971', // Afghan afghani
            'ALL' => '008', // Albanian lek
            'AMD' => '051', // Armenian dram
            'ANG' => '532', // Netherlands Antillean guilder
            'AOA' => '973', // Angolan kwanza
            'ARS' => '032', // Argentine peso
            'AUD' => '036', // Australian dollar
            'AWG' => '533', // Aruban florin
            'AZN' => '944', // Azerbaijani manat
            'BAM' => '977', // Bosnia and Herzegovina convertible mark
            'BBD' => '052', // Barbados dollar
            'BDT' => '050', // Bangladeshi taka
            'BGN' => '975', // Bulgarian lev
            'BHD' => '048', // Bahraini dinar
            'BIF' => '108', // Burundian franc
            'BMD' => '060', // Bermudian dollar (customarily known as Bermuda dollar)
            'BND' => '096', // Brunei dollar
            'BOB' => '068', // Boliviano
            'BOV' => '984', // Bolivian Mvdol (funds code)
            'BRL' => '986', // Brazilian real
            'BSD' => '044', // Bahamian dollar
            'BTN' => '064', // Bhutanese ngultrum
            'BWP' => '072', // Botswana pula
            'BYR' => '974', // Belarusian ruble
            'BZD' => '084', // Belize dollar
            'CAD' => '124', // Canadian dollar
            'CDF' => '976', // Congolese franc
            'CHE' => '947', // WIR Euro (complementary currency)
            'CHF' => '756', // Swiss franc
            'CHW' => '948', // WIR Franc (complementary currency)
            'CLF' => '990', // Unidad de Fomento (funds code)
            'CLP' => '152', // Chilean peso
            'CNY' => '156', // Chinese yuan
            'COP' => '170', // Colombian peso
            'COU' => '970', // Unidad de Valor Real
            'CRC' => '188', // Costa Rican colon
            'CUC' => '931', // Cuban convertible peso
            'CUP' => '192', // Cuban peso
            'CVE' => '132', // Cape Verde escudo
            'CZK' => '203', // Czech koruna
            'DJF' => '262', // Djiboutian franc
            'DKK' => '208', // Danish krone
            'DOP' => '214', // Dominican peso
            'DZD' => '012', // Algerian dinar
            'EGP' => '818', // Egyptian pound
            'ERN' => '232', // Eritrean nakfa
            'ETB' => '230', // Ethiopian birr
            'EUR' => '978', // Euro
            'FJD' => '242', // Fiji dollar
            'FKP' => '238', // Falkland Islands pound
            'GBP' => '826', // Pound sterling
            'GEL' => '981', // Georgian lari
            'GHS' => '936', // Ghanaian cedi
            'GIP' => '292', // Gibraltar pound
            'GMD' => '270', // Gambian dalasi
            'GNF' => '324', // Guinean franc
            'GTQ' => '320', // Guatemalan quetzal
            'GYD' => '328', // Guyanese dollar
            'HKD' => '344', // Hong Kong dollar
            'HNL' => '340', // Honduran lempira
            'HRK' => '191', // Croatian kuna
            'HTG' => '332', // Haitian gourde
            'HUF' => '348', // Hungarian forint
            'IDR' => '360', // Indonesian rupiah
            'ILS' => '376', // Israeli new shekel
            'INR' => '356', // Indian rupee
            'IQD' => '368', // Iraqi dinar
            'IRR' => '364', // Iranian rial
            'ISK' => '352', // Icelandic króna
            'JMD' => '388', // Jamaican dollar
            'JOD' => '400', // Jordanian dinar
            'JPY' => '392', // Japanese yen
            'KES' => '404', // Kenyan shilling
            'KGS' => '417', // Kyrgyzstani som
            'KHR' => '116', // Cambodian riel
            'KMF' => '174', // Comoro franc
            'KPW' => '408', // North Korean won
            'KRW' => '410', // South Korean won
            'KWD' => '414', // Kuwaiti dinar
            'KYD' => '136', // Cayman Islands dollar
            'KZT' => '398', // Kazakhstani tenge
            'LAK' => '418', // Lao kip
            'LBP' => '422', // Lebanese pound
            'LKR' => '144', // Sri Lankan rupee
            'LRD' => '430', // Liberian dollar
            'LSL' => '426', // Lesotho loti
            'LTL' => '440', // Lithuanian litas
            'LVL' => '428', // Latvian lats
            'LYD' => '434', // Libyan dinar
            'MAD' => '504', // Moroccan dirham
            'MDL' => '498', // Moldovan leu
            'MGA' => '969', // Malagasy ariary
            'MKD' => '807', // Macedonian denar
            'MMK' => '104', // Myanma kyat
            'MNT' => '496', // Mongolian tugrik
            'MOP' => '446', // Macanese pataca
            'MRO' => '478', // Mauritanian ouguiya
            'MUR' => '480', // Mauritian rupee
            'MVR' => '462', // Maldivian rufiyaa
            'MWK' => '454', // Malawian kwacha
            'MXN' => '484', // Mexican peso
            'MXV' => '979', // Mexican Unidad de Inversion (UDI) (funds code)
            'MYR' => '458', // Malaysian ringgit
            'MZN' => '943', // Mozambican metical
            'NAD' => '516', // Namibian dollar
            'NGN' => '566', // Nigerian naira
            'NIO' => '558', // Nicaraguan córdoba
            'NOK' => '578', // Norwegian krone
            'NPR' => '524', // Nepalese rupee
            'NZD' => '554', // New Zealand dollar
            'OMR' => '512', // Omani rial
            'PAB' => '590', // Panamanian balboa
            'PEN' => '604', // Peruvian nuevo sol
            'PGK' => '598', // Papua New Guinean kina
            'PHP' => '608', // Philippine peso
            'PKR' => '586', // Pakistani rupee
            'PLN' => '985', // Polish złoty
            'PYG' => '600', // Paraguayan guaraní
            'QAR' => '634', // Qatari riyal
            'RON' => '946', // Romanian new leu
            'RSD' => '941', // Serbian dinar
            'RUB' => '643', // Russian rouble
            'RWF' => '646', // Rwandan franc
            'SAR' => '682', // Saudi riyal
            'SBD' => '090', // Solomon Islands dollar
            'SCR' => '690', // Seychelles rupee
            'SDG' => '938', // Sudanese pound
            'SEK' => '752', // Swedish krona/kronor
            'SGD' => '702', // Singapore dollar
            'SHP' => '654', // Saint Helena pound
            'SLL' => '694', // Sierra Leonean leone
            'SOS' => '706', // Somali shilling
            'SRD' => '968', // Surinamese dollar
            'SSP' => '728', // South Sudanese pound
            'STD' => '678', // São Tomé and Príncipe dobra
            'SYP' => '760', // Syrian pound
            'SZL' => '748', // Swazi lilangeni
            'THB' => '764', // Thai baht
            'TJS' => '972', // Tajikistani somoni
            'TMT' => '934', // Turkmenistani manat
            'TND' => '788', // Tunisian dinar
            'TOP' => '776', // Tongan paʻanga
            'TRY' => '949', // Turkish lira
            'TTD' => '780', // Trinidad and Tobago dollar
            'TWD' => '901', // New Taiwan dollar
            'TZS' => '834', // Tanzanian shilling
            'UAH' => '980', // Ukrainian hryvnia
            'UGX' => '800', // Ugandan shilling
            'USD' => '840', // United States dollar
            'USN' => '997', // United States dollar (next day) (funds code)
            'USS' => '998', // United States dollar (same day) (funds code) (one source[who?] claims it is no longer used, but it is still on the ISO 4217-MA list)
            'UYI' => '940', // Uruguay Peso en Unidades Indexadas (URUIURUI) (funds code)
            'UYU' => '858', // Uruguayan peso
            'UZS' => '860', // Uzbekistan som
            'VEF' => '937', // Venezuelan bolívar fuerte
            'VND' => '704', // Vietnamese dong
            'VUV' => '548', // Vanuatu vatu
            'WST' => '882', // Samoan tala
            'XAF' => '950', // CFA franc BEAC
            'XAG' => '961', // Silver (one troy ounce)
            'XAU' => '959', // Gold (one troy ounce)
            'XBA' => '955', // European Composite Unit (EURCO) (bond market unit)
            'XBB' => '956', // European Monetary Unit (E.M.U.-6) (bond market unit)
            'XBC' => '957', // European Unit of Account 9 (E.U.A.-9) (bond market unit)
            'XBD' => '958', // European Unit of Account 17 (E.U.A.-17) (bond market unit)
            'XCD' => '951', // East Caribbean dollar
            'XDR' => '960', // Special drawing rights
            'XFU' => 'Nil', // UIC franc (special settlement currency)
            'XOF' => '952', // CFA franc BCEAO
            'XPD' => '964', // Palladium (one troy ounce)
            'XPF' => '953', // CFP franc
            'XPT' => '962', // Platinum (one troy ounce)
            'XTS' => '963', // Code reserved for testing purposes
            'XXX' => '999', // No currency
            'YER' => '886', // Yemeni rial
            'ZAR' => '710', // South African rand
            'ZMK' => '894', // Zambian kwacha
        ];
        if ( $key && isset($translations[$key]) ) {

            return $translations[$key];
        }
        return false;
    }
}

if( !function_exists('payvisionDebugLog') ) {

    // 記錄日誌方法
    function payvisionDebugLog($content = null) {
        if( config(CONFIG_PREFIX.'enableLog', false) && $content ) {
            \Log::info($content);
        }
    }
}