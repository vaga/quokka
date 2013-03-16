<?php

/**
 * Quokka Framework 
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc\View;

/**
 * \Quokka\Mvc\View\View
 *
 * @package Mvc
 * @subpackage View
 * @author Fabien Casters
 */
class View {

    /**
     * @var array
     */
    private $_data = [];

    /**
     * @var string
     */
    private $_file = '';

    /**
     *
     * @param $file string
     * @return void
     */
    public function __construct($file = '') {
        
        $this->_file = $file;
    }
    /**
     *
     * @param $key string
     * @param $value mixed
     * @return void
     */
    public function set( $key, $value ) {

        $this->_data[$key] = $value;
    }

    /**
     *
     * @param $file string
     * @return void
     */
    public function setFile( $file ) {

        $this->_file = $file;
    }

    /**
     *
     * @return string
     */
    public function render() {

        extract( $this->_data );

        ob_start();

        require $this->_file;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
