<?php
if( !defined('BASE') ) exit('Access Denied!');

/**
 * Obullo Framework (c) 2009.
 *
 * PHP5 MVC-min Framework software for PHP 5.2.4 or newer
 * Derived from Code Igniter
 *
 * @package         obullo
 * @filename        base/libraries/Controller.php        
 * @author          obullo.com
 * @copyright       Ersin Güvenç (c) 2009.
 * @since           Version 1.0
 * @filesource
 * @license
 */

/**
*  o SSC Pattern (c) 2009 Ersin Güvenç
*  o We use Super Static Controllers  
*  o for prevent long writing ($this->navigation->nav_level1())
*  o we just write like this user::nav_level1();
*/
 
/**
 * Obullo Super Static Controller (SSC)
 * 
 * We put all static main codes here
 * Like cookie , session, register
 * Goal of the SSC to get all static functions
 * like this ob::instance(), ob::session_set(), 
 * ob::cookie_get(),ob::dbconnect() you can 
 * also use $this var inside from static
 * functions.
 * 
 * @version 0.1
 * @version 0.2 added core functions like ob::register
 * @version 0.3 moved some func to common.php like 
 *              ob::register functions
 */
 
Class SSC extends loader 
{
    /**
    * Gets a config item
    *
    * @access    public
    * @return    mixed
    */
    public function config_item($item)
    {
        static $config_item = array();

        if ( ! isset($config_item[$item]))
        {
            $config =& get_config();

            if ( ! isset($config[$item]))
            {
                return FALSE;
            }
            $config_item[$item] = $config[$item];
        }

        return $config_item[$item];
    }
   
    // get current database settings
    static function config_db_item(){}
    
    static function config_set(){}
    // $this->config->site_url();
    static function config_url(){}
    static function config_baseurl(){}
    // $this->config->system_url();
    static function config_system(){}
   

    /**
    * ob::input_post();
    * 
    * @author Ersin Güvenç
    * @param mixed $key form field
    * @version 1.0
    * @return void
    */
    public function post($key)
    {
        return $this->input->post($key);    
    }
    public function get($key)
    {
        return $this->input->get($key); 
    }
   
    // identical CI $this->input->get_both
    static function both($key,$bool){}
    
    // identical CI $this->input->get_post
    static function xss(){}
    
    /**
    * ob::input_ip();
    * Validate ip address
    * @param mixed $key ip addres
    * @version 1.0
    * @return void
    */
    public function ip()
    {
        return $this->input->ip();
    }
    
    public function input_server($key){}
    

    public function user_agent(){echo 'ok';} 
    
    // sessions
    public function session_set($key,$array = NULL)
    {
        // kullanıcı ilan edicek 
        // OB_Session::session_set sadece bunu yaz.
        
    }
    
    public function session_set_userdata($array = NULL){}
    
    public function session_userdata($array = NULL){}
    
    public function session_flashdata($array = NULL){}
    
    // cookies..
    public function cookie_get(){}
    
    public function cookie_set(){}
   
    
    // language class
    // otomatik yada kullanıcı tarafından yukleniyor.
    // load library ile
    public function lang(){}

    
    // redirect function
    public function redirect(){}
    
}  // end ssc class.
 
 
Class OBException extends CommonException {}  

 /**
 * Obullo Super Object (c) 2009
 * 
 * @version 0.1
 * @version 0.2 added core functions like ob::register
 * @version 0.3 added extending to SSC, moved register
 *              functions to common.php
 */
 
Class ob extends SSC
{
    /**
    * Obullo instance
    * 
    * @var object
    */
    private static $instance;

    /**
    * Construct func.
    * @return void
    */
    public function __construct()
    {
        self::$instance = $this;
        
        parent::__construct();
    }

    /**
    * ob::instance();
    * 
    * Get the Obullo Super Object Every Where
    *  
    * @author Ersin Güvenç
    * @version 1.0 
    * @version 1.1 getInstance renamed and moved into ob class
    * @return object
    */
    static function instance()
    {
        return self::$instance;
    } 
    
    
    /**
    * ob::dbconnect();
    * Factory and Connect to database driver
    * Get pdo database handle
    * 
    * @author Ersin Güvenç
    * @version 1.0
    * @version 1.1 moved into ob class
    * @return object - pdo database handle
    */
    static function dbconnect()
    {
        return OB_DBFactory::Connect();
    }
    
} // end class.


?>
