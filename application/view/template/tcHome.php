<?php

/**
 * 
 */
$header = getLXHTML($dReponse['header']);
$header = putInXHTML('<!-- email zone -->', $dReponse['msg_email_login'], $header);
$header = putInXHTML('<!-- password zone -->', $dReponse['msg_password_login'], $header);
$header = putInXHTML('[[lang zone]]', $dReponse['appLang'], $header);
$header = putInXHTML('<!-- session guard zone -->', $dReponse['msg_session_guard'], $header);
$header = putInXHTML('<!-- password forgotten zone -->', $dReponse['msg_password_forgotten'], $header);
$header = putInXHTML('<!-- error login zone -->', $dReponse ['error_login'], $header);
$header = putInXHTML('[[connect button]]', $dReponse['msg_connect_button'], $header);
$header = bbdHtmlSpecialChars($header);
//--- content
$content = bbdHtmlSpecialChars(getXHTML($dReponse ['content']));
//--- footer
$footer = bbdHtmlSpecialChars(getLXHTML($dReponse['footer']));
$footer = putInXHTML('[[Designed_by]]', $dReponse['lang']['Designed_by'], $footer);
?>