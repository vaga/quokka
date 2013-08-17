<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Select
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Select extends AbstractElement {


    /**
     * @var array
     */
    protected $_options = [];

    /**
     *
     * @param $key string
     * @param $value string
     * @return void
     */
    public function addOption($key, $value) {

        $this->_options[$key] = $value;
    }

    /**
     *
     * @return boolean
     */
    public function isValid() {

        if (!arrau_key_exists($this->getUnfilteredValue, $this->_options))
            return false;

        return parent::isValid();
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<select name="' . $this->getName() . '">';
        foreach ($this->_options as $key => $value) {

            $content .= '<option value="' . htmlspecialchars($key) . '"';
            if ($this->getUnfilteredValue() == $value)
                $content .= ' selected="selected"';
            $content .= '>' . htmlspecialchars($value) . '</option>';
        }
        $content .= '</select>';

        return $content;
    }
}
