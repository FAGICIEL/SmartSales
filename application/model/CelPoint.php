<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CelPoint extends DbTable
{
    function __construct() 
    {
        $this->_tableName = 'cel_point';
    }
    //
    function save ($data) 
    {
        $this -> _tableFields = 'Cel_Point_id, Cel_Point_code, Cel_Point_name, Cel_Point_address, Cel_Point_bp, Cel_Point_phone, Cel_Point_indicatif, Cel_Point_creationdate, Cel_Partner_code';
        $strData = '"","' ;
        foreach ($data as $value) 
        {
            $strData .= clean4sgbd($value) . '","';
        }
        $this->_data = substr ($strData, 0, strlen ($strData) - 2);
        parent :: insert ();
    }
    //	select data method
    function getOne ($celPointCode)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'Cel_Point_code='.clean4sgbd($celPointCode) ;
        parent :: select ();
    }
    //	select data method
    function getSMSProviderPointCode ()
    {
        $tables = $this->_tableName .' po, cel_partner pa';
        $this->_tableFields = 'po.Cel_Point_code' ;
        $this->_condition   = 'po.Cel_Partner_code=pa.Cel_Partner_code AND pa.Cel_Partner_codetype LIKE "'.clean4sgbd(SMS_PROVIDER_CODE_TYPE).'"' ;
        parent :: select ($tables);
    }
    //	select data method
    function getProviderPointCode ()
    {
        $tables = $this->_tableName .' po, cel_partner pa';
        $this->_tableFields = 'po.Cel_Point_code' ;
        $this->_condition   = 'po.Cel_Partner_code=pa.Cel_Partner_code AND pa.Cel_Partner_codetype LIKE "'.clean4sgbd(PROVIDER_CODE_TYPE).'"' ;
        parent :: select ($tables);
    }
    //	select data method
    function getServiceProviderPointCode ($partnerCode)
    {
        $tables = $this->_tableName .' po, cel_partner pa, cel_account a';
        $this->_tableFields = 'pa.Cel_Partner_name, a.Cel_Account_code, a.Cel_Point_code' ;
        $this->_condition   = 'po.Cel_Partner_code=pa.Cel_Partner_code 
                                AND po.Cel_Point_code=a.Cel_Point_code 
                                AND pa.Cel_Partner_code = '.  clean4sgbd($partnerCode).' 
                                AND a.Cel_Account_designationcode LIKE "'.OPERTION_ACCOUNT_LABEL.'"' ;
        parent :: select ($tables);
    }
    //	select data method
    function getMBankingPoint ($partnerCode)
    {
        $tables = $this->_tableName .' po, cel_partner pa, cel_account a';
        $this->_tableFields = 'pa.Cel_Partner_name, a.Cel_Account_code, a.Cel_Point_code' ;
        $this->_condition   = 'po.Cel_Partner_code=pa.Cel_Partner_code 
                                AND po.Cel_Point_code=a.Cel_Point_code 
                                AND pa.Cel_Partner_code = '.  clean4sgbd($partnerCode).'
                                AND a.Cel_Account_designationcode LIKE "'.MBANKING_CODE_TYPE.'"' ;
        parent :: select ($tables);
    }
    //	select data method
    function getByPartnerCode ($celPartnerCode)
    {
        $this->_tableFields = '*' ;
        $this->_condition   = 'Cel_Partner_code='.clean4sgbd($celPartnerCode) ;
        parent :: select ();
    }
}
?>
