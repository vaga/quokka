<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\Url
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class Url extends AbstractValidate {

    /**
     *
     * @param $data string
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        if(filter_var($data, FILTER_VALIDATE_URL) === false)
            return false;
        return true;
    }
