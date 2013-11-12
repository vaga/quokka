<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\Slug
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class Slug extends AbstractFilter {

    /**
     *
     * @param $data string
     * @return string
     */
    public function filter($data = null) {

        $slug = htmlentities($data, ENT_NOQUOTES, 'utf-8');
        $slug = preg_replace('#&([A-z]{1,2})(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml|lig);#', '\1', $slug);
        $slug = preg_replace('#&[^;]+;#', '', $slug);
        $slug = strtolower($slug);
        $slug = preg_replace('#[^a-z0-9]+#', ' ', $slug);
        $slug = trim($slug);
        $slug = str_replace(' ', '-', $slug);

        return $slug;
    }
}
