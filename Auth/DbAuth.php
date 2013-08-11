<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Auth;

/**
 * \Quokka\Auth\AbstractAuth
 *
 * @package Quokka
 * @author Fabien Casters
 */
class DbAuth extends AbstractAuth {


    /**
     * @var \Quokka\Database\PDO
     */
    private $_pdo;

    /**
     * @var string
     */
    private $_table;

    /**
     * @var string
     */
    private $_identity;

    /**
     * @var string
     */
    private $_credential;

    /**
     * @var string
     */
    private $_modelName;

    /**
     *
     * @param $pdo \Quokka\Database\PDO
     * @param $table string
     * @param $identity string
     * @param $credential string
     * @param $modelName string
     * @return void
     */
    public function __construct($pdo, $table, $identity, $credential, $modelName = 'stdClass') {

        $this->_pdo = $pdo;
        $this->_table = $table;
        $this->_identity = $identity;
        $this->_credential = $credential;
        $this->_modelName = $modelName;
        parent::__construct();
    }

    /**
     *
     * @param $identity string
     * @param $credential string
     * @return boolean
     */
    public function authenticate($identity, $credential) {

        $sql = 'SELECT * FROM ' . $this->_table .
               ' WHERE ' . $this->_identity . ' = ? AND ' . $this->_credential . ' = ?;';
        $prepare = $this->_pdo->prepare($sql);
        $prepare->execute([$identity, $credential]);
        if (($identity = $prepare->fetchObject($this->_modelName)) !== false) {

            $this->setIdentity($identity);
            return true;
        }
        return false;
    }
}
