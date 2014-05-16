<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\MinifyHtml
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class MinifyHtml extends AbstractFilter {

    /**
     *
     * @param $data string
     * @return string
     */
    public function filter($data = null) {

        $search = ['/ +/'];
        $replace = [' '];

        $data = preg_replace($search, $replace, $data);

        return $data;
    }
}

