<?php

/**
 * Ce fichier sert � fixer les parametres partag�s
 * entre tous les etats
 * @author : TCHOUABE
 * @since : 2011
 */
if (strcasecmp($dSession ['state']['mode'], 'ajaxform') != 0) // si on est pas dans l'etat ajaxform
    $dReponse ['appViewModel'] = $dConfig ['appviewmodel']['default']['url'];
else
    $dReponse ['appViewModel'] = $dConfig ['ajaxform']['default']['url'];
$dReponse ['lang'] = $bbdLang;
$dReponse ['appLang'] = $lang;
$dReponse ['footer_mention'] = '';
$dReponse ['appWelcome'] = $bbdLang ['welcome'];
//------------------------------------------------------------
//---------------- D�tection d'une erreur
if ($dSession ['state']['secondaire'] == 'error') {
    if (!isset($dReponse ['sorry_msg']))
        $dReponse ['sorry_msg'] = $bbdLang ['sorry_msg'];
    if (!isset($dReponse ['error_msg']))
        $dReponse ['error_msg'] = $bbdLang ['noaction_msg'];
    if (!isset($dReponse ['yetaction']))
        $dReponse ['yetaction'] = 'home';
    if (!isset($dReponse ['goto_msg']))
        $dReponse ['goto_msg'] = $bbdLang ['back_msg'];
}
//--------------------------------------------------------------
//----------- Construction de la chaine de mention
$dReponse['footer_mention'] = getFooterMention($lang, $dSession ['state']['principal'], $bbdLang ['pagetop_msg']);
//--------------------------------------------------------------
//----------- inclusion du controlleur d'etat
if (strcasecmp($dSession ['state']['mode'], 'ajaxform') != 0) // si on est pas dans l'etat ajaxform 
    $state = $dSession ['state']['principal'];
else
    $state = $dSession ['state']['mode'];
require DIR_CONTROLLER . $dConfig ['controller'][$state]['url'];
?>