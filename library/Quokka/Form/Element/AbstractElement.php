<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form

/**
 * \Quokka\Form\AbstractElement
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class AbstractElement {

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
     * @param boolean
     * @return void
     */
    public function setRequired($required)
    {
        $this->_required = $required;
    }

    public function isValid()
    {

    }
}
