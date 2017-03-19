<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 04/10/14
 * Time: 10.44
 */

namespace Rs\CollezioneStronatiBundle\Service;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;

class GeneratoreOggettoForm implements GeneratoreForm{

    //inniettati via servizio
    private $em;
    private $router;
    private $formFactory;

    public function __construct(ObjectManager $em, Router $router,FormFactoryInterface $formFactory )
    {
        $this->em = $em;
        $this->router = $router;
        $this->formFactory = $formFactory;
    }

    public function generaNuovoOggettoForm($formType, $oggetto, $nomeUrl){

        $reflectionClasse = new \ReflectionClass($formType);
        $formType = $reflectionClasse->newInstanceArgs(array());

        $form = $this->formFactory->create($formType, $oggetto, array(
            'action' => $this->router->generate($nomeUrl),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Inserisci'));

        return $form;
    }

    public function generaModificaOggettoForm($formType, $oggetto, $nomeUrl){

    }
}