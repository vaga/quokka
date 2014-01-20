<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\LessThan
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class LessThan extends AbstractValidate {

    /**
     * @var array
     */
    protected $_required = [
        'max' => 0
    ];

    /**
     *
     * @param $data string
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        if ($this->getArgument('max') > $data)
            return true;
        return false;
    }
}
