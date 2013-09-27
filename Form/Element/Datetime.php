<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Datetime
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Datetime extends AbstractElement {

    /**
     * @var array
     */
    private $_formats = ['Y-m-d', 'Y-m-d H:i:s'];

    /**
     *
     * @param string $format
     * @return void
     */
    public function addFormat($format) {

        array_unshift($this->_formats, $format);
    }

    /**
     *
     * @return boolean
     */
    public function isValid () {

        if (!parent::isValid())
            return false;
        foreach($this->_formats as $format) {

            if (\DateTime::createFromFormat($format, $this->getUnfilteredValue()) !== false)
                return true;
        }
        return false;
    }

    /**
     *
     * @return \DateTime
     */
    public function getValue() {

        foreach($this->_formats as $format) {

            $date = \DateTime::createFromFormat($format, $this->getUnfilteredValue());
            if ($date !== false)
                return $date;
        }
        return '';
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="datetime" name="' . $this->getName() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        if ($this->getUnfilteredValue() != '')
            $content .= ' value="' . htmlspecialchars($this->getUnfilteredValue()) . '"';
        $content .= ' />';

        return $content;
    }
}

