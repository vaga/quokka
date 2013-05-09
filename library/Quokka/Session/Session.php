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
     * @var boolean
     */
    private static $_start = false;

    /**
     *
     * @param $val boolean
     * @return void
     */
    public static function setStart($val) {

        self::$_start = $val;
    }

    /**
     *
     * @return boolean
     */
    public static function isStarted() {

        return self::$_start;
    }

    /**
     *
     * @return void
     */
    public static function start() {

        if (self::isStarted())
            return;

        self::setStart(true);
        session_start();
        session_regenerate_id();
    }

    /**
     *
     * @return void
     */
    public static function destroy() {

        if (!self::isStarted())
            return;

        self::setStart(false);
        session_unset();
        session_destroy();
    }
}
