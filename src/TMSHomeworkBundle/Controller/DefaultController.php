<?php

namespace TMSHomeworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('fos_user_security_login');
        //return $this->render('TMSHomeworkBundle:Default:index.html.twig');
    }
}
