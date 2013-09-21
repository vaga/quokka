<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc\View\Widget;

/**
 * \Quokka\Mvc\View\Widget\AbstractWidget
 *
 * @package Quokka
 * @subpackage View
 * @author Fabien Casters
 */
abstract class AbstractWidget {

    /**
     *
     * @return string
     */
    abstract public function render();
}
