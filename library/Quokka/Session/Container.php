<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Session;

/**
 * \Quokka\Session\Container
 *
 * @package Quokka
 * @subpackage Session
 * @author Fabien Casters
 */
class Container {


    private $_name;

    public function __construct($name) {

        Session::start();
        $this->_name = $name;
    }

    public function set($key, $value) {

        $_SESSION[$this->_name][$key]  = $value;
    }

    public function get($key, $default = null) {

        if (isset($_SESSION[$this->_name][$key]))
            return $_SESSION[$this->_name][$key];
        return $default;
    }

}
