<?php

namespace Celibattante\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 *
 * @ExclusionPolicy("ALL")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=1)
     * @Expose
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     * @Expose
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=500)
     * @Expose
     * @Groups({"Details"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="birthdate", type="date")
     * @Expose
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="Celibattante\ChallengeBundle\Entity\ChallengeLaunched", mappedBy="user")
     * @Expose
     * @Groups({"ChallengeLaunched"})
     */
    private $challengeLaunched;

    /**
     * @ORM\OneToMany(targetEntity="Celibattante\ChallengeBundle\Entity\ChallengeRaised", mappedBy="user")
     * @Expose
     * @Groups({"ChallengeRaised"})
     */
    private $challengeRaised;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set genre
     *
     * @param string $genre
     * @return User
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set description
     *
     * @param \DateTime $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return \DateTime
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Add challengeLaunched
     *
     * @param \Celibattante\ChallengeBundle\Entity\ChallengeLaunched $challengeLaunched
     * @return User
     */
    public function addChallengeLaunched(\Celibattante\ChallengeBundle\Entity\ChallengeLaunched $challengeLaunched)
    {
        $this->challengeLaunched[] = $challengeLaunched;

        return $this;
    }

    /**
     * Remove challengeLaunched
     *
     * @param \Celibattante\ChallengeBundle\Entity\ChallengeLaunched $challengeLaunched
     */
    public function removeChallengeLaunched(\Celibattante\ChallengeBundle\Entity\ChallengeLaunched $challengeLaunched)
    {
        $this->challengeLaunched->removeElement($challengeLaunched);
    }

    /**
     * Get challengeLaunched
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChallengeLaunched()
    {
        return $this->challengeLaunched;
    }

    /**
     * Add challengeRaised
     *
     * @param \Celibattante\ChallengeBundle\Entity\ChallengeRaised $challengeRaised
     * @return User
     */
    public function addChallengeRaised(\Celibattante\ChallengeBundle\Entity\ChallengeRaised $challengeRaised)
    {
        $this->challengeRaised[] = $challengeRaised;

        return $this;
    }

    /**
     * Remove challengeRaised
     *
     * @param \Celibattante\ChallengeBundle\Entity\ChallengeRaised $challengeRaised
     */
    public function removeChallengeRaised(\Celibattante\ChallengeBundle\Entity\ChallengeRaised $challengeRaised)
    {
        $this->challengeRaised->removeElement($challengeRaised);
    }

    /**
     * Get challengeRaised
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChallengeRaised()
    {
        return $this->challengeRaised;
    }

}
