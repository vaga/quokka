<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\File;

/**
 * \Quokka\File\Image
 *
 * @package Quokka
 * @author Romain Fey
 */
class Image extends File {

    /**
     * @var int
     */
    protected $_width = 0;

    /**
     * @var int
     */
     protected $_height = 0;

    /**
     *
     * @return void
     */
    public function __construct() {

        if(func_num_args() > 1)
            $this->_create(func_get_arg(0) , func_get_arg(1));
        else {

            $this->setFullPath(func_get_arg(0));
            $info = getimagesize($this->getFullPath());
            $this->setWidth($info[0]);
            $this->setHeight($info[1]);
            $this->_load();
        }
    }

    /**
     *
     * @return void
     */
    public function __destruct() {

        imagedestroy($this->getResource());
    }

    /**
    *
    * @param $file string
    * @return resource
    */
    public static function open($file) {

        return new Image($file);
    }

    /**
     *
     * @param $width int
     * @param $height int
     * @return resource
     */
    public static function create($width , $height) {

        return new Image($width, $height);
    }

    /**
     *
     * @return void
     */
    protected function _load() {

        $type = $this->getExtension();

        if($type == 'jpeg' || $type == 'jpg')
            $this->setResource(imagecreatefromjpeg($this->getFullPath()));
        else if($type == 'png')
            $this->setResource(imagecreatefrompng($this->getFullPath()));
        else if($type == 'gif')
            $this->setResource(imagecreatefromgif($this->getFullPath()));
    }

    /**
     *
     * @param $width int
     * @param $height int
     * @return void
     */
    protected function _create($width,$height) {

        $this->setWidth($width);
        $this->setHeight($height);

        $this->setResource(imagecreatetruecolor($this->getWidth() , $this->getHeight()));
    }

    /**
     *
     * @param $width int
     * @param $height int
     * @return resource
     */
    public function resize ($width = null , $height = null) {

        if($width && $height == null)
            $height = $width * $this->getHeight() / $this->getWidth();
        else if($height && $width == null)
            $width = $height * $this->getWidth() / $this->getHeight();

        $newResource = imagecreatetruecolor($width , $height);
        imagecopyresampled($newResource, $this->getResource(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->setWidth($width);
        $this->setHeight($height);
        imagedestroy($this->getResource());
        $this->setResource($newResource);
    }

    /**
     *
     * @param $objetImage resource
     * @param $x int
     * @param $y int
     * @param $transparence int
     * @return void
     */
    public function merge($objetImage, $x, $y, $transparence) {

        imagecopymerge($this->getResource(), $objetImage->getResource() , $x, $y, 0, 0, $objetImage->getWidth(), $objetImage->getHeight(), $transparence);
    }

    /**
     *
     * @return void
     */
    public function show() {

        $type = $this->getExtension();

        if($type == 'jpeg' || $type == 'jpg')
            imagejpeg($this->getResource());
        else if($type == 'png')
            imagepng($this->getResource());
        else if($type == 'gif')
            imagegif($this->getResource());
    }

    /**
     *
     * @return resource
     */
    public function copy() {

        if(file_exists($this->getFullPath()))
            return new Image($this->getFullPath());

        $copy = new Image($this->_width, $this->_height);
        $copy->setFullPath($this->getFullPath());
        return $copy;
    }

    /**
     *
     * @param $x int
     * @param $y int
     * @param $width int
     * @param $height int
     * @return void
     */
    public function crop($x , $y , $width , $height) {

        $newResource = imagecreatetruecolor($width , $height);

        imagecopy ($newResource , $this->getResource() , 0 , 0 , $x , $y , $width , $height);
        imagedestroy($this->getResource());
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setResource($newResource);
    }

    /**
     *
     * @param $path string
     * @param $qualite int
     * @return void
     */
    public function save($path = null , $qualite = 90) {

        if($path != null)
            $this->setFullPath($path);
        if(empty($this->_name))
            throw new Exception("No path specified", 1);

        $type = $this->getExtension();

        if(false != $type) {

            if($type == 'jpeg' || $type == 'jpg')
                imagejpeg($this->getResource(), $this->getFullPath(), $qualite);
            else if($type == 'png')
                imagepng($this->getResource(), $this->getFullPath());
            else if($type == 'gif')
                imagegif($this->getResource(), $this->getFullPath(), $qualite);
        }
    }

    /**
     *
     * @param $width int
     * @return void
     */
    public function setWidth($width) {

        $this->_width = $width;
    }

    /**
     *
     * @return int
     */
    public function getWidth() {

        return $this->_width;
    }

    /**
     *
     * @param $height int
     * @return void
     */
    public function setHeight($height) {

        $this->_height = $height;
    }

    /**
     *
     * @return int
     */
    public function getHeight() {

        return $this->_height;
    }
}
