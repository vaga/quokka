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

        $this->addTag('h', new Regex('#\[h([1-6]+)](.+)\[/h\1]\n#isU', '</p><h$1>$2</h$1><p>'));
        $this->addTag('b', new Regex('#\[b](.+)\[/b]#isU', '<strong>$1</strong>'));
        $this->addTag('i', new Regex('#\[i](.+)\[/i]#isU', '<em>$1</em>'));
        $this->addTag('u', new Regex('#\[u](.+)\[/u]#isU', '<ins>$1</ins>'));
        $this->addTag('s', new Regex('#\[s](.+)\[/s]#isU', '<del>$1</del>'));
        $this->addTag('img', new Regex('#\[img(?||=[\'"]?+([^\'"]+)[\'"]?+)](.+)\[/img]#isU', function ($data) {
            if ($data[1] == '')
                return '<img src="' . $data[2] . '" alt="Image" />';
            return '<img src="' . $data[1] . '" alt="' . $data[2] . '" />';
        }));
        $this->addTag('url', new Regex('#\[url(?|=[\'"]?+([^]"\']++)[\'"]?+]([^[]++)|](([^[]++)))\[/url]#', '<a href="$1">$2</a>'));
        $this->addTag('list', new Regex('#\[list]\n(.+)\[/list]\n#isU', function ($data) {

            $regex = new Regex('#\[\*](.+)\n#isU', '<li>$1</li>');
            return '</p><ul>' . $regex->filter($data[1]) . '</ul><p>';
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

        $data = preg_replace("/ +/", " ", $data);
        $data = str_replace(["\t", "\r"], "", $data);
        $data = str_replace(" \n", "\n", $data);

        foreach ($this->getTags() as $tag)
            $data = $tag->filter($data);

        $data = "<p>" . str_replace("\n", '<br />', $data) . "</p>";

        return $data;
    }
}
