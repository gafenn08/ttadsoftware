<?php

/**
 * Base class for interfacing with Infusionsoft.
 * Handles all communication via the xml/rpc Drupal module.
 * 
 * @author Jim McGowen
 *
 */
class InfusionsoftService {
	
	// The infusionsoft url, set by the constructor
	protected $server;
	
	//The infusionsoft key, set by the constructor
	protected $key;
	
	/**
	 * Constructor
	 * 
	 */
	function __construct() {
		// Get the server url and key from the infusionsoft db
		$server = 'https://'. variable_get('infusionsoft_appname'). '.infusionsoft.com/api/xmlrpc';
		if( $server !== false ) {
			$this->server = $server;
		}
		$key = variable_get('infusionsoft_apikey');
		if( $key !== false ) {
			$this->key = $key;
		}
	}
	
	/**
	 * Request
	 * 
	 * Makes an xml/rpc request to Infusionsoft.
	 * 
	 * @param $options Options for the xmlrpc function.
	 */
	public function request( $options ) {
		$result = xmlrpc( $this->server, $options );
		if( $result == false ) {
			// Indicate the error somehow?
			drupal_set_message(xmlrpc_error_msg());
		}
		return $result ;
	}
}

?>