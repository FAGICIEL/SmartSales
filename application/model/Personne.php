<?php
/**
 * @author TCHOUABE
 * 09 mars 2015
 */
class Personne extends DbTable
{
    //	construct
    function __construct () 
    {
        $this->_tableName   = 'personne' ;
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'id, adresse, nom, prenom, sexe, dateNaissance, autre, nationalite, date_enregistrement';
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
?>