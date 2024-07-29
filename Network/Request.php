<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Network;

/**
 * \Quokka\Network\Request
 *
 * @package Quokka
 * @subpackage Network
 * @author Fabien Casters
 */
class Request {

    /**
     * @var array
     */
    private $_params = [];

    /**
     * @var boolean
     */
    private $_dispatched = false;

    /**
     *
     * @param $key string
     * @param $value mixed
     * @return void
     */
    public function setParam( $key, $value ) {

        $this->_params[$key] = $value;
    }

    /**
     *
     * @param $key string
     * @return mixed
     */
    public function getParam( $key, $default = null ) {

        switch( true ) {

            case isset($this->_params[$key]):
                return $this->_params[$key];

            case isset($_GET[$key]):
                return $_GET[$key];

            case isset($_POST[$key]):
                return $_POST[$key];
        }

        return $default;
    }

    /**
     *
     * @param $key string|null
     * @return mixed
     */
    public function getPost( $key = null ) {

        if( null === $key )
            return $_POST;

        return $_POST[$key];
    }

    /**
     *
     * @param $key string|null
     * @return mixed
     */
    public function getQuery( $key = null ) {

        if( null === $key )
            return $_GET;

        return $_GET[$key];
    }

    /**
     *
     * @param $key string|null
     * @return mixed
     */
    public function getFiles( $key = null ) {

        if( null === $key )
            return $_FILES;

        return $FILES[$key];
    }

    /**
     *
     * @return string
     */
    public function getMethod() {

        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     *
     * @return boolean
     */
    public function isPost() {

        return ($this->getMethod() == 'POST');
    }

    /**
     *
     * @return boolean
     */
    public function isXmlHttpRequest() {

        $xmlHttpRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
        return ($xmlHttpRequest === 'XMLHttpRequest');
    }

    /**
     *
     * @param $dispatched boolean
     * @return void
     */
    public function setDispatched( $dispatched ) {

        $this->_dispatched = $dispatched;
    }

    /**
     *
     * @return boolean
     */
    public function isDispatched() {

        return $this->_dispatched;
    }

    /**
     *
     * @param $params array
     * @return void
     */
    public function forward($params) {

        $this->setDispatched(false);

        foreach($params as $key => $value)
            $this->setParam($key, $value);
    }

    /**
     *
     * @return string
     */
    public function getUri() {

        return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     *
     * @return string
     */
    public function getPath() {

        return $_SERVER['REQUEST_URI'];
    }
}
