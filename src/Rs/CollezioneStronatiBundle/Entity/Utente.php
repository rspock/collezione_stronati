<?php
// src/Acme/UserBundle/Entity/User.php

namespace Rs\CollezioneStronatiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="utenti")
 */
class Utente extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct() {
        parent::__construct();
        parent::setRoles(array('ROLE_USER'));
    }

}