<?php
 class CelCode extends DbTable
 {
    private $_code ;
    private $_id ;
    //
    function __construct () 
    {
        $this -> _tableName = 'cel_code' ;
    }
    //
    function create () 
    {
        $data = array ('code', mdzDate(true));
        $this -> _tableFields = 'Cel_Code_id, Cel_Code_string, Cel_Code_date' ;
        $strData = '"","' ;
        foreach ( $data as $value ) 
        {
            $strData .= $value . '","' ;
        }
        $this -> _data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
        $this -> _id = $this -> getInsertId () ;
        //--- creation du code
        $this -> _code = ( int ) $this->_id . date('y') . date('m') . date('d') ;
    }
    //
    function getCode () 
    {
        return $this -> _code ;
    }
 }
?>