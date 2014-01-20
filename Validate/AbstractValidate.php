<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate;

/**
 * \Quokka\Validate\AbstractValidate
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
abstract class AbstractValidate {

    /**
     * @var array
     */
    protected $_arguments = [];

    /**
     * @var array
     */
    protected $_required = [];

    /**
     *
     * @param $args array
     * @return void
     */
    public function __construct($args = []) {

        $this->_arguments = $args;
    }

    /**
     *
     * @param $key string
     * @return string
     */
    public function getArgument($key)
    {
        return $this->_arguments[$key];
    }

    /**
     *
     * @param $data mixed
     * @param $context mixed
     */
    abstract public function isValid($data = null, $context = null);
}
