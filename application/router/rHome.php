<?php

/**
 * 	Routeur vers interface de connexion
 * 	@author TCHOUABE
 * 	2011
 */
require_once DIR_MODEL . 'CelSid.php';
$sid = new CelSid();
$res = $sid->fetch_row($sid->verifActiveSid($_SESSION ['USER_CODE']));
//--- test sur l existence d une session
if ($sid->getNumRows() > 0) {
    $dSession['state'] = array('principal' => 'connect', 'secondaire' => 'home'); // place l'appli dans l'etat connect
} else {
    $dSession['state'] = array('principal' => 'home', 'secondaire' => 'home');
}
?>