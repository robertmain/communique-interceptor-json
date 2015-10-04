<?php
/**
 * This file contains 
 * 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * 
 */
namespace Communique\Interceptors\JSON;
/**
 * JSON Interceptor for Communique
 *
 * 
 * @author Robert Main
 * @package Communique\Interceptor
 * @copyright  Robert Main
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
 */
class JSON implements \Communique\Interceptor{

	/**
	 * Process Request
	 *
	 * JSON dncodes `PUT` and `POST` request payload data. However, `GET` and `DELTE` request payload data is untouched.
	 * @see http://php.net/manual/en/function.json-encode.php
	 * @param \Communique\RESTClientRequest $req A request encapsulation object
	 * @return \Communique\RESTClientRequest A response encapsulation object
	 */
	public function request(\Communique\RESTClientRequest $req){
		$req->headers['Accept'] = 'application/json';
		if(in_array($req->method, array('PUT', 'POST'))){
			$req->headers['Content-Type'] = 'application/json';
			$req->payload = json_encode($req->payload);
		}
		return $req;
	}


	/**
	 * Process Response
	 *
	 * JSON decodes server response
	 * @see http://php.net/manual/en/function.json-decode.php
	 * @param \Communique\RESTClientResponse $req A response encapsulation object
	 * @return \Communique\RESTClientResponse A response encapsulation object
	 * @throws \Communique\Interceptors\JSONParseException Thrown to indicate an error parsing the JSON recieved
	 */
	public function response(\Communique\RESTClientResponse $res){
		$res->payload = json_decode($res->payload, true);
		switch(json_last_error()){
			case JSON_ERROR_DEPTH:
				throw new \Communique\Interceptors\JSON\JSONParseException('The maximum stack depth has been exceeded');
			break;

			case JSON_ERROR_SYNTAX:
			case JSON_ERROR_STATE_MISMATCH:
				throw new \Communique\Interceptors\JSON\JSONParseException('Invalid or malformed JSON');
			break;

			case JSON_ERROR_CTRL_CHAR:
				throw new \Communique\Interceptors\JSON\JSONParseException('Control character error, possibly incorrectly encoded');
			break;

			case JSON_ERROR_UTF8:
				throw new \Communique\Interceptors\JSON\JSONParseException('Malformed UTF-8 characters, possibly incorrectly encoded');
			break;

			case JSON_ERROR_RECURSION:
				throw new \Communique\Interceptors\JSON\JSONParseException('One or more recursive references in the value to be encoded');
			break;

			case JSON_ERROR_INF_OR_NAN:
				throw new \Communique\Interceptors\JSON\JSONParseException('One or more NAN or INF values in the value to be encoded');
			break;
			
			case JSON_ERROR_UNSUPPORTED_TYPE:
				throw new \Communique\Interceptors\JSON\JSONParseException('A value of a type that cannot be encoded was given');
			break;
			
			default:
			case JSON_ERROR_NONE:
				return $res;
			break;
		}
	}
}