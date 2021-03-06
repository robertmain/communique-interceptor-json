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

    public function test_put_request(){
    	$request = new \Communique\RESTClientRequest('PUT', 'http://domain.com/users', array('request' => 'payload'));
    	$processed_request = $this->JSON->request($request);
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Accept'], 'application/json');
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Content-Type'], 'application/json');
    	PHPUnit_Framework_TestCase::assertJsonStringEqualsJsonString('{"request": "payload"}', $processed_request->payload);
    	PHPUnit_Framework_TestCase::assertEquals($request, $processed_request);
    }

    public function test_post_request(){
    	$request = new \Communique\RESTClientRequest('POST', 'http://domain.com/users', array('request' => 'payload'));
    	$processed_request = $this->JSON->request($request);
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Accept'], 'application/json');
    	PHPUnit_Framework_TestCase::assertEquals($request->headers['Content-Type'], 'application/json');
    	PHPUnit_Framework_TestCase::assertJsonStringEqualsJsonString('{"request": "payload"}', $processed_request->payload);
    	PHPUnit_Framework_TestCase::assertEquals($request, $processed_request);
    }


    public function test_response(){
    	$response = new \Communique\RESTClientResponse(200, '{"response": "payload"}');
    	$processed_response = $this->JSON->response($response);
    	PHPUnit_Framework_TestCase::assertEquals(array('response' => 'payload'), $processed_response->payload);
    }

    public function test_error_depth(){
    	PHPUnit_Framework_TestCase::setExpectedException('\Communique\Interceptors\JSON\JSONParseException', 'The maximum stack depth has been exceeded');
        $response = new \Communique\RESTClientResponse(200, '{"example": ["example": ["example": "example"]]}');
        $this->JSON->response($response);
    }

    public function test_error_state_mismatch_response(){       
        PHPUnit_Framework_TestCase::setExpectedException('\Communique\Interceptors\JSON\JSONParseException', 'Invalid or malformed JSON');
    	$response = new \Communique\RESTClientResponse(200, 'this is not json');
    	$this->JSON->response($response);
    }
}
