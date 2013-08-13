<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Hidden
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Hidden extends AbstractElement {

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="hidden" name="' . $this->getName() . '"';
        if ($this->getUnfilteredValue() != '')
            $content .= ' value="' . htmlspecialchars($this->getUnfilteredValue()) . '"';
        $content .= ' />';

        return $content;
    }
}
