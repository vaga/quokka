<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\Alpha
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class Alpha extends AbstractValidate {

    /**
     *
     * @param $data string
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        if (preg_match('/^[a-zA-Z]*$/', $data))
            return true;
        return false;
    }
}
