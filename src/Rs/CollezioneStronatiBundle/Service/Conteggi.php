<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 08/10/14
 * Time: 22.45
 */

namespace Rs\CollezioneStronatiBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class Conteggi {
    protected $twig;
    protected $em;

    public function __construct(\Twig_Environment $twig,ObjectManager $em)
    {
        $this->twig = $twig;
        $this->em = $em;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $conteggi = $this->em->getRepository('RsCollezioneStronatiBundle:Oggetto')->getConteggiOggetti();

        $this->twig->addGlobal('conteggio_mignon', $conteggi['mignon']);
        $this->twig->addGlobal('conteggio_bicchieri', $conteggi['bicchieri']);
        $this->twig->addGlobal('conteggio_profumi', $conteggi['profumi']);

    }
} 