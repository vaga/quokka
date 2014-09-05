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

    /**
     * @var \Quokka\Mvc\Application
     */
    private $_application = null;

    /**
     * @var \Quokka\Mvc\View\View
     */
     private $_view = null;

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
     * @return void
     */
    public function init() { }

    /**
     *
     * @return \Quokka\Mvc\Application
     */
    public function getApplication() {

        return $this->_application;
    }

    /**
     *
     * @return \Quokka\Mvc\View\View
     */
    public function getView() {

        if ($this->_view == null) {

            $request = $this->getApplication()->getRequest();
            $this->_view = new View();

            if($request->getParam('module', null) === null )
                $file = ucfirst($request->getParam('controller')) . '/'
                      . strtolower($request->getParam('action')) . '.phtml';
            else
                $file = ucfirst($request->getParam('module')) . '/' . ucfirst($request->getParam('controller')) . '/'
                       . strtolower($request->getParam('action')) . '.phtml';

            $this->_view->setFile($file);
        }
        return $this->_view;
    }

    public function render( $data = [] ) {

        $view = $this->getView();
        $layout = $this->getApplication()->getLayout();

        if($layout != null)
            foreach($layout->getData() as $key => $value)
                $view->set($key, $value);

        foreach( $data as $key => $value )
            $view->set($key, $value);

        return $view->render();
    }
}
