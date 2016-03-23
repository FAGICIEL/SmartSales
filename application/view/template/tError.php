<?php
 $content = getXHTML   ( $dReponse [ 'content' ] ) ;
 $content = putInXHTML ( '<!-- error title zone -->'   	, $dReponse [ 'sorry_msg' ]          , $content ) ;
 $content = putInXHTML ( '<!-- error message zone -->'  , $dReponse [ 'error_msg' ]          , $content ) ;
 $content = putInXHTML ( '<!-- goto zone -->'   		, $dReponse [ 'goto_msg' ]           , $content ) ;
 $content = putInXHTML ( '[[action zone]]'   			, $dReponse [ 'yetaction' ]			 , $content ) ;
 $content = putInXHTML ( '[[lang zone]]'   				, $dReponse['appLang']  	         , $content ) ;
 $content = bbdHtmlSpecialChars ($content);
 ?>