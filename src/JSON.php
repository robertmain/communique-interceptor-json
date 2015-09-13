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
namespace Communique;
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
	 * @param  \Communique\RESTClientRequest $req A request encapsulation object
	 * @return \Communique\RESTClientRequest A response encapsulation object
	 */
	public function request(\Communique\RESTClientRequest $req){
		$req->payload = json_encode($req->payload);
		return $req;
	}


	/**
	 * Process Response
	 * @param  \Communique\RESTClientResponse $req A response encapsulation object
	 * @return \Communique\RESTClientResponse A response encapsulation object
	 */
	public function response(\Communique\RESTClientResponse $res){
		$res->payload = json_decode($res->payload, true);
		return $res;
	}
}