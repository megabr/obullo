<?php
if( !defined('BASE') ) exit('Access Denied!');

/**
 * Obullo Framework (c) 2009.
 *
 * PHP5 MVC Framework software for PHP 5.2.4 or newer
 *
 * @package         obullo
 * @filename        base/libraries/Errors.php        
 * @author          obullo.com
 * @copyright       Ersin Güvenç (c) 2009.
 * @since           Version 1.0
 * @filesource
 * @license
 */ 

/*
*  Predefined error constants
*  http://usphp.com/manual/en/errorfunc.constants.php
* * 
1     E_ERROR
2     E_WARNING
4     E_PARSE
8     E_NOTICE
16    E_CORE_ERROR
32    E_CORE_WARNING
64    E_COMPILE_ERROR
128   E_COMPILE_WARNING
256   E_USER_ERROR
512   E_USER_WARNING
1024  E_USER_NOTICE
2048  E_STRICT
4096  E_RECOVERABLE_ERROR
8192  E_DEPRECATED
16384 E_USER_DEPRECATED
30719 E_ALL
*/

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

Class CommonException extends Exception {}

// Obullo error template for error handling.
function Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, $type)
{   
    $msg = '<div style=\'width:50%;padding:5px;background-color:#eee;\'>';
    $msg.= '<b>[Obullo]['. ucwords(strtolower($type)).']:</b>'.$errstr.'<br />';
    $msg.= '<b>File:</b> &nbsp;'.$errfile."<br />";
    $msg.= '<b>Line:</b> &nbsp;'.$errline;
    $msg.= '</div>';
    
    echo $msg;
}


// Obullo error template for exceptions.
function Obullo_ExceptionHandler($e)
{   
    $type = 'General';
    
    if(substr($e->getMessage(),0,3) == 'SQL')
    $type = 'Database';
   
    $msg = '<div style=\'width:50%;padding:5px;background-color:#eee;\'>';
    $msg.= '<b>['. $type .' Error]: </b>'.$e->getMessage().'<br />';
    $msg.= '<b>Code:</b> &nbsp;'.$e->getCode()."<br />";  
    $msg.= '<b>File:</b> &nbsp;'.$e->getFile()."<br />";
    $msg.= '<b>Line:</b> &nbsp;'.$e->getLine();
    $msg.= '</div>';
    
    echo $msg;
}            

/*
*  Main error handler function.
*/
function Obullo_ErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (($errno & error_reporting()) == 0) return;  
    
    switch ($errno)
    {
    case E_ERROR:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "ERROR");
    break;
    
    case E_WARNING:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "WARNING");
    break;
    
    case E_PARSE:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "PARSE ERROR");
    break;
    
    case E_NOTICE:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "NOTICE");
    break;
                       
    case E_CORE_ERROR:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "CORE ERROR");
    break;
    
    case E_CORE_WARNING:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "CORE WARNING");
    break;
    
    case E_COMPILE_ERROR:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "COMPILE ERROR");
    break;
    
    case E_USER_ERROR:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "USER FATAL ERROR");
        exit();
    break;   
        
    case E_USER_WARNING:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "USER WARNING");
    break;
    
    case E_USER_NOTICE:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "USER NOTICE");
    break;
    
    case E_STRICT:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "STRICT ERROR");
    break;
    
    case E_RECOVERABLE_ERROR:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "RECOVERABLE ERROR");
    break;
    
    case E_DEPRECATED:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "DEPRECATED ERROR");
    break;
    
    case E_USER_DEPRECATED:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "USER DEPRECATED ERROR");
    break;
    
    case E_ALL:
        Obullo_ErrorTemplate($errno, $errstr, $errfile, $errline, "ERROR");
    break;
    
    }

    /* Don't execute PHP internal error handler */
    return true;
}

// Catch all errors !
set_error_handler("Obullo_ErrorHandler");
set_exception_handler('Obullo_ExceptionHandler');
                   

    
?>