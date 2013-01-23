<?php

require_once( 'InfusionsoftService.inc' );

class InfusionsoftInvoice extends InfusionsoftService {
	
	/**
	 * Constructor
	 * 
	 * 
	 * 
	 * @param unknown_type $id ID of the contact to load
	 */
	function __construct( ) {
		parent::__construct();
	}

    public function createInvoiceForRecurring($id){
	    $options = array(
	    	'InvoiceService.createInvoiceForRecurring' => array(
	    		$this->key,
	    		$id
	    	)
	    );
	    $results = $this->request($options);
	    return $results;
	    var_dump($results);
    }
	
	
}

?>