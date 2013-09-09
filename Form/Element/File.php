<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\File
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class File extends AbstractElement {

    /**
     *
     * @return boolean
     */
    public function isValid() {

        if (!$this->isRequired() && $this->getValue()['name'] == '')
            return true;

        return parent::isValid();
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="file" name="' . $this->getName() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        $content .= ' />';

        return $content;
    }

    /**
     *
     * @return void
     */
    public function upload($path) {

        $value = $this->getValue();
        move_uploaded_file($value['tmp_name'], $path);
    }
}
