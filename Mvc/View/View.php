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
     * @param $key string
     * @param $default mixed
     * @return mixed
     */
    public function get($key, $default = null) {

        if (isset($this->_data[$key]))
            return $this->_data[$key];
        return $default;
    }

    /**
     *
     * @return array
     */
    public function getData() {

        return $this->_data;
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
     * @param $data mixed
     * @return string
     */
    public function escape($data) {

        return htmlspecialchars($data);
    }

    /**
     *
     * @param $file string
     * @return string
     */
    public function partial($file, $data = []) {

        $view = new View($file);

        foreach($data as $key => $value)
            $view->set($key, $value);

        return $view->render();
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
