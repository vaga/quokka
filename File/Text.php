<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\File;

/**
 * \Quokka\File\Text
 *
 * @package Quokka
 * @author Romain Fey
 */
class Text extends File {

    /**
    * @var array
    */
    protected $_filter = [];

    /**
     *
     * @return void
     */
    public function __construct() {

        if(func_num_args() == 1)
            $this->_open(func_get_arg(0));
        else
            $this->_create();
    }

    /**
     *
     * @return void
     */
    public  function __destruct() {
        fclose($this->getResource());
    }

    /**
     *
     * @param $file string
     * @return void
     */
    protected function _open($file = '') {

        $info = $this->setFullPath($file);
        $this->setResource(fopen($file , 'a+'));
    }

    /**
     *
     * @return void
     */
    protected function _create() {

        $tmp =  tempnam('./', 'tmp.txt');
        $this->setFullPath($tmp);
        $this->setResource(fopen($tmp, 'a+'));
    }

    /**
     *
     * @return resource
     */
    public static function open($file) {

        return new Text($file);
    }

    /**
     *
     * @return resource
     */
    public static function create() {

        return new Text();
    }

    /**
     *
     * @param $filter array
     * @return string
     */
    public function replace($filters = []) {

        $string = stream_get_contents($this->getResource());
        foreach ($filters as $key => $value) {

            $string = str_replace($key, $value, $string);
        }
        return $string;
    }

    /**
     *
     * @return string
     */
    public function show() {

        return file_get_contents($this->getFullPath());
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function write($content) {

        file_put_contents($this->getFullPath(), $content);
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function append($content) {

        file_put_contents($this->getFullPath(),"\n".$content, FILE_APPEND | LOCK_EX);
    }

    /**
     *
     * @param $content string
     * @return void
     */
    public function prepend($content) {

        $fileContent = file_get_contents($this->getFullPath());
        file_put_contents($this->getFullPath(), $content . "\n" . $fileContent);
    }

    /**
     *
     * @param $path string
     * @return void
     */
    public function save($path = null) {

        if ($path != null) {

            $this->move($path);
            $this->setFullPath($path);
        }
    }

    /**
     *
     * @return array
     */
    public function getFilter() {

        return $this->_filter;
    }
}
