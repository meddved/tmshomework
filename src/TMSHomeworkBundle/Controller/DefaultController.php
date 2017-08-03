<?php

namespace TMSHomeworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TMSHomeworkBundle:Default:index.html.twig');
    }
}
