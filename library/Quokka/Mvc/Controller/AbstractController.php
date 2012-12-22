<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc\Controller;

use Quokka\Mvc\View\View;

/**
 * \Quokka\Mvc\Controller\AbstractController
 *
 * @package Mvc
 * @subpackage Controller
 * @author Fabien Casters
 */
abstract class AbstractController {
    
    private $_application = null;

    /**
     *
     * @param \Quokka\Mvc\Application $application
     * @return void
     */
    public function setApplication( $application ) {

        $this->_application = $application;
    }

    /**
     *
     * @return \Quokka\Mvc\Application
     */
    public function getApplication() {

        return $this->_application;
    }

    public function render( $data = [] ) {

        $request = $this->getApplication()->getRequest();
        $view = new View();

        if($request->getParam('module', null) === null )
            $file = ucfirst($request->getParam('controller')) . '/'
                  . strtolower($request->getParam('action')) . '.phtml';
        else
            $file = ucfirst($request->getParam('module')) . '/' . ucfirst($request->getParam('controller')) . '/'
                   . strtolower($request->getParam('action')) . '.phtml';

        $view->setFile($file);

        foreach( $data as $key => $value )
            $view->set($key, $value);

        return $view->render();
    }
}

