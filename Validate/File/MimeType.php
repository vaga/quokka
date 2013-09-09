<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Validate\File;

use Quokka\Validate\AbstractValidate;

/**
 * \Quokka\Validate\File\MimeType
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class MimeType extends AbstractValidate {

    static public $IMAGE = ['image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/x-png'];

    /**
     * @var array
     */
    private $_mimeTypes = [];

    /**
     * @param $extensions array
     * @return void
     */
    public function __construct($mimeTypes) {

        $this->_mimeTypes = $mimeTypes;
    }

    /**
     *
     * @param $data \Quokka\File\File|array
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        if (is_array($data) && isset($data['tmp_name'])) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $data['tmp_name']);
        }
        else if ($data instanceof \Quokka\File\File)
            $mime = $data->getMimeType();
        else {

            $file = \Quokka\File\File::open($data);
            $mime = $file->getMimeType();
        }

        return in_array($mime, $this->_mimeTypes);
    }
}
