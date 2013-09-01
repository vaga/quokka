<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Textarea
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Textarea extends AbstractElement {

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<textarea name="' . $this->getName() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        $content .= '>';
        if ($this->getUnfilteredValue() != '')
            $content .= htmlspecialchars($this->getUnfilteredValue());
        $content .= '</textarea>';

        return $content;
    }
}
