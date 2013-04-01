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

    public function validateAction() {

        $validate = new \Quokka\Validate\Alpha();
        if ($validate->isValid('jesuisuntest'))
            echo '"jesuisuntest" is Alpha !';
        if (!$validate->isValid('jesuisun test'))
            echo '"jesuisun test" is not Alpha !';
    }

    public function filterAction() {

        $filter = new \Quokka\Filter\Lower();
        return $filter->filter("Je suis Un CouCou Chinois !");
    }

    public function formAction() {

        $form = new \Quokka\Form\Form();
        $form->addElement(new \Quokka\Form\Element\Text('name'));
        $form->addElement(new \Quokka\Form\Element\Text('username'));
        $form->addElement(new \Quokka\Form\Element\Text('toto'));
        if ($this->getApplication()->getRequest()->isPost()) {

            if ($form->isValid($this->getApplication()->getRequest()->getPost())) {

                echo 'is valid<br />';
            }
            echo 'is post !<br />';
        }
        echo '<form action="" method="POST">';
        echo $form->getElement('name')->render();
        echo '<input type="submit" name="toto" value="coucou" />';
        echo '</form>';
        return $form->getElement('name')->render();
    }
}
