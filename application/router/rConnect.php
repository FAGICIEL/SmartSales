<?php

/**
 * 	Routeur vers interface de connexion
 * 	@author TCHOUABE
 * 	2011
 */
require_once DIR_MODEL . 'CelPerson.php';
require_once DIR_MODEL . 'CelSid.php';
//---
$sess = new CelSid();
$CelPerson = new CelPerson ();
//--------------------------------------------------
//-------- Recup�ration des infos
$dReponse ['login'] = $_POST ['login'];
$dReponse ['passwd'] = $_POST ['password'];
//--------------------------------------------------
//-------- Recherche sur l'existence du user
$data = array('login' => $dReponse ['login'], 'passwd' => $dReponse ['passwd']);
$userInfo = $CelPerson->fetch_row($CelPerson->selectUser($data));
//--
if ($CelPerson->getNumRows() <= 0) {
    $dSession['state'] = array('principal' => 'home', 'secondaire' => 'home', 'status' => 'errorlogin');
    //--- Log 
    bbdLog('>>> User connect fail : login -- ' . $dReponse ['login'] . ' - ' . $_SERVER ['REMOTE_ADDR'] . ' - '
            . $_SERVER ['REQUEST_URI']);
} else {
    $_SESSION ['USER_CODE'] = $userInfo [0][1];
    $dSession['state'] = array('principal' => 'connect', 'secondaire' => 'home');
    //--- Log 
    bbdLog('>>> User connect success : login -- ' . $dReponse ['login'] . ' - '
            . $_SERVER ['REMOTE_ADDR'] . ' - ' . $_SERVER ['REQUEST_URI']);
}
?>