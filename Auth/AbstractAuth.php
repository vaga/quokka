<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Auth;

/**
 * \Quokka\Auth\AbstractAuth
 *
 * @package Quokka
 * @author Fabien Casters
 */
abstract class AbstractAuth {

    /**
     * @var \Quokka\Session\Container
     */
    private $_session;

    /**
     *
     * @return void
     */
    public function __construct() {

        $this->_session = new \Quokka\Session\Container('identity');
    }

    /**
     *
     * @return boolean
     */
    public function hasIdentity() {

        return $this->_session->get('hasIdentity', false);
    }

    /**
     *
     * @return mixed
     */
    public function getIdentity() {

        return $this->_session->get('identity');
    }

    /**
     *
     * @param $identity mixed
     */
    public function setIdentity($identity) {

        $this->_session->set('hasIdentity', true);
        $this->_session->set('identity', $identity);
    }

    /**
     *
     * @return void
     */
    public function clearIdentity() {

        $this->_session->clear();
    }

    /**
     *
     * @param $identity string
     * @param $credential string
     * @return boolean
     */
    abstract public function authenticate($identity, $credential);
}
