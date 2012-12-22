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
    private $_statusCode = 200;

    /**
     * @var string
     */
    private $_body = '';


    /**
     *
     * @param $statusCode int
     * @return void
     */
    public function setStatusCode( $statusCode ) {

        $this->_statusCode = $statusCode;
    }

    /** 
     *
     * @return int
     */
    public function getStatusCode() {

        return $this->_statusCode;
    }

    public function appendBody( $content ) {

        $this->_body .= $content;
    }

    public function send() {

        echo $this->_body;
    }
}
