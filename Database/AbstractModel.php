<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Database;

/**
 * \Quokka\Database\AbstractModel
 *
 * @package Quokka
 * @subpackage Database
 * @author Fabien Casters
 */
abstract class AbstractModel {

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var \Quokka\Database\AbstractTable
     */
    protected $_table;

    /**
     *
     * @param $table \Quokka\Database\AbstractTable
     * @return void
     */
    public function setTable($table) {

        $this->_table = $table;
    }

    /**
     *
     * @return \Quokka\Database\AbstractTable
     */
    public function getTable() {

        return $this->_table;
    }

    /**
     *
     * @param $name string
     * @param $value string
     * $return void
     */
    public function __set($name, $value) {

        $this->_data[$name] = $value;
    }

    /**
     *
     * @param $name string
     * $return void
     */
    public function __get($name) {

        return $this->_data[$name];
    }

    public function __call($name, $param) {

        $uncamlize = new \Quokka\Filter\Uncamelize();
        $method = substr($name, 0, 3);

        if($method == 'set') {

            $column = $this->getTable()->getPrefix() . $uncamlize->filter(substr($name, 3));
            if ($this->getTable()->hasColumn($column))
                return $this->__set($column, $param[0]);
        }
        else if($method == 'get') {

            $column = $this->getTable()->getPrefix() . $uncamlize->filter(substr($name, 3));
            if ($this->getTable()->hasColumn($column))
                return $this->__get($column);
        }
    }
}
