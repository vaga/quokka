<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Network;

/**
 * \Quokka\Network\Response
 *
 * @package Quokka
 * @subpackage Network
 * @author Fabien Casters
 */
class Response {

    /**
     * @var int
     */
    private $_status = 200;

    /**
     * @var string
     */
    private $_body = '';

    /**
     * @var array
     */
    private $_headers = [];

    /**
     *
     * @param $statusCode int
     * @return void
     */
    public function setStatus( $status ) {

        $this->_status = $status;
    }

    /**
     *
     * @return int
     */
    public function getStatus() {

        return $this->_statusCode;
    }

    /**
     *
     * @param $key string
     * @param $value string
     */
    public function setHeader($key, $value) {

        $this->_headers[$key] = $value;
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function appendBody( $content ) {

        $this->_body .= $content;
    }

    public function sendHeaders() {

        foreach($this->_headers as $key => $value) {

            header($key . ' ' . $value, true);
        }
    }
    /**
     *
     * @return void
     */
    public function send() {

        $this->sendHeaders();

        echo $this->_body;
    }
}
