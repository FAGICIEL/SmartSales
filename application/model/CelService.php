<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CelService extends DbTable
{
    function __construct() 
    {
        $this->_tableName = 'cel_service';
    }
    //---
    function save($data) 
    {
        $this -> _tableFields = 'Cel_Service_id, Cel_Service_code, Cel_Service_namecode, Cel_Service_codetype, Cel_Service_charged';
        $strData = '"","' ;
        foreach ($data as $value) 
        {
            $strData .= clean4sgbd($value) . '","';
        }
        $this->_data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
    }
    //	select data method
    function getOne ($celServiceCode)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'Cel_Service_code='.clean4sgbd($celServiceCode) ;
        parent :: select ();
    }
    //	select data method
    function getByNameCode ($celServiceNameCode)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'Cel_Service_namecode LIKE "'.clean4sgbd($celServiceNameCode).'"' ;
        parent :: select ();
    }
    //	select data method
    function getByType ($celServiceCodeType)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'Cel_Service_codetype='.clean4sgbd($celServiceCodeType) ;
        parent :: select ();
    }
    //--- update 
    function edit ($data, $celServiceCode) 
    {
        $strData = '';
        foreach ($data as $key => $value) 
        {
            $strData .= $key . '="' . clean4sgbd($value) . '",';
        }
        $this -> _data = substr ( $strData , 0 , strlen ( $strData ) - 1 ) ; // enlever la derniere virgule (,)
        $this -> _condition = 'Cel_Service_code=' . clean4sgbd($celServiceCode);
        $this -> _limit = '1';
        parent :: update ();
    }
}
?>
