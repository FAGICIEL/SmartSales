<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class FactureHasProduit extends DbTable 
{
    function __construct() 
    {
        $this->_tableName   = 'Facture_has_produit';
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'id,produit,facture';
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
    //	select facture data method
    function getOne ($id)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'id='.clean4sgbd($id) ;
        parent :: select ();
    }
    //	select person data method
    /*function getByClientCode ($clientCode)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'code LIKE "'.clean4sgbd($clientCode).'"' ;
        parent :: select ();
    }*/
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
?>