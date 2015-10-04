<?php

/**
 * This file is part of Communique.
 * 
 * @author Robert Main
 * @package Communique
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Communique\Interceptors\JSON;

/**
 *
 * Exception
 *
 * Thrown if JSON interceptor is passed a response to decode that is not valid JSON
 * 
 */
class JSONParseException extends \Communique\CommuniqueException {
	/**
	 * Constructor for Communique JSON Parse Exception
	 * @param String $message A human readable description of the exception
	 */
	public function __construct($message) {
		parent::__construct($message);
	}
}