<?php
 $_SESSION ['userinfo']   	 = $userInfo [0];
 $_SESSION ['SESSION_ID'] 	 = session_id ();
 $_SESSION ['USER_CODE'] = $userInfo [0][1];
 $_SESSION ['USER_NAME'] = $userInfo [0][2];
 $_SESSION ['USER_TYPE'] = $userInfo [0][5];
 $_SESSION [ 'MDZ_CONNECT_USER_22' ] = true;
 //--- Session
 if ($dReponse ['session_creation']) // on peut creer une session
 {
     $sess -> create ($_SESSION ['USER_CODE']);
     $_SESSION ['mdz_sid_id'] = $sess -> sid;
     $_SESSION ['user_sd'] = $_SESSION ['mdz_sid_id'];
 }
 //--- creating user menu
 $_SESSION ['user_menu'] = getUserMenu ($_SESSION ['USER_TYPE']);
 //---
 $_SESSION [ 'logout_msg' ] = $dReponse [ 'disconnect' ] = $bbdLang [ 'disconnect' ] ;
 $dReponse ['task_title'] = $bbdLang ['product_list_label'];
 //---
 //--- construction de la 
 $dReponse ['plist'] = getGammeList();
 //-------------------------------
 //----------- Vue
 $dReponse['content']          = $dConfig ['view']['connect']['url'] ;
 // Template
 $dReponse['template']         = $dConfig ['template']['connect']['url'] ;
?>