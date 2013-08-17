<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Form\Element;

/**
 * \Quokka\Form\Element\Url
 *
 * @package Quokka
 * @subpackage Form
 * @author Fabien Casters
 */
class Url extends AbstractElement {

    /**
     *
     * @param $name string
     * @return string
     */
    public function __construct($name = 'email') {

        $this->addFilter(new \Quokka\Filter\Lower());
        $this->addValidate(new \Quokka\Validate\Url());

        parent::__construct($name);
    }

    /**
     *
     * @return string
     */
    public function render() {

        $content = '<input type="url" name="' . $this->getName() . '"';
        if ($this->getUnfilteredValue() != '')
            $content .= ' value="' . htmlspecialchars($this->getUnfilteredValue()) . '"';
        $content .= ' />';

        return $content;
    }
}
