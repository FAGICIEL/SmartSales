<?php
/** 
 * Controleur secondaire
 * @author M. TCHOUABE
 */
 require_once DIR_MODEL . 'ClpProject.php' ;
 require_once DIR_MODEL . 'ClpEnreg.php';
 require_once DIR_MODEL . 'ClpClient.php';
 require_once DIR_MODEL . 'ClpType.php';
 require_once DIR_MODEL . 'ClpSid.php';
 //
 $sess = new ClpSid();
 $client = new ClpClient();
 //--- Log 
 bbdLog( '>>> cConnect - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' .  $_SERVER [ 'REQUEST_URI' ] ) ;
 //---
 
 $res = $sess -> fetch_row($sess -> verifActiveSid($_SESSION ['USER_CODE']));
 $dReponse ['disconnexion'] = false;
 $dReponse ['session_creation'] = false;
//--- test sur l existence d une session
if ($sess -> getNumRows() <= 0) // non
{
    unset($_SESSION ['MDZ_CONNECT_USER_22']);
    //--- le user est il entrain de se connecter
    if (strcasecmp($_GET ['action'], 'connect') == 0) // oui
    {
        if ($_SESSION ['MDZ_CONNECT_USER_22'])
        {
            $dReponse ['session_creation'] = false; 
            $dReponse ['disconnexion'] = true;
        }
        else 
        {
            $dReponse ['session_creation'] = true;
        }
    }
    else // non
    {
        $dReponse ['disconnexion'] = true;
    }
}
//---
if ($dReponse ['disconnexion'])
{
    session_destroy();
    $dSession['state'] = array ( 'principal' => 'home', 'secondaire' => 'home' ); // place l'appli dans l'etat home
    require DIR_CONTROLLER . 'cHome.php';
}
else
{ 
    $_SESSION ['mdz_sid_id'] = $res [0][1];
    if (! demNb ())
    {
            $dReponse ['dprodocs'] = 'dprodocs';
            $dReponse ['prodocs'] = 'prodocs';
            $dReponse ['divbg'] = 'divbg';
            //
            if (true)
            {
                   $dReponse ['allWidth'] = 'allWidth';
                   $dReponse ['listlang'] = 'listlang';
            }
            $dReponse ['bodyId'] = 'body';
            //
            $dReponse [ 'traduction_msg' ] 	 = bbdHtmlSpecialChars($bbdLang ['copyright']);
            $_SESSION [ 'SELECTED_LANG' ] 		 = $lg = $bbdLang [ 'lang' ] ;
            $dReponse [ 'list_lang' ]			 = getLangList ($lg);
            $dReponse [ 'header' ]              = $dConfig [ 'layout' ][ 'connectheader' ][ 'url' ] ;
            $dReponse [ 'footer']               = $dConfig [ 'layout' ][ 'connectfooter' ][ 'url' ] ;
            $dReponse [ 'content' ]             = $dConfig [ 'view' ][ 'connect' ][ 'url' ] ;
            $dReponse [ 'welcome_menu' ]        = $bbdLang [ 'welcome_menu' ] ;
            //--- left menu

            //---------------------------------------------------------------------------
            //----------- template du controlleur
            $dReponse [ 'state_template' ] = $dConfig [ 'c_template' ][ 'connect' ][ 'url' ] ;
            //--- Vue generale
            if (! in_array ($vAction, $dConfig ['always'])) 
            {
                   $dReponse [ 'viewModel' ]    = $dConfig [ 'viewgab' ][ 'connect' ][ 'url' ] ;
                   $dReponse [ 'advertise' ]    = "";
            }
            else 
            {
                   $dReponse [ 'viewModel' ]    = $dConfig [ 'viewgab' ][ 'mention' ][ 'url' ] ;	
                   $dReponse [ 'advertise' ]    = "";
            }
            //--- Log 
            bbdLog( '--- general view - ' . $dReponse [ 'viewModel' ] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
                                   .  $_SERVER [ 'REQUEST_URI' ] ) ;
            // Vue �l�mentaire
            $dReponse [ 'content' ] = $dConfig [ 'view' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
            //--- elementary Log 
            bbdLog( '--- Elementary view - ' . $dReponse [ 'content' ] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
                                   .  $_SERVER [ 'REQUEST_URI' ] ) ;
            // Template
            $dReponse['template']   = $dConfig [ 'template' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
            //--- Log 
            bbdLog( '--- Elementary template - ' . $dReponse['template'] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
                                   .  $_SERVER [ 'REQUEST_URI' ] ) ;
            //--- Log 
            bbdLog( '--- Main action controller - ' . $dConfig ['s_controller']['connect'][$dSession ['state']['secondaire']]['url'] . ' - ' . $_SERVER [ 'REMOTE_ADDR' ] . ' - ' 
                                   .  $_SERVER [ 'REQUEST_URI' ] ) ;
            //-------- inclusion du controlleur de l'action
            require $dConfig [ 's_controller' ][ 'connect' ][ $dSession [ 'state' ][ 'secondaire' ] ][ 'url' ] ;
    }
    else 
    {
           echo $bbdLang ['apps_error'];
    }
}
?>