<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka;

/**
 * \Quokka\Quokka
 *
 * @package Quokka
 * @author Fabien Casters
 */
class Quokka {
    
    private static $_version = '1.0.0';

    public static function getVersion() {

        return self::$_version;
    }
}
