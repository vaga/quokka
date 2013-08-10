<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Database;

/**
 * \Quokka\Database\AbstractTable
 *
 * @package Quokka
 * @subpackage Database
 * @author Fabien Casters
 */
abstract class AbstractTable {

    /**
     * @var string
     */
    protected $_name = "";

    /**
     * @var string
     */
    protected $_prefix = "";

    /**
     * @var string
     */
    protected $_primaryKey = "id";

    /**
     * @var array
     */
    protected $_columns = [];

    /**
     *
     * @param $name string
     * @return this
     */
    public function setName($name) {

        $this->_name = $name;
        return $this;
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
     * @param $prefix string
     * @return this
     */
    public function setPrefix($prefix) {

        $this->_prefix = $prefix;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPrefix() {

        return $this->_prefix;
    }

    /**
     *
     * @param $primaryKey string
     * @return this
     */
    public function setPrimaryKey($primaryKey) {

        $this->_primaryKey = $primaryKey;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPrimaryKey() {

        return $this->_primaryKey;
    }

    /**
     *
     * @param $column string
     * @return this
     */
    public function addColumn($column) {

        $this->_columns[] = $column;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getColumns() {

        return $this->_columns;
    }

    /**
     *
     * @param $column string
     * @return boolean
     */
    public function hasColumn($column) {

        return in_array($column, $this->getColumns());
    }
}
