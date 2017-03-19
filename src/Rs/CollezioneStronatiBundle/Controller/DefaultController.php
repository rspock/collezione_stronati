<?php

namespace Rs\CollezioneStronatiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends CollezioneStronatiController
{
    /**
     * Lists all Mignon entities.
     *
     * @Route("/home", name="home")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Lists all Mignon entities.
     *
     * @Route("/", name="go-login")
     * @Method("GET")
     * @Template()
     */
    public function goToLoginAction()
    {
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}
