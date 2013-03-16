<?php

namespace Application\Controller;

class IndexController extends \Quokka\Mvc\Controller\AbstractController
{
    public function indexAction()
    {
        $db = $this->getApplication()->getResource('db');
        $select = $db->prepare("SELECT * FROM t_news");
        $select->execute();

        return $this->render([
            'news' => $select->fetchAll()
        ]);
    }

    public function totoAction()
    {
        return "Coucou tu veux voir ma  bite";
    }
}
