<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\AbstractElement
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Text extends AbstractElement {

    public function render() {

        $content = '<input type="text" name="' . $this->getName() . '"';
        if ($this->getUnfilteredValue() != '')
            $content .= ' value="' . htmlspecialchars($this->getUnfilteredValue()) . '"';
        $content .= ' />';

        return $content;
    }
}
