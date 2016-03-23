<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abonnement
 *
 * @author AMADOU BAKARI
 */
class Abonnement extends DbTable 
{
    function __construct() 
    {
        $this->_tableName = "abonnement";
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'id, client, mode_payement, compte, formule, commercial, kit_abonnement, utilisateur, date_abonnement, date_debut';
        $strData = '"","' ;
        foreach ($data as $value) 
        { 
            if (strcasecmp($value, "NULL") == 0)
            {
                $strData = substr ($strData, 0, strlen ($strData) - 1);
                $strData .= 'NULL' . ',"';
            }
            else
            {
                $strData .= clean4sgbd($value) . '","';
            }
        }
        $this->_data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
    }
    //----
    function getOne ($id) 
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'id='.clean4sgbd($id) ;
        parent :: select ();
    }
    //--- update 
    function edit ($data, $id) 
    {
        $strData = '';
        foreach ($data as $key => $value) 
        {
            $strData .= $key . '="' . clean4sgbd($value) . '",';
        }
        $this -> _data = substr ( $strData , 0 , strlen ( $strData ) - 1 ) ; // enlever la derniere virgule (,)
        $this -> _condition = 'id=' . clean4sgbd($id);
        $this -> _limit = '1';
        parent :: update ();
    }
    
}
