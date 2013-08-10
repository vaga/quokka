<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Database;

/**
 * \Quokka\Database\AbstractMapper
 *
 * @package Quokka
 * @subpackage Database
 * @author Fabien Casters
 */
abstract class AbstractMapper {

    /**
     * @var \Quokka\Database\AbstractTable
     */
    private $_table;

    /**
     * @var string
     */
    private $_modelName;

    /**
     * @var \Quokka\Database\PDO
     */
    private $_pdo;

    /**
     *
     * @param $pdo \Quokka\Database\PDO
     * @return void
     */
    public function setPDO($pdo) {

        $this->_pdo = $pdo;
    }

    /**
     *
     * @return \Quokka\Database\PDO
     */
    public function getPDO() {

        return $this->_pdo;
    }

    /**
     *
     * @param $modelName string
     * @return void
     */
    public function setModelName($modelName) {

        $this->_modelName = $modelName;
    }

    /**
     *
     * @return string
     */
    public function getModelName() {

        return $this->_modelName;
    }

    /**
     *
     * @param $pdo \Quokka\Database\AbstractTable
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

    public function findAll() {

        $sql = 'SELECT * FROM ' . $this->_table->getName() . ';';
        $prepare = $this->_pdo->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, $this->getModelName());
    }
}
