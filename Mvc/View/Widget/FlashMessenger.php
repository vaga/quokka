<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc\View\Widget;

/**
 * \Quokka\Mvc\View\Widget\FlashMessenger
 *
 * @package Quokka
 * @subpackage View
 * @author Fabien Casters
 */
class FlashMessenger extends AbstractWidget {

    /**
     * @var \Quokka\Session\Container
     */
    private $_session;

    /**
     *
     * @param $namespace string
     * @return void
     */
    public function __construct($namespace = 'success') {

        $this->_session = new \Quokka\Session\Container($namespace);
    }

    /**
     *
     * @param $message string
     * @return void
     */
    public function addMessage($message) {

        $messages = $this->getMessages();
        $messages[] = $message;
        $this->_session->set('messages', $messages);
    }

    /**
     *
     * @return boolean
     */
    public function hasMessage() {

        return (count($this->getMessages())) ? true : false;
    }

    /**
     *
     * @return array
     */
    public function getMessages() {

        return $this->_session->get('messages', []);
    }

    /**
     *
     * @return void
     */
    public function clear() {

        $this->_session->set('messages', []);
    }

    /**
     *
     * @return string
     */
    public function render() {

        $html = '';
        if ($this->hasMessage()) {

            $html = '<div class="success"><ul>';
            foreach ($this->getMessages() as $message) {

                $html .= '<li>' . $message . '</li>';
            }
            $html .= '</ul></div>';
            $this->clear();
        }
        return $html;
    }
}
