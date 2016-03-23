<?php

//-------------------------------------------------------------------
//----- Tableau contenant la liste des routeurs et leur url
//---- Home
//--- GET
$dConfig ['router']['get:home'] = array('url' => 'rHome.php'); // accueil
//--- POST
//--- Connexion
//--- GET
$dConfig ['router']['get:homeconnect'] = array('url' => 'rHomeconnect.php'); // accueil connexion
$dConfig ['router']['get:logout'] = array('url' => 'rLogout.php'); // deconnexion
//--- POST
$dConfig ['router']['post:connect'] = array('url' => 'rConnect.php'); // connexion
//--- Other
$dConfig ['router']['get:mention'] = array('url' => 'rMention.php');
$dConfig ['router']['get:confident'] = array('url' => 'rConfident.php');
$dConfig ['router']['get:contact'] = array('url' => 'rContact.php');
$dConfig ['router']['get:team'] = array('url' => 'rTeam.php');
$dConfig ['router']['get:jobs'] = array('url' => 'rJobs.php');
$dConfig ['router']['get:apropos'] = array('url' => 'rApropos.php');
$dConfig ['router']['get:help'] = array('url' => 'rHelp.php');
$dConfig ['router']['error'] = array('url' => 'rError.php'); // action invalide
?>