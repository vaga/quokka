<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Checkbox
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Checkbox extends AbstractElement {



    /**
     * @var array
     */
    protected $_checkedValue = '1';

    /**
     * @var array
     */
    protected $_uncheckedValue = '0';

    /**
     * @param $checked boolean
     * @return void
     */
    public function setChecked($checked) {

        if ($checked)
            $this->setValue($this->getCheckedValue());
        else
            $this->setValue($this->getUncheckedValue());
    }

    /**
     * @param $value string
     * @return void
     */
    public function setValue($value) {

        parent::setValue($value);

        if ($this->isChecked())
            parent::setValue($this->getCheckedValue());
        else
            parent::setValue($this->getUncheckedValue());
    }

    /**
     *
     * @param $checkedValue string
     * @return void
     */
    public function setCheckedValue($checkedValue) {

        if ($this->isChecked())
            $this->setValue($checkedValue);
        $this->_checkedValue = $checkedValue;
    }

    /**
     *
     * @return string
     */
    public function getCheckedValue() {

        return $this->_checkedValue;
    }
    /**
     *
     * @param $uncheckedValue string
     * @return void
     */
    public function setUncheckedValue($uncheckedValue) {

        if (!$this->isChecked())
            $this->setValue($uncheckedValue);
        $this->_uncheckedValue = $uncheckedValue;
    }

    /**
     *
     * @return string
     */
    public function getUncheckedValue() {

        return $this->_uncheckedValue;
    }

    /**
     *
     * @return boolean
     */
    public function isChecked() {

        if ($this->getValue() == $this->getCheckedValue())
            return true;
        return false;
    }
    
    /**
     *
     * @return boolean
     */
    public function isValid() {

        if ($this->isRequired() && !$this->isChecked())
            return false;

        return parent::isValid();
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="checkbox" name="' . $this->getName() . '" value="' . $this->getCheckedValue() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        if ($this->isChecked())
            $content .= ' checked="checked"';
        $content .= ' />';
        return $content;
    }
}
