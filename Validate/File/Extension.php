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
 * \Quokka\Validate\File\Extension
 *
 * @package Quokka
 * @subpackage Validate
 * @author Fabien Casters
 */
class Extension extends AbstractValidate {

    static public $IMAGE = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * @var array
     */
    private $_extensions = [];

    /**
     * @param $extensions array
     * @return void
     */
    public function __construct($extensions) {

        $this->_extensions = $extensions;
    }

    /**
     *
     * @param $data \Quokka\File\File|array
     * @param $context mixed
     * @return boolean
     */
    public function isValid($data = null, $context = null) {

        if (is_array($data) && isset($data['name']) && isset($data['tmp_name'])) {

            $explode = explode('.', $data['name']);
            $ext = $explode[1];
        }
        else if ($data instanceof \Quokka\File\File)
            $ext = $data->getExtension();
        else {

            $file = \Quokka\File\File::open($data);
            $ext = $file->getExtension();
        }

        return in_array($ext, $this->_extensions);
    }
}
