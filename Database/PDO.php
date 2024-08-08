<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Database;

/**
 * \Quokka\Database\Database
 *
 * @package Quokka
 * @subpackage Database
 * @author Fabien Casters
 */
class PDO extends \PDO {

    /**
     * @var string
     */
    private $_mapperNamespace = "";

    /**
     * @var array
     */
    private $_mappers = [];

    /**
     *
     * @param $modelNamespace string
     * @return void
     */
    public function setMapperNamespace($modelNamespace) {

        $this->_mapperNamespace = $modelNamespace;
    }

    /**
     *
     * @return string
     */
    public function getMapperNamespace() {

        return $this->_mapperNamespace;
    }

    /**
     * @template T
     * @param $mapper string
     * @return T
     */
    public function getMapper($name) {

        if (isset($this->_mappers[$name]))
            return $this->_mappers[$name];

        $className = $this->_mapperNamespace . '\\' . ucfirst($name) . 'Mapper';
        $mapper = new $className();
        $mapper->setPDO($this);

        $this->_mappers[$name] = $mapper;
        return $mapper;
    }
}
