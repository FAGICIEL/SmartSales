<?php

/**
 * Fichier de gestionnaire de template de l'�tat Home de l'application
 * @author : TCHOUABE
 * @since : 2011
 */
$content = putInXHTML('[[signin_msg]]', $dReponse ['lang']['signin_msg'], $content);
$content = putInXHTML('[[signinbtn_msg]]', $dReponse ['lang']['signinbtn_msg'], $content);
$content = putInXHTML('[[login]]', $dReponse ['lang']['login'], $content);
$content = putInXHTML('[[password]]', $dReponse ['lang']['password'], $content);
$content = putInXHTML('[[login_val]]', $dReponse ['login'], $content);
$content = putInXHTML('[[error_login]]', $dReponse ['error_login'], $content);
//
$content = stripslashes($content);
?>