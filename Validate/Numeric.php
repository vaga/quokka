<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\Numeric
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class Numeric extends AbstractValidate {

    /**
     *
     * @param $data string
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {
    
        if(is_numeric($data))
            return true;
        return false;
    }
}
