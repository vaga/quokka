<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Password
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Password extends AbstractElement {

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="password" name="' . $this->getName() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        $content .= ' />';

        return $content;
    }
}
