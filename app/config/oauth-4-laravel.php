<?php
return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '435206653312400',
            'client_secret' => '24d07c6a21b4123a3284ecc5d3abc520',
            'scope'         => array('email'),
        ),

        'Google' => array(
            'client_id'     => '220254980631-tbfkh6mbj4j9t0t88vb2inf36tsmbhjs.apps.googleusercontent.com',
            'client_secret' => 'rGnLfi4PSnwcDk3lcs_ZqZnc',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),      

    )

);