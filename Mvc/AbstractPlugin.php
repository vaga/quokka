<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc;

/**
 * \Quokka\Mvc\AbstractPlugin
 *
 * @package Quokka
 * @subpackage Mvc
 * @author Fabien Casters
 */
abstract class AbstractPlugin {

    /**
     * @var \Quokka\Mvc\Application
     */
    private $_application;

    /**
     *
     * @param $application \Quokka\Mvc\Application
     * @return void
     */
    public function setApplication($application) {

        $this->_application = $application;
    }

    /**
     * @return \Quokka\Mvc\Application
     */
    public function getApplication() {

        return $this->_application;
    }

    abstract public function preDispatch();
    abstract public function postDispatch();
}
