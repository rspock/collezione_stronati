<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 04/10/14
 * Time: 10.36
 */

namespace Rs\CollezioneStronatiBundle\Service;


interface GeneratoreForm {

    public function generaNuovoOggettoForm($formType, $oggetto, $nomeUrl);

    public function generaModificaOggettoForm($formType, $oggetto, $nomeUrl);

} 