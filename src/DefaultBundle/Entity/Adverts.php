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
     * @var Users
     *
     * @ORM\Column(name="User_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="City_id", type="integer")
     */
    private $cityId;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Поле район не должно быть пустым")
     * @ORM\Column(name="District", type="string", length=255)
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
     * @Assert\NotBlank(message="Поле конечная дата аукциона не должно быть пустым")
     * @ORM\Column(name="end_date_of_auction", type="datetime")
     */
    private $endDateOfAuction;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="Поле дата начала сьема не должно быть пустым")
     * @ORM\Column(name="date_of_renting", type="datetime")
     */
    private $dateOfRenting;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Поле дети или животные не должно быть пустым")
     * @ORM\Column(name="children_or_animals", type="string", length=255, nullable = true)
     */
    private $childrenOrAnimals;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\CommentPhoto", mappedBy="advert", cascade={"All"})
     */
    private $commentsList;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\Media", mappedBy="advert", cascade={"All"})
     */
    private $mediaList;

    public function __construct()
    {
        $date = new \DateTime("now");
        $this->setDateCreatedAt($date);

        $this->photos = new ArrayCollection();
    }

    public function __toString() {
        return (string)$this->id;
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Adverts
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return Users
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     *
     * @return Adverts
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
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
     * Set endDateOfAuction
     *
     * @param \DateTime $endDateOfAuction
     *
     * @return Adverts
     */
    public function setEndDateOfAuction($endDateOfAuction)
    {
        $this->endDateOfAuction = $endDateOfAuction;

        return $this;
    }

    /**
     * Get endDateOfAuction
     *
     * @return \DateTime
     */
    public function getEndDateOfAuction()
    {
        return $this->endDateOfAuction;
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
     * Set childrenOrAnimals
     *
     * @param string $childrenOrAnimals
     *
     * @return Adverts
     */
    public function setChildrenOrAnimals($childrenOrAnimals)
    {
        $this->childrenOrAnimals = $childrenOrAnimals;

        return $this;
    }

    /**
     * Get childrenOrAnimals
     *
     * @return string
     */
    public function getChildrenOrAnimals()
    {
        return $this->childrenOrAnimals;
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
     * Add commentsList
     *
     * @param \DefaultBundle\Entity\CommentsToAdvert $commentsList
     *
     * @return Adverts
     */
    public function addCommentsList(\DefaultBundle\Entity\CommentsToAdvert $commentsList)
    {
        $this->commentsList[] = $commentsList;

        return $this;
    }

    /**
     * Remove commentsList
     *
     * @param \DefaultBundle\Entity\CommentsToAdvert $commentsList
     */
    public function removeCommentsList(\DefaultBundle\Entity\CommentsToAdvert $commentsList)
    {
        $this->commentsList->removeElement($commentsList);
    }

    /**
     * Get commentsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentsList()
    {
        return $this->commentsList;
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
     * Add mediaList
     *
     * @param \DefaultBundle\Entity\Media $mediaList
     *
     * @return Adverts
     */
    public function addMediaList(\DefaultBundle\Entity\Media $mediaList)
    {
        $this->mediaList[] = $mediaList;

        return $this;
    }

    /**
     * Remove mediaList
     *
     * @param \DefaultBundle\Entity\Media $mediaList
     */
    public function removeMediaList(\DefaultBundle\Entity\Media $mediaList)
    {
        $this->mediaList->removeElement($mediaList);
    }

    /**
     * Get mediaList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediaList()
    {
        return $this->mediaList;
    }
}
