<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 08/10/14
 * Time: 23.46
 */

namespace Rs\CollezioneStronatiBundle\Service;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GestoreAccessoNegato {

    protected $router;

    public function __construct(Router $router){
        $this->router = $router;
    }
    public function onAccessDeniedException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        //Get the root cause of the exception.
        while (null !== $exception->getPrevious()) {
            $exception = $exception->getPrevious();
        }
        if ($exception instanceof AccessDeniedException) {
            $session = $event->getRequest()->getSession();
            if($session!=null){
                $session->getFlashBag()->add('error', 'Utenza non valida per la funzione richiesta');
            }

            $url = $this->router->generate('home');
            $response = new RedirectResponse($url);
            $event->setResponse($response);
        }
    }
} 