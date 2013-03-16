<?php

namespace Application\Controller;

class ErrorController extends \Quokka\Mvc\Controller\AbstractController
{
    public function indexAction()
    {
        return "Error 404 Not found";
    }
}
