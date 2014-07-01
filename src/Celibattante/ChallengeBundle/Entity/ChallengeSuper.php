<?php

namespace Celibattante\ChallengeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;


/**
* @ORM\MappedSuperclass
*
* @ExclusionPolicy("all")
*/
class ChallengeSuper
{
	/**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=140, nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     * @Expose
     */

    public $path;

    /**
     * @var string
     *
     * @ORM\Column(name="creation_date", type="date")
     * @Expose
     */

    public $creation_date;


    /**
     * @var string
     *
     * @ORM\Column(name="count", type="integer")
     * @Expose
     */

    public $count;

    /**
     * @Assert\File(maxSize="2000000")
     */
    public $file;


    public function __construct() {
        $this->creation_date = new \DateTime;
        $this->count = 5;
    }

    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé

        // générer un nom aléatoire et essayer de deviner l'extension (plus sécurisé)
        $extension = $this->file->guessExtension();
        if (!$extension) {
            // l'extension n'a pas été trouvée
            $extension = 'bin';
        }

        $input = date('Ymd').'_'.uniqid() .'.'.$extension;
        $this->path = date('Ymd').'_'.uniqid().'.mp4';

        $this->file->move($this->getUploadRootDir(), $input);
        chmod($this->getUploadRootDir()."/".$input, 777);


        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;


        $cmd = "ffmpeg -i ". $this->getUploadRootDir()."/".$input ." -vcodec libx264 -vprofile baseline -preset slow -b:v 250k -maxrate 250k -bufsize 500k -vf scale=-1:360 -threads 0 -acodec libfdk_aac -ab 96k ". $this->getUploadRootDir()."/".$this->path ." 2>&1";
        shell_exec($cmd);

        chmod($this->getUploadRootDir()."/".$this->path, 777);
        unlink($this->getUploadRootDir()."/".$input);
    }


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }


    /**
     * Set description
     *
     * @param string $description
     * @return Upload
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set count
     *
     * @param string $count
     * @return Upload
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Upload
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

        /**
     * Set creation_date
     *
     * @param string $creation_date
     * @return Upload
     */
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * Get creation_date
     *
     * @return string
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }

}
