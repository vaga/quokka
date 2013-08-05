<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc;

/**
 * \Quokka\Mvc\Router
 *
 * @package Quokka
 * @subpackage Mvc
 * @author Fabien Casters
 */
class Router {

    /**
     * @var array
     */
    private $_rules = [];

    /**
     * 
     * @param $name string 
     * @return void
     */
    public function addRule( $name, $regexp, $module, $controller, $action, $params = [] ) {

        $rule = [
            'regexp'     => $regexp,
            'params'     => [
                'module'     => $module,
                'controller' => $controller,
                'action'     => $action
            ] 
        ];
        $this->_rules[$name] = $rule;

        return $this;
    }

    /**
     *
     * @param $request \Quokka\Network\Request
     * @return boolean
     */
    public function route( $request ) {

        foreach( $this->_rules as $rule ) {

            if( preg_match( '`' . $rule['regexp'] . '`', $request->getUri(), $matches) ) {

                $params = $matches + $rule['params'];
                foreach( $params as $key => $value ) {

                    if( !is_numeric($key) )
                        $request->setParam( $key, $value );
                }
                return true;
            }
        }

        return false;
    }
}
