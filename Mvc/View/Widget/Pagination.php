<?php

/**
 * Quokka Framework
 *
 * @copyright Copyright 2012 Fabien Casters
 * @license http://www.gnu.org/licenses/lgpl.html Lesser General Public License
 */

namespace Quokka\Mvc\View\Widget;

/**
 * \Quokka\Mvc\View\Widget\Pagination
 *
 * @package Quokka
 * @subpackage View
 * @author Fabien Casters
 */
class Pagination extends AbstractWidget {

    /**
     * @var integer
     */
    private $_currentPage = 1;

    /**
     * @var integer
     */
    private $_rowsPerPage = 20;

    /**
     * @var integer
     */
    private $_totalRows = 0;

    /**
     * @var integer
     */
    private $_maxPage = 11;

    /**
     * @string
     */
    private $_url = '%d';

    /**
     *
     * @param integer $currentPage
     * @return void
     */
    public function setCurrentPage($currentPage) {

        $this->_currentPage = $currentPage;
    }

    /**
     *
     * @return integer
     */
    public function getCurrentPage() {

        return $this->_currentPage;
    }

    /**
     *
     * @param integer $rowsPerPage
     * @return void
     */
    public function setRowsPerPage($rowsPerPage) {

        $this->_rowsPerPage = $rowsPerPage;
    }

    /**
     *
     * @return integer
     */
    public function getRowsPerPage() {

        return $this->_rowsPerPage;
    }

    /**
     *
     * @param integer $totalRows
     * @return void
     */
    public function setTotalRows($totalRows) {

        $this->_totalRows = $totalRows;
    }

    /**
     *
     * @return integer
     */
    public function getTotalRows() {

        return $this->_totalRows;
    }

    /**
     *
     * @param integer $maxPage
     * @return void
     */
    public function setMaxPage($maxPage) {

        $this->_maxPage = $maxPage;
    }

    /**
     *
     * @return integer
     */
    public function getMaxPage() {

        return $this->_maxPage;
    }

    /**
     *
     * @param integer $url
     * @return void
     */
    public function setUrl($url) {

        $this->_url = $url;
    }

    /**
     *
     * @param integer $page
     * @return string
     */
    public function getUrl($page) {

        return sprintf($this->_url, $page);
    }

    /**
     *
     * @return integer
     */
    public function getTotalPages() {

        if ($this->getTotalRows() == 0)
            $pages = 1;
        else
            $pages = floor($this->getTotalRows() / $this->getRowsPerPage());
        if (($this->getTotalRows() % $this->getRowsPerPage()) > 0)
            $pages += 1;
        return $pages;
    }

    public function hasNextUrl() {

        if ($this->getTotalPages() > $this->getCurrentPage())
            return true;
        return false;
    }

    public function getNextUrl() {

        if ($this->hasNextUrl())
            return $this->getUrl($this->getCurrentPage() + 1);
        return $this->getUrl($this->getCurrentPage());
    }

    public function hasPreviousUrl() {

        if (1 < $this->getCurrentPage())
            return true;
        return false;
    }

    public function getPreviousUrl() {

        if ($this->hasPreviousUrl())
            return $this->getUrl($this->getCurrentPage() - 1);
        return $this->getUrl($this->getCurrentPage());
    }

    /**
     *
     * @return string
     */
    public function render() {

        $nbPage = $this->getMaxPage();
        $pages = ($this->getTotalPages() > $nbPage) ? $nbPage : $this->getTotalPages();
        $index = ($this->getCurrentPage() - round($nbPage / 2) > 1) ? $this->getCurrentPage() - round($nbPage / 2) + 1 : 1;

        $html = '<ul class="pagination">';
        $html .= '<li class="previous"><a href="' . $this->getPreviousUrl() . '">&larr;</a></li>';
        for ($i = $index; $i < $pages + $index; ++$i) {

            if ($this->getCurrentPage() != $i)
                $html .= '<li><a href="' . $this->getUrl($i) . '">' . $i . '</a></li>';
            else
                $html .= '<li class="active"><a href="#">' . $i . '</a></li>';
        }
        $html .= '<li class="next"><a href="' . $this->getNextUrl() . '">&rarr;</a></li>';
        $html .= '</ul>';
        return $html;
    }
}
