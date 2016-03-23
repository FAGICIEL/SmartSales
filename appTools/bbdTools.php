<?php
/**
 * Fichier des fonctions metiers
 * @author TCHOUABE
 */
 //--- safe 4 view
 function clean4Html ($saltValue)
 {
 	//$cleanValue = stripslashes (htmlentities(trim ($saltValue)));
 	$cleanValue = stripslashes (trim ($saltValue));
 	return $cleanValue;
 } 
 //--- safe 4 database
 function clean4sgbd ($saltValue)
 {
 	// On regarde si le type de string est un nombre entier (int)
	if (ctype_digit ($saltValue)) {
		$cleanValue = $saltValue;
	}
	// Pour tous les autres types
	else {
		//$cleanValue = addcslashes (mysql_real_escape_string (trim ($saltValue)), '%_');
		$cleanValue = addslashes (mysql_real_escape_string (trim ($saltValue)));
	}
	return $cleanValue;
 }
//-----------------------------------------------------------------------------    
//
//	Log 
//
//----------------------------------------------------------------------------- 
 function bbdLog( $message )
 {
	$fileName = LOG_FILE ;
	if ( file_exists ( $fileName ) && ( filesize ( $fileName ) > LOG_SIZE ) )
	{
            rename ( $fileName , $fileName . "_" . date ( "ymdHis" ) ) ;
            clearstatcache () ;	// in order to have a right size in the next filesize()
	}
	$timearray = explode ( " " , microtime() ) ;
	$milliseconds = floor( $timearray[0] * 1000 ) ;
	$message 	  = ">>>>>> ".date( "d/m/Y H:i:s" ) . "." . sprintf ( "%03d", $milliseconds ) . " - " . $message . "\n" ;
	@file_put_contents ( $fileName , $message , FILE_APPEND ) ;
 }	
 //
 function bbdAjaxLog( $message )
 {
	$fileName = AJAX_LOG_FILE ;
	if ( file_exists ( $fileName ) && ( filesize ( $fileName ) > LOG_SIZE ) )
	{
		rename ( $fileName , $fileName . "_" . date ( "ymdHis" ) ) ;
		clearstatcache () ;		// in order to have a right size in the next filesize()
	}
	$timearray 	  = explode ( " " , microtime() ) ;
	$milliseconds = floor( $timearray[0] * 1000 ) ;
	$message 	  = date( "d/m/Y H:i:s" ) . "." . sprintf ( "%03d", $milliseconds ) . " - " . $message . "\n" ;
	@file_put_contents ( $fileName , $message , FILE_APPEND ) ;
 }	
//------------------------
//----------
 function csrfAttack ( &$dConfig, &$dSession, $vAction )
 {
 	//--- Log 
 	bbdLog( '>>> bbdTools -> csrfAttack - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' .  $_SERVER [ 'REQUEST_URI' ] ) ;
    $mEtat 		   = $dSession ['state']['principal'];
    $sEtat 		   = $dSession ['state']['secondaire'];
    if (!isset ($mEtat)) {
    	$mEtat 	   = 'home';
    }
    if (!isset ($sEtat)) {
    	$sEtat 	   = 'home';
    }
    $permitactions = $dConfig ['s_controller'][$mEtat][$sEtat]['permitactions'];
    if (! isset ($_SESSION ['MDZ_CONNECT_USER_22'])) 
    {
    	$autorise 	   = in_array ($vAction, $permitactions) 
    						|| in_array ($vAction, $dConfig ['always'])
    						|| in_array ($vAction, $dConfig ['homeAlways'])
    						;
    }
    else 
    {
    	$autorise 	   = in_array ($vAction, $permitactions) 
    						|| in_array ($vAction, $dConfig ['always'])
    						|| in_array ($vAction, $dConfig ['connectAlways'])
    						;
    }
    return ! $autorise;
 }
//-----------------------------------
//-----------
 function doWork( &$dConfig, &$dReponse, &$dSession )
 {
    if ( @isset ( $dSession ) )
    {
        //  Enregistrer la requete dans la session
        $dSession [ 'query' ] = strtolower ( $_SERVER['REQUEST_METHOD'] ) == 'get' ? 
        							$_GET : strtolower ( $_SERVER [ 'REQUEST_METHOD' ] ) == 'post' ? $_POST : array();
        $_SESSION [ 'session' ] = serialize ( $dSession );
        session_write_close ();
    }
    else 
    {
        require_once DIR_MODEL . 'ClpSid.php';
        //-- destruction de la session
        $sess = new ClpSid();
        $data = array ('clp_sid_status' => DELETE_STATUS);
        $sess -> updateSession($data, $_SESSION ['USER_CODE']);
        //-- destruction de la session
        session_destroy();
    }
    //----------------------------------
    //----- Inclusion des templates
    require DIR_TEMPLATE . $dReponse [ 'state_template' ] ;
    require DIR_TEMPLATE . $dReponse [ 'template' ] ;
    require TEMPLATE_DEFAULT_FILE ; // inclusion du fichier de template partag�
    //--- renvoie de la page
    bbdLog( '<<< Sending generate page' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' .  $_SERVER [ 'REQUEST_URI' ] ) ;
    //return bbdHtmlSpecialChars($page) ;
    return $page ;
 }
//------------------------------------------------
// Get xhtml source code 
// @params : $filename and lang
//------------------------------------------------
 function getXHTML ( $filename )
 {
    return file_get_contents ( DIR_XHTML.$filename );
 }
 
 function getAjaxXHTML ( $filename )
 {
    return file_get_contents ( '../'.DIR_AJAX_XHTML . $filename );
 }
 
//--------------------------------------------------
// Get xhtml layout source code 
// @params : $filename and lang
//---------------------------------------------------
 function getLXHTML ( $filename )
 {
    return file_get_contents ( DIR_LAYOUT . $filename );
 }
//----------------------------------------------------
// Put content in xhtml source code 
// @params : $motif, $data and $source
//-----------------------------------------------------
 function putInXHTML ( $motif, $data, $source )
 {
    return str_replace ( $motif, $data, $source );
 }
//---------------------------------------------------------
//	Send email to client
//---------------------------------------------------------
 function sendEmail ( $sugject ,$message , $email ) 
 {
	$mail = new PHPMailer ( false ) ; // the true param means it will throw exceptions on errors, which we need to catch
 	$mail -> IsSMTP ( ); // telling the class to use SMTP
	try {
		$mail -> SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail -> SMTPAuth   = true;   
        $mail -> SMTPSecure = "ssl";  
    	// enable SMTP authentication
	    // sets the prefix to the servier
		$mail -> Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail -> Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail -> Username   = "tchouabe3b@gmail.com";  // GMAIL username
		$mail -> Password   = "mariuszs";            // GMAIL password
		$mail -> AddAddress ( $email, 'mindez' );
		$mail -> SetFrom('webmaster@mindez.fr', 'mindez');
		$mail -> Subject = $subject;
		$mail -> AltBody = 'To view the message, please use an HTML compatible email viewer!'; 
		// optional - MsgHTML will create an alternate automatically
		$mail -> MsgHTML ( $message ) ;
		$mail -> Send ( ) ;
		return true ;
	}
	catch (phpmailerException $e) 
	{
		//echo $e->errorMessage(); //Pretty error messages from PHPMailer
		return false ;
	} 
	catch (Exception $e) 
	{
		//echo $e->getMessage(); //Boring error messages from anything else!
		return false ;
	}
 }
//----------------------------------------------------
//
//
//----------------------------------------------------
 function is_Equal ( $str1, $str2 )
 {
 	return  strcasecmp ( $str1, $str2 ) ;
 }
//----------------------------------------------------
//
//
//----------------------------------------------------
 function isMinLength ( $str, $minlength = 0)
 {
 	return $minlength <= strlen ( $str ) ;
 }
//----------------------------------------------------
//
//
//----------------------------------------------------
 function isMaxLength ( $str, $maxlength = 1000)
 {
 	return strlen ( $str ) <= $maxlength ;
 }
//----------------------------------------------------
//
//
//----------------------------------------------------
 function is_Empty ( $str )
 {
 	return  isEmpty ( $str ) ;
 }
//----------------------------------------------------
//
//
//----------------------------------------------------
 function Begin ()
 {
 	mysql_query ( 'BEGIN' ) ;
 }
 function Rollback ()
 {
 	mysql_query ( 'ROLLBACK' ) ;
 }
 function Commit ()
 {
 	mysql_query ( 'COMMIT' ) ;
 }
 //
 //--- get Lang List function
 function getLangList ($lang='', $href='')
 {
 	$file = DIR_LISTE_LANG . '/lang_list.txt';
 	$id_fichier  = fopen ($file, "r");
 	$langList = '';
 	$i = 0;
 	if (empty($lang))
 	{
	 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
		 {
		 	$i++;
		 	$ligne = trim ($ligne);
		 	$ligne = explode (' ', $ligne);
		 	$nbElt = count($ligne);
		 	$langCode = $ligne[0];
		 	$langElt = '';
	 		for ($i = 1; $i < $nbElt; $i++)
	 			$langElt .= empty($langElt) ? $ligne[$i] : ' ' . $ligne[$i];
	 		if (empty($href))
		 		$langList .= '<a href="?action=home&amp;lang=' . $langCode . '">'  
	                                  . $langElt . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;
	        else 
	        	$langList .= '<a href="'.$href.'&amp;lang=' . $langCode . '">'  
	                                  . $langElt . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;
		 }
 	}
 	else 
 	{
	 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
		 {
		 	$i++;
		 	$ligne = trim ($ligne);
		 	$ligne = explode (' ', $ligne);
		 	$nbElt = count($ligne);
		 	$langCode = $ligne[0];
		 	//
		 	$langElt = '';
		 	if (strcasecmp($lang, $langCode) == 0)
		 	{
		 		for ($i = 1; $i < $nbElt; $i++)
		 			$langElt .= empty($langElt) ? $ligne[$i] : ' ' . $ligne[$i];
		 		$langList = $langElt;
		 		break;
		 	}
		 }
 	}
	fseek ($id_fichier, 0);
	fclose ($id_fichier); // fermeture du fichier
	return bbdHtmlSpecialChars($langList);
 }
 //--- get footer mention function
 function getFooterMention ($lang, $state, $pageTopMsg)
 {
 	$file = DIR_LISTE_LANG . $lang .DIR_SEPARATOR . 'footer_mention.txt';
 	$id_fichier  = fopen ($file, "r");
 	$mentionList = '';
 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
	{
	 	$ligne = trim ($ligne);
	 	$ligne = explode (' ', $ligne);
	 	$nbElt = count($ligne);
	 	$mentionCode = $ligne[0];
	 	//
	 	$mentionElt = '';
	 	for ($i = 1; $i < $nbElt; $i++)
	 		$mentionElt .= empty($mentionElt) ? $ligne[$i] : ' ' . $ligne[$i];
	 	$mentionList .= '<a href="?action=' . $mentionCode . '&amp;lang=' . $lang . '&amp;st=' 
 					 . $state . '">' . $mentionElt . '</a>&nbsp;&nbsp;';
	}
	//$mentionList .= '| <a href="#top"><img width="9" height="8" src="public/picture/system/top.gif" alt="" />&nbsp;'.$pageTopMsg.'</a>';
	fseek ($id_fichier, 0);
	fclose ($id_fichier); // fermeture du fichier
	return bbdHtmlSpecialChars ($mentionList);
 }
 //
 //--- gender options
 function getgenderOption ($genderCodeparam='')
 {
 	$lang = $_SESSION ['lang'];
 	$file = DIR_LISTE_LANG . $lang . '/gender_list.txt';
 	$id_fichier  = fopen ($file, "r");
 	$genderList = '';
 	$i = 0;
	 while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
	 {
	 	$i++;
	 	$ligne = trim ($ligne);
	 	$ligne = explode (' ', $ligne);
	 	$nbElt = count($ligne);
	 	// recuperation des loisirs du user
	 	$genderCode = $ligne[0];
	 	$gender = '';
	 	for ($i = 1; $i < $nbElt; $i++)
	 		$gender .= empty($gender) ? $ligne[$i] : ' ' . $ligne[$i];
	 	if (! empty($genderCodeparam))
	 	{
	 		if ($genderCodeparam == $genderCode)
	 			$selected = 'selected';
	 		else 
	 			$selected = '';
	 	}
	 	else 
	 	{
	 		if ($i == 0)
		 		$selected = 'selected';
		 	else 
		 		$selected = '';
	 	}
	 	$genderList .= '<option value="' . $genderCode . '" ' . $selected . '>' . $gender . '</option>';
	 }
	 fseek ($id_fichier, 0);
	 fclose ($id_fichier); // fermeture du fichier
	 return $genderList;
 }
 //
 function getGenderValue ($genderCodeSend, $image, $originalSexe)
 {
 	$lang = $_SESSION ['lang'];
 	$file = DIR_LISTE_LANG . $lang . '/gender_list.txt';
 	$id_fichier  = fopen ($file, "r");
 	$genderList = '';
 	//
 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
	{
	 	$ligne = trim ($ligne);
	 	$ligne = explode (' ', $ligne);
	 	$nbElt = count($ligne);
	 	// recuperation des loisirs du user
	 	$genderCode = $ligne[0];
	 	$genderValue = '';
	 	if (strcasecmp($genderCodeSend, $genderCode) == 0) {
	 		$originalSexe = $genderCodeSend ;
	 		if (strcasecmp($genderCode, "male") == 0)
			 	$image = NOIMAGEMALE;
	 		else
			 	$image = NOIMAGEMALE;
	 		for ($i = 1; $i < $nbElt; $i++)
	 			$genderValue .= empty($genderValue) ? $ligne[$i] : ' ' . $ligne[$i];
	 		break;
	 	}
	 }
	 fseek ($id_fichier, 0);
	 fclose ($id_fichier); // fermeture du fichier
	 return $genderValue;
 }
 //
 function getSexValue ($genderCodeSend)
 {
 	$lang = $_SESSION ['lang'];
 	$file = DIR_LISTE_LANG . $lang . '/sex_list.txt';
 	$id_fichier  = fopen ($file, "r");
 	$genderList = '';
 	//
 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
	{
	 	$ligne = trim ($ligne);
	 	$ligne = explode (' ', $ligne);
	 	$nbElt = count($ligne);
	 	// recuperation des loisirs du user
	 	$sexCode = $ligne[0];
	 	$sexValue = '';
	 	if (strcasecmp($genderCodeSend, $sexCode) == 0) {
	 		for ($i = 1; $i < $nbElt; $i++)
	 			$sexValue .= empty($genderValue) ? $ligne[$i] : ' ' . $ligne[$i];
	 		break;
	 	}
	 }
	 fseek ($id_fichier, 0);
	 fclose ($id_fichier); // fermeture du fichier
	 return $sexValue;
 }
 //--- sex options
 function getSexOption ($sexCodeparam='')
 {
 	$lang = $_SESSION ['lang'];
 	$file = DIR_LISTE_LANG . $lang . '/sex_list.txt';
 	$id_fichier  = fopen ($file, "r");
 	$sexList = '';
 	$i = 0;
	 while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
	 {
	 	$i++;
	 	$ligne = trim ($ligne);
	 	$ligne = explode (' ', $ligne);
	 	$nbElt = count($ligne);
	 	// recuperation des loisirs du user
	 	$sexCode = $ligne[0];
	 	$sex = '';
	 	for ($i = 1; $i < $nbElt; $i++)
	 		$sex .= empty($sex) ? $ligne[$i] : ' ' . $ligne[$i];
	 	if (! empty($sexCodeparam))
	 	{
	 		if ($sexCodeparam == $sexCode)
	 			$selected = 'selected';
	 		else 
	 			$selected = '';
	 	}
	 	else 
	 	{
	 		if ($i == 0)
		 		$selected = 'selected';
		 	else 
		 		$selected = '';
	 	}
	 	$sexList .= '<option value="' . $sexCode . '" ' . $selected . '>' . $sex . '</option>';
	 }
	 fseek ($id_fichier, 0);
	 fclose ($id_fichier); // fermeture du fichier
	 return $sexList;
 }
 //---
 function demNb () 
 {
 	/*$sysMonth = date ('n');
 	$file = DIR_LANG_JUST . DEM_NMF;
 	$id_fichier  = fopen ($file, "r");
 	if (! $id_fichier)
 	{
 		$id_fichier = fopen($file, "w");
 		if (fwrite($id_fichier, DEM_NUM) <= 0)
 		{
 			return true;
 		}
 	}
 	else 
 	{
	 	while ($ligne = fgets ($id_fichier, 1024)) // lecture d'une ligne du fichier
		{
		 	$month = trim ($ligne);
		 	if (($sysMonth - $month) >= DEM_NUM)
		 	{
		 		return true;
		 	}
		}
 	}*/
 	return false;
 }
 //----------------------------------------------------
 // int phone format
 //----------------------------------------------------
 function intPhoneFormat ($mobile, $indicatif="237", $longeurNumero="9") 
 {
    $Error = "";
    $phoneLength = strlen ($mobile);
    $indicatifLength = strlen($indicatif);
    $intMobileLength = $longeurNumero + $indicatifLength;
    //---
    if (is_numeric($mobile))
    {
        if ($phoneLength == $intMobileLength) //--- au format internationnal
        {
            $initials = substr($mobile, 0, $indicatifLength);
            if (strcmp($initials, $indicatif) != 0)
            {
                $Error = "ussd_badmobile_msg";
            }
        }
        else
        {
            if ($phoneLength == $longeurNumero)
            {
                $mobile = $indicatif . $mobile;
            }
            else
            {
                $Error = "ussd_badmobile_msg";
            }
        }
    }
    else
    {
        $Error = "ussd_badmobile_msg";
    }
    return $mobile."-".$Error;
 }
 //---------------------------------------------------
 // Retrouver l'indicatif du pays à partir d'un numéro internationnal
 //---------------------------------------------------
 function findCountryCodeByIntPhone($phoneNumber)
 {
     $CelCountry = new CelCountry();
     $phoneLength = strlen($phoneNumber);
     $findCountryCode = 0;
     //--- find 
     $celCountryRsl = $CelCountry->fetch_row($CelCountry->getByIntLehgth($phoneLength));
     if ($CelCountry->getNumRows() > 0)
     {
         foreach ($celCountryRsl as $item) 
         {
             $countryCode      = $item [1];
             $localPhoneLength = $item [2];
             $intPhoneLength   = $item [3];
             //---
             $pos = strpos($phoneNumber, $countryCode);
             if ($pos === false)
             {
                 continue;
             }
             else
             {
                 if ($pos == 0)
                 {
                     $findCountryCode = $countryCode;
                     break;
                 }
             }
         }
     }
     //---
     return $findCountryCode;
 }
 //---------------------------------------------------
 // Valider un numéro saisi par un utilisateur
 //---------------------------------------------------
 function validateUserEnteredPhone($benefPhoneNumber, $clientCountryCode)
 {
    $CelCountry = new CelCountry(); 
    $findCountryCode = 0;
    //--- get all user country phone number info
    $celCountryRsl = $CelCountry->fetch_row ($CelCountry->getOne($clientCountryCode));
    if ($CelCountry->getNumRows() > 0)
    {
        $countryCode             = $celCountryRsl [0][1];
        $countryLocalPhoneLength = $celCountryRsl [0][2];
        //---
        $phoneLength = strlen($benefPhoneNumber);
        if ($countryLocalPhoneLength == $phoneLength)
        {
            $findCountryCode  = $countryCode;
            $benefPhoneNumber = $countryCode . $benefPhoneNumber;
        }
        else //--- le numéro devrait être un numéro au format international dans ce cas
        {
            $celCountryRsl = $CelCountry->fetch_row ($CelCountry->getAll());
            foreach ($celCountryRsl as $item) 
            {
                $countryCode = $item [1];
                //--- test
                $pos = strpos($benefPhoneNumber, $countryCode);
                if ($pos !== false)
                {
                    if ($pos == 0)
                    {
                        $findCountryCode = $countryCode;
                        break;
                    }
                }
            }
        }
    }
    //---
    return $findCountryCode ."||-||". $benefPhoneNumber;
 }
 //----------------------------------------------------
 // locale phone format
 //----------------------------------------------------
 function localePhoneFormat ($mobile, $indicatif="237", $longeurNumero="9") 
 {
    $Error = "";
    $phoneLength = strlen ($mobile);
    $indicatifLength = strlen($indicatif);
    $intMobileLength = $longeurNumero + $indicatifLength;
    //---
    if (is_numeric($mobile))
    {
        if ($phoneLength == $intMobileLength) //--- au format internationnal
        {
            $mobile = substr($mobile, $indicatifLength, $longeurNumero);
        }
        else
        {
            if ($phoneLength != $longeurNumero)
            {
                $Error = "ussd_badmobile_msg";
            }
        }
    }
    else
    {
        $Error = "ussd_badmobile_msg";
    }
    return $mobile."-".$Error;
 }
 //----------------------------------------------------
 // phone control
 //----------------------------------------------------
 function phoneControl ($mobileNumber) 
 {
    //--- verification of mobile number format
    $phoneLength = strlen ($mobileNumber);
    $phoneFormatError = false;
    $phoneLengthError = false;
    switch ($phoneLength) 
    {
        case 9:
                break;
        case 14:
                $countryCode = substr ($mobileNumber, 0, 5);
                if ($countryCode != '00237') 
                {
                        $phoneFormatError = true;
                }
                break;
        default:
                $phoneLengthError = true;
                break;
    }
    //
    $retArray = array ('OK', $mobileNumber);
    if ($phoneLengthError || $phoneFormatError) 
    {
        if ($phoneFormatError) 
        {
                $message = 'phone_format_error';
                $retArray = array ('KO', $message);
        }
        else 
        {
                $message = 'phone_length_error';
                $retArray = array ('KO', $message);
        }
    }
    return $retArray;
 }
 
 function moneyView ($amount)
 {
     return number_format($amount, 0, ',', ' ');
 }
 
 function to_ascii ($string)
 {
     $ascii = NULL;
     for ($i=0; $i< strlen($string); $i++)
     {
         $ascii += ord($string [$i]);
     }
     return $ascii;
 }
 
function generateSecretCode($length="") 
{
    if (empty($length)) $length = 3;
    $SecretCode = "";
    while (strlen($SecretCode) < $length)
    {
        mt_srand();
        $val = mt_rand(0, 9);
        if (strlen($SecretCode) == 0 && $val == 0)
            continue;
        else
            $SecretCode .= $val;
    }
    return $SecretCode;
}

function encryptSecretCode ($code) 
{
    return md5(trim($code));
}
?>