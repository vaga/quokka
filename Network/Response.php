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

        return $this->_status;
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
     * @param $url string
     * @return void
     */
    public function redirect($url, $status = 302) {

        $this->setStatus($status);
        $this->setHeader('Location', $url);
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function appendBody( $content ) {

        $this->_body .= $content;
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function setBody( $content ) {

        $this->_body = $content;
    }

    /**
     *
     * @return string
     */
    public function getBody() {

        return $this->_body;
    }

    /**
     *
     * @return void
     */
    public function sendHeaders() {

        http_response_code($this->getStatus());

        foreach($this->_headers as $key => $value) {

            header($key . ': ' . $value, true);
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
