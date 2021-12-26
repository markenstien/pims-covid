<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => 'super@vidco-pims.xyz',
        'password' => 'u8BK++k}4l9x',
        'host'     => 'vidco-pims.xyz',
        'name'     => 'Covid Triage',
        'replyTo'  => 'super@vidco-pims.xyz',
        'replyToName' => 'Covid Triage'
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

    define('COMPANY_NAME' , 'Covid Triage');

    define('KEY_WORDS' , 'BEST COVID APP');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);


    define('APP_KEY' , 'COVID-PIMS-5175140471');
    
?>