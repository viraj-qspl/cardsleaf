<?php


require_once "base_facebook.php";



/**

 * Extends the BaseFacebook class with the intent of using

 * PHP sessions to store user ids and access tokens.

 */

class Facebook extends BaseFacebook

{

  /**

   * Identical to the parent constructor, except that

   * we start a PHP session to store the user ID and

   * access token if during the course of execution

   * we discover them.

   *

   * @param Array $config the application configuration.

   * @see BaseFacebook::__construct in facebook.php

   */

  public function __construct($config=false) {
$config=false;
    
	if(!$config){

	$config=  array(

		  'appId'  => '259857357490625',

		  'secret' => 'ecf19dc6ea716aff7caf0360a4b5133b',
		   

		);

	}

    parent::__construct($config);

  }



  protected static $kSupportedKeys =

    array('state', 'code', 'access_token', 'user_id');



  /**

   * Provides the implementations of the inherited abstract

   * methods.  The implementation uses PHP sessions to maintain

   * a store for authorization codes, user ids, CSRF states, and

   * access tokens.

   */

  protected function setPersistentData($key, $value) {

    if (!in_array($key, self::$kSupportedKeys)) {

      self::errorLog('Unsupported key passed to setPersistentData.');

      return;

    }



    $session_var_name = $this->constructSessionVariableName($key);

    $_SESSION[$session_var_name] = $value;

  }



  protected function getPersistentData($key, $default = false) {

    if (!in_array($key, self::$kSupportedKeys)) {

      self::errorLog('Unsupported key passed to getPersistentData.');

      return $default;

    }



    $session_var_name = $this->constructSessionVariableName($key);

    return isset($_SESSION[$session_var_name]) ?

      $_SESSION[$session_var_name] : $default;

  }



  protected function clearPersistentData($key) {

    if (!in_array($key, self::$kSupportedKeys)) {

      self::errorLog('Unsupported key passed to clearPersistentData.');

      return;

    }



    $session_var_name = $this->constructSessionVariableName($key);

   // unset($_SESSION[$session_var_name]);

  }



  protected function clearAllPersistentData() {

    foreach (self::$kSupportedKeys as $key) {

      $this->clearPersistentData($key);

    }

  }



  protected function constructSessionVariableName($key) {

    return implode('_', array('fb',

                              $this->getAppId(),

                              $key));

  }

}

