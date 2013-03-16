<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Session;

/**
 * \Quokka\Session\Session
 *
 * @package Quokka
 * @subpackage Session
 * @author Fabien Casters
 */
class Session {

    /**
     *
     * @return void
     */
    public static function start( ) {

        session_start();
    }
}
