<?php

/**
 * 	Controlleur frontal de l'application
 * 	@author TCHOUABE
 * 	28/05/2011
 */
//----------------------------------------------------------------
//------ Recuperation de l'action demandée par l'utilisateur
//------- Traitement sur le tableau GET
$action = $_GET ['action'];
if (!key_exists('srm', $_GET)) {
    $sAction = $_GET ['action'] ? strtolower($_GET ['action']) : 'home';
} else {
    $_SERVER ['REQUEST_METHOD'] = $_GET ['srm'];
    $sAction = $_GET ['action'];
}
$vAction = strtolower($_SERVER ['REQUEST_METHOD']) . ':' . $sAction;
//----------------------------------------------------------------
//-------- Test sur l'enchainement des actions ( failles CSRF )
if (csrfAttack($dConfig, $dSession, $vAction)) {
    $vAction = 'get:home';
}
//--- Log
bbdLog('<<< Action result : ' . $vAction . ' - ' . $_SERVER ['REMOTE_ADDR'] . ' - ' . $_SERVER ['REQUEST_URI']);
if (isset($_SESSION ['MDZ_CONNECT_USER_22'])) {
    if (strcasecmp($vAction, "get:home") == 0) {
        $vAction = "get:connect";
    } elseif (strcasecmp($vAction, "post:home") == 0) {
        $vAction = "post:connect";
    }
}
//----------------------------------------------------------------
//-----	Recuperation du script d'action associé à l'action
$sRouter = $dConfig ['router'][$vAction] ?
        $dConfig ['router'][$vAction]['url'] : $dConfig ['router']['error']['url'];
require DIR_ROUTER . $sRouter;
//--- Log 
bbdLog('--- Router : ' . $sRouter . ' - ' . $_SERVER ['REMOTE_ADDR'] . ' - ' . $_SERVER ['REQUEST_URI']);
//------------------------------------------------------------------
//------------ On appelle le controlleur par defaut
require CONTROLLER_DEFAULT_FILE;
//--- Log 
bbdLog('--- Default controller file included - ' . $_SERVER ['REMOTE_ADDR'] . ' - ' . $_SERVER ['REQUEST_URI']);
//---------------------------------------------------------------
//------- Lancer la generation de la r�ponse
if ($_SESSION ['DISCONNECT']) {
    $page = doWork($dConfig, $dReponse);
} else {
    $page = doWork($dConfig, $dReponse, $dSession);
}
//--- resultat
echo $page;
?>