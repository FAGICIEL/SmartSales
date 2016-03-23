<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CelSmsOutbound extends DbTable
{
    
    function __construct() 
    {
        $this->_tableName = 'cel_smsoutbound';
    }
    //---
    function save($data) 
    {
        $this -> _tableFields = 'cel_smsoutbound_id, cel_smsoutbound_message, cel_smsoutbound_telexp, cel_smsoutbound_teldest
                                    , cel_smsoutbound_url, cel_smsoutbound_date, cel_smsoutbound_msgid, cel_smsoutbound_status, cel_operation_code';
        $strData = '"","' ;
        foreach ($data as $value) 
        {
            if (strcasecmp($value, "NULL") == 0)
            {
                $strData = substr ($strData, 0, strlen ($strData) - 1);
                $strData .= 'NULL' . ',"';
            }
            else
                $strData .= clean4sgbd($value) . '","';
        }
        $this->_data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
    }
}
?>
