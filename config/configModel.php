<?php

//------------------------------------------
//------ Parametres de BD
$bbdParamDB = array(
    'dev' => array(
        'host' => HOST_DEV_NAME,
        'user' => USER_DEV_VALUE,
        'pass' => PWD_DEV_VALUE,
        'name' => DB_DEV_DBNAME,
        'erep' => 'E_ALL | E_STRICT',
        'derr' => '1',
        'ussd_server_host' => 'http://localhost:7000/ussd/send'
    ),
    'prod' => array(
        'host' => HOST_PROD_NAME,
        'user' => USER_PROD_VALUE,
        'pass' => PWD_PROD_VALUE,
        'name' => DB_PROD_DBNAME,
        'erep' => 'E_ALL | E_STRICT',
        'derr' => '0',
        'ussd_server_host' => 'https://api.dialog.lk/ussd/send'
    )
);
?>