<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Auth;

/**
 * \Quokka\Auth\InterfaceAuthenticator
 *
 * @package Quokka
 * @author Fabien Casters
 */
interface InterfaceAuthenticator {

    /**
     *
     * @param $identity string
     * @param $credential string
     * @return mixed
     */
    public function authenticate($identity, $credential);
}
