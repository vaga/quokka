<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Email
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Email extends AbstractElement {

    /**
     *
     * @param $name string
     * @return string
     */
    public function __construct($name = 'email') {

        $this->addFilter(new \Quokka\Filter\Lower());
        $this->addValidate(new \Quokka\Validate\Email());

        parent::__construct($name);
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="email" name="' . $this->getName() . '"';
        foreach ($this->getAttributes() as $key => $value)
            $content .= ' ' . $key . '="' . $value . '"';
        if ($this->getUnfilteredValue() != '')
            $content .= ' value="' . htmlspecialchars($this->getUnfilteredValue()) . '"';
        $content .= ' />';

        return $content;
    }
}
