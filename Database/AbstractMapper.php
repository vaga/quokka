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
     * @param $sql string
     * @param $params array
     * @return array
     */
    public function fetchAll($sql, $params = []) {

        $prepare = $this->getPDO()->prepare($sql);
        $prepare->execute($params);

        $results = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        foreach($results as $result) {

            $return[] = $this->createEntity($result);
        }
        return $return;
    }

    /**
     *
     * @param $sql string
     * @param $params array
     * @return \Quokka\Database\AbstractEntity
     */
    public function fetchOne($sql, $params = []) {

        $prepare = $this->getPDO()->prepare($sql);
        $prepare->execute($params);

        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $this->createEntity($result);
    }

    /**
     *
     * @param $sql string
     * @param $data array
     * @return void
     */
    public function execute($sql, $data) {

        $prepare = $this->getPDO()->prepare($sql);
        $prepare->execute($data);
    }

    /**
     *
     * @param $obj \Quokka\Database\AbstractEntity
     */
    public function save($obj) {

        $this->saveEntity($obj);
    }

    /**
     *
     * @param $data array
     */
    abstract public function createEntity($data);

    /**
     *
     * @param $data array
     * @param $obj \Quokka\Database\AbstractEntity
     */
    abstract public function saveEntity($obj);
}
