<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\File;

/**
 * \Quokka\File\File
 *
 * @package Quokka
 * @author Romain Fey
 */

class File {

    /**
    * @var resource
    */
    protected $_resource;

    /**
     * @var string
     */
    protected $_path;

    /**
     * @var string
     */
    protected $_name;

    /**
     * @var string
     */
    protected $_extension;

    /**
     * @var string
     */
    protected $_basename;

    /**
     *
     * @param $file string
     * @return resource
     */
    public static function open($path) {

        $file = new File();
        $file->setFullPath($file);    
        return $file;
    }

    /**
     *
     * @return void
     */
    public function show() {}

    /**
     *
     * @return void
     */
    public function save($path = null) {
    }

    /**
     *
     * @return void
     */
    public function remove() {

        unlink($this->getFullPath());
    }

    /**
     *
     * @return string
     */
    public function getFullPath() {

        return $this->_path . '/' . $this->_name;
    }

    /**
     *
     * @param $dest string
     * @return void
     */
    public function rename($dest) {

        if($this->getFullPath() == '')
            $this->save($dest);
        else
            rename($this->getFullPath(), $dest);
        $this->setFullPath($dest);
    }

    /**
     *
     * @param $dest string
     * @return void
     */
    public function move($dest) {

        $this->rename($dest);
        $this->setFullPath($dest);
    }

    /**
     *
     * @param $path string
     * @return void
     */
    public function setFullPath($path) {

        list($this->_path, $this->_name ,$this->_extension, $this->_basename) = array_values(pathinfo($path));
    }

    /**
     *
     * @return string
     */
    public function getName() {

        return $this->_name;
    }

    /**
     *
     * @return string
     */
    public function getPath() {

        return $this->_path;
    }

    /**
     *
     * @return string
     */
    public function getBasename() {

        $this->_basename;
    }

    /**
     *
     * @return string
     */
    public function getExtension() {

        return $this->_extension;
    }

    /**
     *
     * @return resource
     */
    public function getResource() {

        return $this->_resource;
    }

    /**
     *
     * @param $name string
     * @return void
     */
    public function setName($name) {

        $this->_name = $name;
    }

    /**
     *
     * @param $path string
     * @return void
     */
    public function setPath($path) {

        $this->_path = $path;
    }

    /**
     *
     * @param $extension string
     * @return void
     */
    public function setExtension($extension) {

        $this->_extension = $extension;
    }

    /**
     *
     * @param $basename string
     * @return void
     */
    public function setBasename($basename) {

        $this->_basename = $basename;
    }

    /**
     *
     * @param $resource resource
     * @return void
     */
    public function setResource($resource) {

        $this->_resource = $resource;
    }
    
    /**
     *
     * @return string
     */
    public function getMimeType() {

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        return finfo_file($finfo, $this->getFullPath());
    }
}
