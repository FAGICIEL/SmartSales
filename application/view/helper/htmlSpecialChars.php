<?php
	//-----------------------------------------------------------------------------    
	//
	//	Translates some characters in HTML 
	//
	//-----------------------------------------------------------------------------   	
	function bbdHtmlSpecialChars( $html ){
		// e
		$html = str_replace ( 'é' , '&eacute;' , $html ) ;
		$html = str_replace ( 'è' , '&egrave;' , $html ) ;
		$html = str_replace ( 'ê' , '&ecirc;'  , $html ) ;
		$html = str_replace ( 'É' , '&Eacute;' , $html ) ;
		$html = str_replace ( 'ë' , '&euml;'   , $html ) ;
		// a
		$html = str_replace ( 'à' , '&agrave;' , $html ) ;
		$html = str_replace ( 'â' , '&acirc;'  , $html ) ;
		$html = str_replace ( 'À' , '&Agrave;' , $html ) ;
		$html = str_replace ( 'ã' , '&atilde;' , $html ) ;
		$html = str_replace ( 'ä' , '&auml;'   , $html ) ;
		$html = str_replace ( 'å' , '&aring;'  , $html ) ;
		$html = str_replace ( 'æ' , '&aelig;'  , $html ) ;
		// c
		$html = str_replace ( 'ç' , '&ccedil;' , $html ) ;
		$html = str_replace ( 'Ç' , '&Ccedil;' , $html ) ;
		$html = str_replace ( '©' , '&copy;'   , $html ) ;
		// o
		$html = str_replace ( 'ô' , '&ocirc;'  , $html ) ;
		$html = str_replace ( 'ò' , '&ograve;' , $html ) ;
		$html = str_replace ( 'ó' , '&oacute;' , $html ) ;
		$html = str_replace ( 'õ' , '&otilde;' , $html ) ;
		$html = str_replace ( 'ö' , '&ouml;'   , $html ) ;
		$html = str_replace ( 'ð' , '&eth;'    , $html ) ;
		// i
		$html = str_replace ( 'ì' , '&igrave;' , $html ) ;
		$html = str_replace ( 'í' , '&iacute;' , $html ) ;
		$html = str_replace ( 'ï' , '&iuml;'   , $html ) ;
		$html = str_replace ( 'î' , '&icirc;'  , $html ) ;
		// u
		$html = str_replace ( 'Ù' , '&Ugrave;' , $html ) ;
		$html = str_replace ( 'Ú' , '&Uacute;' , $html ) ;
		$html = str_replace ( 'Û' , '&Ucirc;'  , $html ) ;
		$html = str_replace ( 'Ü' , '&Uuml;'   , $html ) ;
		$html = str_replace ( 'û' , '&ucirc;'  , $html ) ;
		$html = str_replace ( 'ù' , '&ugrave;' , $html ) ;
		$html = str_replace ( 'ü' , '&uuml;'   , $html ) ;
		// y et autres ...
		$html = str_replace ( 'ý' , '&yacute;' , $html ) ;
		$html = str_replace ( 'ÿ' , '&yuml;'   , $html ) ;
		$html = str_replace ( 'Ý' , '&Yacute;' , $html ) ;
		$html = str_replace ( 'ñ' , '&ntilde;' , $html ) ;
		$html = str_replace ( 'þ' , '&thorn;'  , $html ) ;
		
		return stripslashes($html);
	  }
	  //--- Reverse
	  function bbdHtmlOriginalChars( $html ){
		// e
		$html = str_replace ( '&eacute;' , 'é' , $html ) ;
		$html = str_replace ( '&egrave;' , 'è' , $html ) ;
		$html = str_replace ( '&ecirc;'  , 'ê' , $html ) ;
		$html = str_replace ( '&Eacute;' , 'É' , $html ) ;
		$html = str_replace ( '&euml;'   , 'ë' , $html ) ;
		// a
		$html = str_replace ( '&agrave;' , 'à' , $html ) ;
		$html = str_replace ( '&acirc;'  , 'â' , $html ) ;
		$html = str_replace ( '&Agrave;' , 'À' , $html ) ;
		$html = str_replace ( '&atilde;' , 'ã' , $html ) ;
		$html = str_replace ( '&auml;'   , 'ä' , $html ) ;
		$html = str_replace ( '&aring;'  , 'å' , $html ) ;
		$html = str_replace ( '&aelig;'  , 'æ' , $html ) ;
		// c
		$html = str_replace ( '&ccedil;' , 'ç' , $html ) ;
		$html = str_replace ( '&Ccedil;' , 'Ç' , $html ) ;
		$html = str_replace ( '&copy;'   , '©' , $html ) ;
		// o
		$html = str_replace ( '&ocirc;'  , 'ô' , $html ) ;
		$html = str_replace ( '&ograve;' , 'ò' , $html ) ;
		$html = str_replace ( '&oacute;' , 'ó' , $html ) ;
		$html = str_replace ( '&otilde;' , 'õ' , $html ) ;
		$html = str_replace ( '&ouml;'   , 'ö' , $html ) ;
		$html = str_replace ( '&eth;'    , 'ð' , $html ) ;
		// i
		$html = str_replace ( '&igrave;' , 'ì' , $html ) ;
		$html = str_replace ( '&iacute;' , 'í' , $html ) ;
		$html = str_replace ( '&iuml;'   , 'ï' , $html ) ;
		$html = str_replace ( '&icirc;'  , 'î' , $html ) ;
		// u
		$html = str_replace ( '&Ugrave;' , 'Ù' , $html ) ;
		$html = str_replace ( '&Uacute;' , 'Ú' , $html ) ;
		$html = str_replace ( '&Ucirc;'  , 'Û' , $html ) ;
		$html = str_replace ( '&Uuml;'   , 'Ü' , $html ) ;
		$html = str_replace ( '&ucirc;'  , 'û' , $html ) ;
		$html = str_replace ( '&ugrave;' , 'ù' , $html ) ;
		$html = str_replace ( '&uuml;'   , 'ü' , $html ) ;
		// y et autres ...
		$html = str_replace ( '&yacute;' , 'ý' , $html ) ;
		$html = str_replace ( '&yuml;'   , 'ÿ' , $html ) ;
		$html = str_replace ( '&Yacute;' , 'Ý' , $html ) ;
		$html = str_replace ( '&ntilde;' , 'ñ' , $html ) ;
		$html = str_replace ( '&thorn;'  , 'þ' , $html ) ;
		
		return stripslashes($html);
	  }
	  
?>