<?php
defined('BASE') or exit('Access Denied!'); 

/**
 * Obullo Framework (c) 2009.
 *
 * PHP5 MVC Based Minimalist Software.
 * 
 *
 * @package         Obullo
 * @author          Obullo.com  
 * @subpackage      Base.database        
 * @copyright       Copyright (c) 2009 Ersin Güvenç.
 * @license         public
 * @since           Version 1.0
 * @filesource
 */ 

Class DBException extends CommonException {}  

/**
 * DBResults Class
 *
 * Fetch DB Results.
 *
 * @package         Obullo 
 * @subpackage      Base.database     
 * @category        Database
 * @version         0.1
 * @version         0.2 Changed 'DBResults' class as static 
 *                  'result' class.Changed Obullo PDO constants
 */ 

/**
* PDO CONSTANTS
* @link http://php.net/manual/en/pdo.constants.php
*/

// paramater type constants
// boolean
define('param_bool', PDO::PARAM_BOOL);
// null
define('param_null', PDO::PARAM_NULL);
// integer
define('param_int' , PDO::PARAM_INT);
// string
define('param_str' , PDO::PARAM_STR);
// integer
define('param_lob' , PDO::PARAM_LOB); // Represents the SQL Large Object Data type Large Object Data (lob)
// integer
define('param_input_output' , PDO::PARAM_INPUT_OUTPUT); // Specifies that the parameter is an INOUT parameter for a stored procedure. You must bitwise-OR this value with an explicit PDO::PARAM_* data type.
// integer
define('param_stmt', PDO::PARAM_STMT);  // Represents a recordset type. Not currently supported by any drivers.

/**
* Custom query result class
* 
* @author  Ersin Güvenç
* @version 0.1
*/
Class result 
{ 
    /**
    * Fetch each row as an object with variable names 
    * that correspond to the column names.
    * 
    * @return integer
    */
    public static function lazy()
    {
        return PDO::FETCH_LAZY;
    }

    // --------------------------------------------------------------------

    /**
    * Fetch All query results
    * in associative array data format
    * 
    * @return integer
    */
    public static function assoc()
    {
        return PDO::FETCH_ASSOC;
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Fetch each row as an array 
    * indexed by column name
    * 
    * @return integer
    */
    public static function named()
    {
        return PDO::FETCH_NAMED;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Fetch each row as an array
    * indexed by column number
    * 
    * @return integer
    */
    public static function num()
    {
        return PDO::FETCH_NUM;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Fetch each row as an array 
    * indexed by both column name and numbers
    * 
    * @return integer
    */
    public static function both()
    {
        return PDO::FETCH_BOTH;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Fetch All query results
    * in std object data format
    * 
    * @return integer
    */
    public static function obj()
    {
        return PDO::FETCH_OBJ;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Specifies that the fetch method shall return TRUE 
    * and assign the values of the columns in the result 
    * set to the PHP variables to which they were bound 
    * with the PDOStatement::bindParam() or PDOStatement::bindColumn() methods.
    * 
    * @return integer
    */
    public static function bound()
    {
        return PDO::FETCH_BOUND;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Specifies that the fetch method shall return only a
    * single requested column from the next row in the 
    * result set
    * 
    * @return integer
    */
    public static function column()
    {
        return PDO::FETCH_COLUMN;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Specifies that the fetch method shall return a new instance
    * of the requested class, mapping the columns to named p
    * roperties in the class.
    * 
    * @return integer
    */
    public static function as_class()
    {
        return PDO::FETCH_CLASS;    
    }

    // --------------------------------------------------------------------
    
    /**
    * Specifies that the fetch method shall update an existing 
    * instance of the requested class, mapping the columns to named 
    * properties in the class.
    * 
    * @return integer
    */
    public static function into()
    {
        return PDO::FETCH_INTO;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * 
    * @return integer
    */
    public static function func()
    {
        return PDO::FETCH_FUNC;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * 
    * @return integer
    */
    public static function group()
    {
        return PDO::FETCH_GROUP;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * 
    * @return integer
    */
    public static function unique()
    {
        return PDO::FETCH_UNIQUE;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * WARNING ! Available @since PHP 5.2.3
    * Fetch into an array where the 1st column is a key and 
    * all subsequent columns are value
    * 
    * @return integer
    */
    public static function key_pair()
    {
        return PDO::FETCH_KEY_PAIR;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Determine the class name from the value of first column.
    * 
    * @return integer
    */
    public static function class_type()
    {
        return PDO::FETCH_CLASSTYPE;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Available @since PHP 5.1.0.
    * As PDO::FETCH_INTO but object is provided 
    * as a serialized string
    * 
    * @return integer
    */
    public static function serialize()
    {
        return PDO::FETCH_SERIALIZE;    
    }
    
    // --------------------------------------------------------------------
    
    /**
    * WARNING ! Available @since PHP 5.2.0
    * 
    * @return integer
    */
    public static function props_late()
    {
        return PDO::FETCH_PROPS_LATE;    
    }
    
}  //end class.

?>
