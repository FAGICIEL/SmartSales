<?php

/**
 * 	Routeur vers interface de connexion
 * 	@author TCHOUABE
 * 	2011
 */
if (!isset($_SESSION ['MDZ_CONNECT_USER_22'])) {
    $masterState = 'home';
} else {
    $masterState = 'connect';
}
$dSession ['state'] = array('principal' => $masterState, 'secondaire' => 'error');
?>