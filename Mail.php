<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka;

/**
 * \Quokka\Mail
 *
 * @package Quokka
 * @author Fabien Casters
 */
class Mail {

    /**
     * @var array
     */
    private $_to = [];

    /**
     * @var array
     */
    private $_from = '';

    /**
     * @var array
     */
    private $_headers = [];

    /**
     * @var string
     */
    private $_subject = '';

    /**
     * @var string
     */
    private $_body = '';

    /**
     *
     * @param $name string
     * @param $from string
     * @return void
     */
    public function setFrom($name, $mail) {

        $this->_from = $name . ' <' . $mail . '>';
    }

    /**
     *
     * @param $name string
     * @param $mail string
     * @return void
     */
    public function addTo($name, $mail) {

        $this->_to[] = $name . ' <' . $mail . '>';
    }

    /**
     *
     * @param $key string
     * @param $value string
     */
    public function addHeader($key, $value) {

        $this->_headers[$key] = $value;
    }


    /**
     *
     * @param $subject string
     * @return void
     */
    public function setSubject($subject) {

        $this->_subject = $subject;
    }

    /**
     *
     * @param $body string
     * @return void
     */
    public function setBody($body) {

        $this->_body = $body;
    }

    /**
     *
     * @return boolean
     */
    public function send() {

        $to = implode(', ', $this->_to);
        $this->addHeader('From', $this->_from);
        $headers = [];
        foreach($this->_headers as $key => $value)
            $headers[] = $key . ': ' . $value;
        $headers = implode("\r\n", $headers);

        return mail($to, $this->_subject, $this->_body, $headers);
    }
}
