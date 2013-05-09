<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka;

/**
 * \Quokka\Locale
 *
 * @package Quokka
 * @author Fabien Casters
 */
class Locale {

    /**
     * @var string
     */
    private $_default = 'en_US.UTF8';

    /**
     * @var array
     */
    private $_locales = ['en_US.UTF8'];

    /**
     *
     * @param $default string
     * @param $locales array
     * @return void
     */
    public function __construct($default, $locales) {

        $this->setDefault($default);
        $this->_locales = $locales;
    }

    /**
     *
     * @return void
     */
    public function setDefault($locale) {

        setlocale(LC_ALL, $locale);
        putenv('LC_ALL=' . $locale);
        $this->_default = $locale;
    }

    /**
     *
     * @return string
     */
    public function getLocale() {

        return $this->_default;
    }

    /**
     *
     * @return string
     */
    public function getLang() {

        $info = explode('_', $this->_default, 1);
        return $info[0];
    }

    /**
     *
     * @return array
     */
    public function getLocales() {

        return $this->_locales;
    }

    /**
     *
     * @param $locale string
     * @return void
     */
    public function addLocale($locale) {

        $this->_locales[] = $locale;
    }
}
