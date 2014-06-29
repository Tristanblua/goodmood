<?php

namespace Celibattante\ChallengeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Celibattante\ChallengeBundle\Entity\ChallengeSuper as BaseChallenge;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;


/**
 * ChallengeRaised
 *
 * @ORM\Table(name="challenge_raised")
 * @ORM\Entity(repositoryClass="Celibattante\ChallengeBundle\Entity\ChallengeRaisedRepository")
 *
 * @ExclusionPolicy("all")
 */
class ChallengeRaised extends BaseChallenge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Celibattante\UserBundle\Entity\User", inversedBy="challengeRaised")
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Celibattante\UserBundle\Entity\User $user
     * @return ChallengeRaised
     */
    public function setUser(\Celibattante\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Celibattante\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
