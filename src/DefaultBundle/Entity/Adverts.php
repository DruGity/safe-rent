<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Adverts
 *
 * @ORM\Table(name="adverts")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\AdvertsRepository")
 */
class Adverts
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
     * @Assert\NotBlank(message="Поле район не должно быть пустым")
     * @ORM\Column(name="district", type="string", length=255)
     */
    private $district;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var string
     *
     * @Assert\NotBlank(message="Поле адресс не должно быть пустым")
     * @ORM\Column(name="Adress", type="string", length=255)
     */
    private $adress;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Поле описание не должно быть пустым")
     * @ORM\Column(name="Discription", type="text", nullable=true)
     */
    private $discription;

    /**
     * @var int
     *
     * @Assert\Range(
     *      min = 1,
     *      max = 20,
     *      minMessage = "Количество комнат не может быть меньше {{ limit }} ",
     *      maxMessage = "Количество комнат не может быть больше {{ limit }}"
     *)
     * @Assert\NotBlank(message="Поле кол-во комнат не должно быть пустым")
     * @ORM\Column(name="room_count", type="integer", nullable=true)
     */
    private $roomCount;

    /**
     * @var int
     *
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Количество этажей не может быть меньше {{ limit }}",
     *      maxMessage = "Количество этажей не может быть больше {{ limit }}"
     *)
     * @Assert\NotBlank(message="Поле этаж не должно быть пустым")
     * @ORM\Column(name="Floor", type="integer", nullable=true)
     */
    private $floor;

    /**
     * @var float
     *
     *
     * @Assert\NotBlank(message="Поле цена за месяц не должно быть пустым")
     * @ORM\Column(name="price_per_month", type="float")
     */
    private $pricePerMonth;


    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="Поле дата начала сьема не должно быть пустым")
     * @ORM\Column(name="date_of_renting", type="datetime")
     */
    private $dateOfRenting;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\CommentsToAdvert", mappedBy="advert", cascade={"All"})
     */
    private $comments;



    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Users", inversedBy="adverts")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\AdvertPhoto", mappedBy="advert")
     */
    private $photos;

   // private $iconImage;

    public function __construct()
    {
        $date = new \DateTime("now");
        $this->setDateCreatedAt($date);

        $this->photos = new ArrayCollection();
    }


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
     * Set district
     *
     * @param string $district
     *
     * @return Adverts
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Adverts
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set discription
     *
     * @param string $discription
     *
     * @return Adverts
     */
    public function setDiscription($discription)
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * Get discription
     *
     * @return string
     */
    public function getDiscription()
    {
        return $this->discription;
    }

    /**
     * Set roomCount
     *
     * @param integer $roomCount
     *
     * @return Adverts
     */
    public function setRoomCount($roomCount)
    {
        $this->roomCount = $roomCount;

        return $this;
    }

    /**
     * Get roomCount
     *
     * @return int
     */
    public function getRoomCount()
    {
        return $this->roomCount;
    }

    /**
     * Set floor
     *
     * @param integer $floor
     *
     * @return Adverts
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return int
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set pricePerMonth
     *
     * @param float $pricePerMonth
     *
     * @return Adverts
     */
    public function setPricePerMonth($pricePerMonth)
    {
        $this->pricePerMonth = $pricePerMonth;

        return $this;
    }

    /**
     * Get pricePerMonth
     *
     * @return float
     */
    public function getPricePerMonth()
    {
        return $this->pricePerMonth;
    }


    /**
     * Set dateOfRenting
     *
     * @param \DateTime $dateOfRenting
     *
     * @return Adverts
     */
    public function setDateOfRenting($dateOfRenting)
    {
        $this->dateOfRenting = $dateOfRenting;

        return $this;
    }

    /**
     * Get dateOfRenting
     *
     * @return \DateTime
     */
    public function getDateOfRenting()
    {
        return $this->dateOfRenting;
    }


    /**
     * Set dateCreatedAt
     *
     * @param \DateTime $dateCreatedAt
     *
     * @return Adverts
     */
    public function setDateCreatedAt($dateCreatedAt)
    {
        $this->dateCreatedAt = $dateCreatedAt;

        return $this;
    }

    /**
     * Get dateCreatedAt
     *
     * @return \DateTime
     */
    public function getDateCreatedAt()
    {
        return $this->dateCreatedAt;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Adverts
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
     * Add comment
     *
     * @param \DefaultBundle\Entity\CommentsToAdvert $comment
     *
     * @return Adverts
     */
    public function addComment(\DefaultBundle\Entity\CommentsToAdvert $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \DefaultBundle\Entity\CommentsToAdvert $comment
     */
    public function removeComment(\DefaultBundle\Entity\CommentsToAdvert $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }


    /**
     * Set user
     *
     * @param \DefaultBundle\Entity\Users $user
     *
     * @return Adverts
     */
    public function setUser(\DefaultBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DefaultBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add photo
     *
     * @param \DefaultBundle\Entity\AdvertPhoto $photo
     *
     * @return Adverts
     */
    public function addPhoto(\DefaultBundle\Entity\AdvertPhoto $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \DefaultBundle\Entity\AdvertPhoto $photo
     */
    public function removePhoto(\DefaultBundle\Entity\AdvertPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
