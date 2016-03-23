<?php
/**
 * @author TCHOUABE
 * 09 mars 2015
 */
class Utilisateur extends DbTable
{
    //	construct
    function __construct () 
    {
        $this->_tableName   = 'utilisateur' ;
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'id, personne, profil, login, password';
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
    //	select data method
    function getByCredentials ($data)
    {
        $_tables = 'personne p, '.$this->_tableName.' u';
        $this->_tableFields = 'p.*, u.statut' ;
        $this->_condition   = 'u.login LIKE "'.clean4sgbd($data ['login']).'" 
                                AND u.password LIKE "'.  encryptSecretCode($data ['password']).'" AND p.id=u.personne' ;
        parent :: select ($_tables);
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