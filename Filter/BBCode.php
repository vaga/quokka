<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Filter;

/**
 * \Quokka\Filter\BBCode
 *
 * @package Quokka
 * @subpackage Filter
 * @author Fabien Casters
 */
class BBCode extends AbstractFilter {

    private $_tags = [];

    public function __construct() {

        $this->addTag('h', new Regex('#\[h([1-6]+)](.+)\[/h\1]#isU', '<h$1>$2</h$1>'));
        $this->addTag('b', new Regex('#\[b](.+)\[/b]#isU', '<strong>$1</strong>'));
        $this->addTag('i', new Regex('#\[i](.+)\[/i]#isU', '<em>$1</em>'));
        $this->addTag('u', new Regex('#\[u](.+)\[/u]#isU', '<ins>$1</ins>'));
        $this->addTag('s', new Regex('#\[s](.+)\[/s]#isU', '<del>$1</del>'));
        $this->addTag('img', new Regex('#\[img](.+)\[/img]#isU', '<img src="$1" />'));
        $this->addTag('url', new Regex('#\[url(?|=[\'"]?+([^]"\']++)[\'"]?+]([^[]++)|](([^[]++)))\[/url]#', '<a href="$1">$2</a>'));
        $this->addTag('list', new Regex('#\[list](.+)\[/list]#isU', function ($data) {

            $list = '<ul>';
            $regex = new Regex('#\[\*](.+)(\n|\r\n?)#isU', '<li>$1</li>');
            $list .= $regex->filter($data[1]);
            return $list . '</ul>';
        }));
        $this->addTag('abbr', new Regex('#\[abbr=(.*)](.*)\[/abbr]#', '<abbr title="$1">$2</abbr>'));
    }

    /**
     *
     * @param string $name
     * @param \Quokka\Filter\Regex $regex
     * @return void
     */
    public function addTag($name, $regex) {

        $this->_tags[$name] = $regex;
    }

    /**
     *
     * @return array
     */
    public function getTags() {

        return $this->_tags;
    }

    /**
     *
     * @param $data string
     * @return string
     */
    public function filter($data = null) {

        foreach ($this->getTags() as $tag)
            $data = $tag->filter($data);

        return $data;
    }
}
