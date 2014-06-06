<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Database;

/**
 * \Quokka\Database\AbstractEntity
 *
 * @package Quokka
 * @subpackage Database
 * @author Fabien Casters
 */
abstract class AbstractEntity {

    /**
     *
     * @param $name string
     * @param $args array
     * @return mixed
     */
    public function __call($name, $args) {

        if (substr($name, 0, 3) == 'get') {

            $prop = '_' . lcfirst(substr($name, 3));
            return $this->$prop;
        }
        else if (substr($name, 0, 3) == 'set') {

            $prop = '_' . lcfirst(substr($name, 3));
            $this->$prop = $args[0];
        }
    }
}
