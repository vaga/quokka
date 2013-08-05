<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\ElementAbstractElement
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
abstract class AbstractElement {

    /**
     * @var string
     */
    protected $_name;

    /**
     * @var string
     */
    protected $_errorMessage;

    /**
     * @var boolean
     */
    protected $_required = false;

    /**
     * @var mixed
     */
    protected $_value = '';

    /**
     * @var array
     */
    protected $_filters = [];

    /**
     * @var array
     */
    protected $_validates = [];

    /**
     *
     * @param $name string
     * @return void
     */
    public function __construct($name)
    {
        $this->_name = $name;
    }

    /**
     *
     * @param $msg string
     * @return void
     */
    public function setErrorMessage($msg)
    {
        $this->_errorMessage = $msg;
    }

    /**
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage();
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     *
     * @param $required boolean
     * @return void
     */
    public function setRequired($required)
    {
        $this->_required = $required;
    }

    /**
     *
     * @return boolean
     */
    public function isRequired() {

        return $this->_required;
    }

    /**
     *
     * @param $value mixed
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     *
     * @return mixed
     */
    public function getValue() {

        $value = $this->_value;
        foreach($this->_filters as $filter) {
            
            $value = $filter->filter($value);
        }
        return $value;
    }

    /**
     *
     * @return mixed
     */
    public function getUnfilteredValue() {

        return $this->_value;
    }

    /**
     *
     * @param $validate \Quokka\Validate\AbstractValidate
     * @return void
     */
    public function addValidate($validate) {

        $this->_validates[] = $validate;
    }

    /**
     *
     * @param $validate \Quokka\Validate\AbstractFilter
     * @return void
     */
    public function addFilter($filter) {

        $this->filters[] = $filter;
    }

    /**
     *
     * @return boolean
     */
    public function isValid() {

        if ($this->isRequired() && $this->getUnfilteredValue() == '')
            return false;

        foreach ($this->_validates as $validate) {
        
            if (!$validate->isValid($this->getUnfilteredValue()))
                return false;
        }
        return true; 
    }

    /**
     *
     * @return void
     */
    abstract public function render();
}