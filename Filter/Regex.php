<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\Regex
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class Regex extends AbstractFilter {

    /**
     * @var string
     */
    private $_pattern = '//';

    /**
     * @var mixed
     */
    private $_replacement = '';

    /**
     *
     * @param string
     * @param mixed
     * @return void
     */
    public function __construct($pattern, $replacement) {

        $this->_pattern = $pattern;
        $this->_replacement = $replacement;
    }

    /**
     *
     * @return string
     */
    public function getPattern() {

        return $this->_pattern;
    }

    /**
     *
     * @return mixed
     */
    public function getReplacement() {

        return $this->_replacement;
    }

    /**
     *
     * @param $data string
     * @return string
     */
    public function filter($data = null) {

        if (is_callable($this->getReplacement()))
            return preg_replace_callback($this->getPattern(), $this->getReplacement(), $data);

        return preg_replace($this->getPattern(), $this->getReplacement(), $data);
    }
}
