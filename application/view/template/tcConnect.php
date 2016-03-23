<?php

/**
 * 
 */
if ($dSession ['state']['mode'] != AJAX_MODE) {
    //--- header
    $header = getLXHTML($dReponse['header']);
    //--- content
    $content = getXHTML($dReponse ['viewModel']);
    $content = putInXHTML('<!-- action menu zone -->', $_SESSION ['user_menu'], $content);
    $content = putInXHTML('<!-- action disconnect zone -->', $_SESSION ['logout_msg'], $content);
    $content = putInXHTML('<!-- activities zone -->', getXHTML($dReponse ['content']), $content);
    $content = putInXHTML('<!-- task tile zone -->', $dReponse ['task_title'], $content);
    $content = putInXHTML('[[cnx from]]', $dReponse ['lang']['cnx_from'], $content);
    $content = putInXHTML('[[cnx degree]]', $_SESSION ['USER_TYPE'], $content);
    $content = putInXHTML('[[find_product_msg]]', $dReponse ['lang']['find_product_label'], $content);
    $content = putInXHTML('<!-- product list msg zone -->', $dReponse ['lang']['product_list_msg'], $content);
    $content = putInXHTML('<!-- delevery list msg zone -->', $dReponse ['lang']['delevery_list_msg'], $content);
    $content = putInXHTML('<!-- destination list msg zone -->', $dReponse ['lang']['destination_list_msg'], $content);

    $content = putInXHTML('<!-- product add msg zone -->', $dReponse ['lang']['product_add_msg'], $content);
    $content = putInXHTML('<!-- delevery add msg zone -->', $dReponse ['lang']['delevery_add_msg'], $content);
    $content = putInXHTML('<!-- destination add msg zone -->', $dReponse ['lang']['destination_add_msg'], $content);
    //--------------------------------
    $content = bbdHtmlSpecialChars($content);
    //--- footer
    $footer = bbdHtmlSpecialChars(getLXHTML($dReponse['footer']));
    $footer = putInXHTML('[[Designed_by]]', $dReponse['lang']['Designed_by'], $footer);
} else {
    $content = bbdHtmlSpecialChars(getXHTML($dReponse ['content']));
}
?>