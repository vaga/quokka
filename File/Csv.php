<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\File;

/**
 * \Quokka\File\Csv
 *
 * @package Quokka
 * @author Romain Fey
 */
class Csv extends File {

    /**
     * @var string
     */
    protected $_delimiter = ';';

    /**
     * @var string
     */
    protected $_enclosure = '"';

    /**
     * @var string
     */
    protected $_escape = "\n";

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
    public function __destruct() {

        fclose($this->getResource());
    }

    /**
     *
     * @param $file string
     * @return void
     */
    public function _open($file = '') {

        $this->setFullPath($file);
        $this->setResource(fopen($file, 'a+'));
    }

    /**
     *
     * @return void
     */
    public function _create() {

        $tmp = tempnam('./', 'tmp.csv');
        $this->setFullPath($tmp);
        $this->setResource(fopen($tmp, 'a+'));
    }

    /**
     *
     * @param $file string
     * @return resource
     */
    public static function open($file = '') {

        return new Csv($file);
    }

    /**
     *
     * @return resource
     */
    public static function create() {

        return new Csv();
    }

    /**
     *
     * @param $row array
     * @return void
     */
    public function addLine($row = []) {

        fputcsv($this->getResource(), $row, $this->getDelimiter());
    }

    /**
     *
     * @param $row array
     * @return void
     */
    public function addLines($row = []) {

        foreach ($row as $value)
            fputcsv($this->getResource(), $value, $this->getDelimiter());
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
     * @return array
     */
    public function toArray() {

        $data = [];
        $resource = fopen($this->getFullPath(),'r');
        while(($row = fgetcsv($resource, 1000, $this->getDelimiter())) !== false) {
            $data[] = $row;
        }
        fclose($resource);
        return $data;
    }

    /**
     *
     * @param $column int
     * @param $expr string
     * @return array
     */
    public function find($column, $expr) {

        $result = [];
        $data = $this->read();
        foreach ($data as $row) {
            if(preg_match($expr , $row[$colmun])) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     *
     * @param $path string
     * @return void
     */
    public function save($path = '') {

        $this->move($path);
        $this->setFullPath($path);
    }

    /**
     *
     * @return string
     */
    public function getDelimiter() {

        return $this->_delimiter;
    }

    /**
     *
     * @param $delimiter string
     * @return void
     */
    public function setDelimiter($delimiter) {

        $this->_delimiter = $delimiter;
    }

    /**
     *
     * @return string
     */
    public function getEnclosure() {

        return $this->_enclosure;
    }

    /**
     *
     * @param $enclosure string
     * @return void
     */
    public function setEnclosure($enclosure) {

        $this->_enclosure = $enclosure;
    }

    /**
     *
     * @return string
     */
    public function getEscape() {

        return $this->_escape;
    }

    /**
     *
     * @param $escape string
     * @return void
     */
    public function setEscape($escape) {

        $this->_escape = $escape;
    }
}
