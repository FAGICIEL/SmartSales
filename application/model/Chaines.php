<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Chaines extends DbTable 
{
    function __construct() 
    {
        $this->_tableName   = 'chaines';
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'id, type_de_chaine,nom,prix,statut';
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
    //	select chaines data method
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
?>