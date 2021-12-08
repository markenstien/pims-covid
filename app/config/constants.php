<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        // 'username' => '',
        // 'password' => '',
        // 'host'     => '',
        // 'name'     => '',
        // 'replyTo'  => '',
        // 'replyToName' => ''
    ];

    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'vidco-pims.xyz');

    define('COMPANY_NAME' , 'Covid Triage PIMS');

    define('KEY_WORDS' , '#############');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);


    
?>