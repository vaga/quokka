<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\AbstractFilter
 *
 * @package Quokka
 * @author Fabien Casters
 */
abstract class AbstractFilter {

    /**
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     *
     * @param $data mixed
     * @return void
     */
    abstract public function filter($data = null);
}

