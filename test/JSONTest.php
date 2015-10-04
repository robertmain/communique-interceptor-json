<?php

class JSONTest extends PHPUnit_Framework_TestCase{
	public function setUp(){
		$this->JSON = new \Communique\Interceptors\JSON\JSON();
	}

    public function test_get_request(){
    	$request = new \Communique\RESTClientRequest('GET', 'http://domain.com/users', array('request' => 'payload'));
    	$processed_request = $this->JSON->request($request);
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Accept'], 'application/json');
		PHPUnit_Framework_TestCase::assertEquals(array('request' => 'payload'), $processed_request->payload);
		PHPUnit_Framework_TestCase::assertEquals($request, $processed_request);
    }

    public function test_delete_request(){
    	$request = new \Communique\RESTClientRequest('DELETE', 'http://domain.com/users', array('request' => 'payload'));
    	$processed_request = $this->JSON->request($request);
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Accept'], 'application/json');
		PHPUnit_Framework_TestCase::assertEquals(array('request' => 'payload'), $processed_request->payload);
		PHPUnit_Framework_TestCase::assertEquals($request, $processed_request);
    }
}
