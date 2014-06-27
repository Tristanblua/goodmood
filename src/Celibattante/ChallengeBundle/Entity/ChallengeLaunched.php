<?php

namespace Celibattante\ChallengeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Celibattante\ChallengeBundle\Entity\ChallengeSuper as BaseChallenge;

/**
 * ChallengeLaunched
 *
 * @ORM\Table(name="challenge_launched")
 * @ORM\Entity(repositoryClass="Celibattante\ChallengeBundle\Entity\ChallengeLaunchedRepository")
 */
class ChallengeLaunched extends BaseChallenge
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
     * @ORM\ManyToOne(targetEntity="Celibattante\UserBundle\Entity\User", inversedBy="challengeLaunched")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * Set title
     *
     * @param string $title
     * @return ChallengeLaunched
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set user
     *
     * @param \Celibattante\UserBundle\Entity\User $user
     * @return ChallengeLaunched
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
