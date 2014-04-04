<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Loader;

/**
 * \Quokka\Loader\Autoloader
 *
 * @package Quokka
 * @subpackage Loader
 * @author Fabien Casters
 */
class Autoloader {


    /**
     * @var array
     */
    private $_classes = [];

    /**
     * @var array
     */
    private $_namespaces = [];

    /**
     *
     * @param $class string
     * @param $path string
     * @return void
     */
    public function addClass( $class, $path ) {

        $this->_classes[$class] = $path;

        return $this;
    }

    /**
     *
     * @param $namespace string
     * @param $path string
     * @return void
     */
    public function addNamespace( $namespace, $path ) {

        $this->_namespaces[$namespace] = $path;

        return $this;
    }

    /**
     *
     * @param $spec string
     * @return string
     */
    private function findPath( $spec ) {

        if( isset($this->_classes[$spec]) )
            return $this->_classes[$spec];

        foreach( $this->_namespaces as $namespace => $path ) {

            $len = strlen($namespace);

            if( substr($spec, 0, $len) != $namespace )
                continue;

            $spec = substr_replace($spec, '', 0, $len);
            $file = str_replace(['\\', '_'], DIRECTORY_SEPARATOR, $spec) . '.php';

            return $path . $file;
        }
        return null;
    }

    /**
     *
     * @return bool
     */
    private function load( $spec ) {

        $path = $this->findPath($spec);

        if (is_null($path))
            return false;

        require_once $path;

        return true;
    }

    /**
     *
     * @return void
     */
    public function register( $prepend = false ) {

        spl_autoload_register([$this, 'load'], true, $prepend);
    }

    /**
     *
     * @return void
     */
    public function unregister() {

        spl_autoload_unregister([$this, 'load']);
    }
}
