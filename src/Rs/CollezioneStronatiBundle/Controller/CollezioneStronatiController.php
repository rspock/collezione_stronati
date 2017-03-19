<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 04/10/14
 * Time: 15.09
 */

namespace Rs\CollezioneStronatiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CollezioneStronatiController extends Controller{

    public function addFlashError($msg){
        $this->get('session')->getFlashBag()->add('error',$msg);
    }

} 