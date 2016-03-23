<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CelSid extends DbTable 
{
    public $longueur = 8;
    public $session_duration = 3600; // 1 heure
    public $sid;

    //
    function __construct() 
    {
        $this->_tableName =  'cel_sid';
    }
    //
    function verifActiveSid ($userCode) 
    {
        $this->_tableFields = 'Cel_Person_code, Cel_Sid_id, Cel_Sid_session_id';
        $this->_condition   = "Cel_Person_code=".clean4sgbd($userCode)." AND Cel_Sid_status LIKE '".ACTIVE_STATUS."'";
        parent :: select ();
    }
    //
    function verifSid () 
    {
        $this->_tableFields = 'Cel_Person_code';
        $this->_condition   = 'Cel_Sid_id LIKE "'.  clean4sgbd($this->sid).'" AND Cel_Sid_status LIKE "'.ACTIVE_STATUS.'"';
        parent :: select ();
    }
	//
    function isConnected ($userCode) 
    {
        $this->_tableFields = '*';
        $this->_condition   = 'Cel_Person_code='.  clean4sgbd($userCode).' AND Cel_Sid_status LIKE "'.ACTIVE_STATUS.'"';
        $this->_group = 'Cel_Person_code';
        parent :: select ();
    }
    //
    function create ($userCode) 
    {
      $Pool = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $ok = false;
      // Generation d'un identifiant unique
      while (!$ok) 
      {
        $this->sid = "";
        for ($index = 0; $index < $this->longueur; $index++)
          $this->sid .= substr($Pool, (mt_rand()%(strlen($Pool))), 1);
        $this->verifSid();
        $ok = ($this->getNumRows() == 0);
      }
      // Enregistrement de la session
      $data = array ($this->sid, @session_id(), date("Y-m-d H:i:s", time()), $userCode);
      $this->save($data);
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'Cel_Sid_id, Cel_Sid_session_id, Cel_Sid_last_maj, Cel_Person_code';
        $strData = '"","' ;
        foreach ($data as $value) 
        {
            $strData .= clean4sgbd($value) . '","';
        }
        $this->_data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
    }
    //--- update 
    function updateSession ($data, $userCode) 
    {
        $strData = '';
        foreach ($data as $key => $value) 
        {
            $strData .= $key . '="' . clean4sgbd($value) . '",';
        }
        $this -> _data = substr ( $strData , 0 , strlen ( $strData ) - 1 ) ; // enlever la derniere virgule (,)
        $this -> _condition = 'Cel_Person_code=' . clean4sgbd($userCode) . ' AND Cel_Sid_status LIKE "'.ACTIVE_STATUS.'"';
        //$this -> _limit = '1' ;
        parent :: update ();
    }
}
?>
