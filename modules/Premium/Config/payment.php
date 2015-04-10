<?php
/**
 * no hesitation, those information are either accessible
 * for anyone anyway or they are sandbox only
 */
return [

    'contact' >= [

        'mail' => 'payments@rising-gods.de',

    ],

    'providers' => [

        /**
         * PAYPAL PAYMENT PROVIDER
         */
        'paypal' => [
            'enabled' => true,

            'client_id' => 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',
            'client_secret' => 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL',

        ],

        /**
         * PAYSAFE PAYMENT PROVIDER
         */
        'paysafe' => [
            'enabled' => true,

            'endpoint' => 'https://cashpay.cashrun.com/risinggods/psc/psc_start.php',
        ],

        /**
         * MICROPAYMENT PAYMENT PROVIDER
         */
        'micropayment' => [
            'enabled' => true,
        ],

        /**
         * BITCOIN PAYMENT PROVIDER
         */
        'bitcoin' => [
            'enabled' => true,

            'address' => '1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms',
            'code_url' => 'https://blockchain.info/de/qr?data=1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms&size=200'
        ],

        /**
         * DIRECT DEBIT PAYMENT PROVIDER
         */
        'giropay' => [
            'enabled' => true,

            // you can use :user_id for the user id
            'purpose' => 'RG Premium: :user_id',

            'bank' => [
                'name' => 'Volksbank Sauerland eG',
                'bic' => 'GENODEM1NEH',
                'code' => '46660022',
            ],

            'account' => [
                'holder' => 'Rising-Gods UG (haftungsbeschränkt)',
                'iban' => 'DE10466600223514553300',
                'number' => '3514553300',
            ],

        ],

    ],
];