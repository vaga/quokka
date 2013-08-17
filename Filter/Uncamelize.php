<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\Uncamelize
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class Uncamelize extends AbstractFilter {

    /**
     *
     * @param $chars array
     * @return string
     */
    private function _replace($chars) {

        if ($chars[1] != '')
            return $chars[1] . '_' . strtolower($chars[2]);
        return strtolower($chars[2]);
    }

    /**
     *
     * @param $data string
     * @return string
     */
    public function filter($data = null) {

        return preg_replace_callback('/(^|[a-z])([A-Z])/',[$this, '_replace'] , $data);
    }
}
