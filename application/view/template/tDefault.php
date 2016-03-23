<?php

/**
 * Fichier de gestionnaire de template par d�faut de l'application
 * @author : TCHOUABE
 * @since : 2011
 */
if ($dSession ['state']['mode'] != AJAX_MODE) {
    $page = getXHTML($dReponse ['appViewModel']);
    $page = putInXHTML('[[advert zone]]', "", $page);
    $page = putInXHTML('[[div bg]]', $dReponse ['divbg'], $page);
    $page = putInXHTML('[[allWidth]]', $dReponse ['allWidth'], $page);
    $page = putInXHTML('[[listlang]]', $dReponse ['listlang'], $page);
    if (strcasecmp($dSession ['state']['principal'], 'connect') != 0) { // si connecté
        $page = putInXHTML('[[div id]]', 'nodiv', $page);
        $page = putInXHTML('[[advert zone]]', "", $page);
    }
    //
    if (empty($dReponse ['task_title'])) {
        $title = $dReponse ['lang']['welcome_intro'] . ' ' . $dReponse ['appWelcome'];
    } else {
        if (!strstr($dReponse ['task_title'], 'href')) {
            $title = $dConfig ['appName'] . ' | ' . $dReponse ['task_title'];
        } else {
            $title = $dConfig ['appName'] . ' | ' . $dReponse ['appWelcome'];
        }
    }
    //
    $page = putInXHTML('<!-- application name zone -->', $title, $page);
    //--- header
    $page = putInXHTML('<!-- header zone -->', $header, $page);
    //--- content
    $page = putInXHTML('<!-- content zone -->', $content, $page);
    $page = putInXHTML('[[body]]', $dReponse ['bodyId'], $page);
    //
    $page = putInXHTML('<!-- traduction msg zone -->', $dReponse ['traduction_msg'], $page);
    $page = putInXHTML('<!-- lang zone -->', $dReponse ['list_lang'], $page);
    //--- footer
    $footer = putInXHTML('<!-- footer metion zone -->', $dReponse ['footer_mention'], $footer);
    $page = putInXHTML('<!-- footer zone -->', $footer, $page);
    //
    $page = putInXHTML('[[product list search autocomplete]]', $_SESSION ['face_autocomplete_search_friend_list'], $page);
    //
    $page = putInXHTML("[[lang]]", $_SESSION['lang'], $page);
    $page = putInXHTML("[[appName]]", $dConfig['appName'], $page);
    $page = putInXHTML("[[MAIN_DOMAIN_VALUE]]", MAIN_DOMAIN_VALUE, $page);
} else {
    $page = putInXHTML("[[appName]]", $dConfig['appName'], $page);
}
?>