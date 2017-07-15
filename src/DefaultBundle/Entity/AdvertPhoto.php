<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertPhoto
 *
 * @ORM\Table(name="advert_photo")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\AdvertPhotoRepository")
 */
class AdvertPhoto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="smallImage", type="string", length=255)
     */
    private $smallImage;

    /**
     * @var string
     *
     * @ORM\Column(name="originalImage", type="string", length=255, unique=true)
     */
    private $originalImage;

    /**
     * @var Adverts
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Adverts", inversedBy="photos")
     * @ORM\JoinColumn(name="id_advert", referencedColumnName="id", onDelete="CASCADE")
     */
    private $advert;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return AdvertPhoto
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
     * Set smallImage
     *
     * @param string $smallImage
     *
     * @return AdvertPhoto
     */
    public function setSmallImage($smallImage)
    {
        $this->smallImage = $smallImage;

        return $this;
    }

    /**
     * Get smallImage
     *
     * @return string
     */
    public function getSmallImage()
    {
        return $this->smallImage;
    }

    /**
     * Set originalImage
     *
     * @param string $originalImage
     *
     * @return AdvertPhoto
     */
    public function setOriginalImage($originalImage)
    {
        $this->originalImage = $originalImage;

        return $this;
    }

    /**
     * Get originalImage
     *
     * @return string
     */
    public function getOriginalImage()
    {
        return $this->originalImage;
    }

    /**
     * Set advert
     *
     * @param \DefaultBundle\Entity\Adverts $advert
     *
     * @return AdvertPhoto
     */
    public function setAdvert(\DefaultBundle\Entity\Adverts $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \DefaultBundle\Entity\Adverts
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    public function jsonSerialize()
    {
        return[
            "id" =>$this->getId(),
            'title' => $this->getTitle(),
            'smallImage' => $this->getSmallImage(),
            'originalImage' => $this->getOriginalImage()
        ];
    }

    public function jsonDeSerialize( array $data){
        $this->setSmallImage($data['smallImage']);
        $this->setOriginalImage($data['originalImage']);
        $this->setTitle($data['title']);
            }

}
