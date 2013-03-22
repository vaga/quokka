<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Quokka
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class Lower {

    public function filter($data = null) {

        return strtolower($data);
    }
}
