<?php
	function dateFormateFR ( $date, $time="" ) 
	{	
		$split = explode ( "-" , $date ) ;
	    $annee = $split [0] ;
	    $mois  = $split [1] ;
	    $jour  = $split [2] ;
	    $date  = $jour . "/" . $mois . "/" . $annee ;
	    return $date . " " . $time ;
	}
	function dateFormateEN ( $date, $time="" ) 
	{
		$split = explode ( "-" , $date ) ;
	    $annee = $split [2] ;
	    $mois  = $split [1] ;
	    $jour  = $split [0] ;
	    $date  = $annee . "/" . $mois . "/" . $jour ;
	    return $date . " " . $time ;
	}
	//
	function goodBdFormDate ($date)
	{
		$date = str_replace("/", "-", $date);
		$split = explode ( "-" , $date ) ;
	    $annee = $split [2] ;
	    $mois  = $split [1] ;
	    $jour  = $split [0] ;
	    $date  = $annee . "-" . $mois . "-" . $jour ;
	    return $date;
	}
	//
	function dateFormate($dateTime) {
		$splitDate = explode (" " , $dateTime) ;
		$date = $splitDate [0];
		$time = $splitDate [1];
		switch ($_SESSION ['lang']) {
			case 'fr' :
				$returnDate = dateFormateFR($date, $time);
				break;
			case 'en' :
				$returnDate = dateFormateEN($date, $time);
				break;
			default :
				$returnDate = dateFormateFR($date, $time);
				break;
		}
		return $returnDate;
	}
	//--- Date function
	function mdzDate($time=false) {
		if ($time) {
			return date ("Y-m-d H:i:s");
		}
		else {
			return date ("Y-m-d");
		}
	}
	//--- tiny date Format function
	function tinyDateFormat()
	{
		switch ($_SESSION ['lang']) {
			case 'fr' :
				$return = "%d/%m/%Y";
				break;
			case 'en' :
				$return = "%m/%d/%Y";
				break;
			default :
				$return = "%d/%m/%Y";
				break;
		}
		return $return;
	}
	//--- tiny time Format function
	function tinyTimeFormat()
	{
		switch ($_SESSION ['lang']) {
			case 'fr' :
				$return = "%H:%M:%S";
				break;
			case 'en' :
				$return = "%H:%M:%S";
				break;
			default :
				$return = "%H:%M:%S";
				break;
		}
		return $return;
	}
	//--- Nb Element Format
	function nbElementFormat ($elt, $nbDefault)
	{
		//--- à gérer en fonction de la langue choisie (le 0 en chinois par exemple)
		$length = strlen($elt);
		if ($length < $nbDefault)
		{
			//$elt = '0' . $elt;
		}
		return $elt;
	}
	/**
	  * VERY IMPORTANT FUNCTION TO PLAY TEMPLATE ROLE
	  */
	//---- Find motif and value
	function findPageContentMotif ($contentFile, $textFile, &$arrayContent)
	{
		require $textFile;
		/**
		 * Astuce : 
		 * On parcours le contenu à la recherche de motif et pour chaque motif trouvé,
		 * on enregistre son contenu pris dans le fichier de langue $textFile. On cree donc
		 * un tableau dont la clé est le motif et la valeur le texte
		 */
		$id_fichier  = fopen ($contentFile, "r");
		while ($ligne = fgets ($id_fichier, 1024))
		{
			//--- compter le nombre d'occurence du motif
			$countMotif = substr_count($ligne, "[[");
			if ($countMotif > 1)
			{
				for ($i = 1; $i <= $countMotif; $i++) 
				{
					//--- on extrait le motif et son nom
					$deb = "[[$i ";
					$end = " $i]]";
					$debutLien = strpos ($ligne, $deb) + strlen ($deb);
					$finLien   = strpos ($ligne, $end);
					$text	   = substr ($ligne, $debutLien, $finLien - $debutLien);
					//
					if ($i == 1) // si la premiere trouvaille, on cree la collection
					{
						$textHead = $text;
						$arrayContent [$text] = array(
							$i => array(
								'key' => $text,
								'text' => $contentLang [$text]
							)
						);
					}
					else // on enregistre dans la collection
					{
						$arrayContent [$textHead][$i] = array(
							'key' => $text,
							'text' => $contentLang [$text]
						);
					}
				}
			}
			elseif ($countMotif == 1)
			{
				//--- on extrait le motif et son nom
				$deb = '[[ ';
				$end = ' ]]';
				$debutLien = strpos ($ligne, $deb) + strlen ($deb);
				$finLien   = strpos ($ligne, $end);
				$text	   = substr ($ligne, $debutLien, $finLien - $debutLien);
				if (strlen($debutLien) > 0 && strlen($finLien) > 0) {
					$arrayContent[ $text ] = $contentLang [$text];
				}
			}
		}
		fclose($id_fichier);
	}
?>