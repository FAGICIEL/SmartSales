<?php
/**
 * @author : Marius V. TCHOUABE
 */
 if (strcmp($dSession ['state']['secondaire'], "bbdrss") == 0) {
 	$header = "";
 }
 else {
	 $header  = getLXHTML  ($dReponse ['header']);
	 if ($_GET ['action'] == 'share') 
	 {
	 	$header  = putInXHTML ('[[ajax header]]', '', $header);
	 }
	 else 
	 {
	 	 $headerStr = "
						<div id='ajaxformheader'>
							<p class='ajaxtitle' id='ajaxtitle'>".$dReponse ['ajax_section_title']."</p>
							<p id='fancyclose'><!-- ajax content close zone --></p>
						</div>
						";
	 	 $header  = putInXHTML ('[[ajax header]]', $headerStr, $header);
		 //$header  = putInXHTML ('<!-- ajax content title zone -->', $dReponse ['ajax_section_title'], $header);
		 if (! isset($dReponse ['no_close_button'])) {
		 	$header  = putInXHTML ('<!-- ajax content close zone -->' 
		 							, "<a href='#' id='closebox'>". $dReponse ['ajax_close_label']. "</a>", $header);
		 }
	 }
 }
 //--- content
 $content = getXHTML ( $dReponse ['viewModel']);
 $content = putInXHTML ( '<!-- ajax content zone -->', getXHTML ($dReponse ['content']), $content);
 $content = stripslashes ($content);
 //--- footer
 $footer  = getLXHTML ($dReponse ['footer']);
?>
