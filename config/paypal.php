<?php
return [
    /** set your paypal credential **/
    'client_id' => 'ASGpX7wk57hRc5ASnpFCH1lT5mG_MyNjX98pl0gpSh1WxYD7GPK_6S1Hj2E7Apc8p_tBktAkFKg0v3bx',
    'secret' => 'EElziy_LuPmP5upsPO4lUDI5ssIXYI7gMuzwpkZXBDlYVE1BLESREKNEluO0xhwx8bNGkvtfHy3W3Sp3',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
];