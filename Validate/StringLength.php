<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\StringLength
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class StringLength extends AbstractValidate {

    /**
     * @var array
     */
    protected $_required = [
        'min' => 0,
        'max' => false
    ];

    /**
     *
     * @param $data string
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        $size = strlen($data);
        if ($this->getArgument('min') >= $size)
            return false;
        if ($this->getArgument('max') != false && $this->getArgument('max') <= $size)
            return false;
        return true;
    }
}
