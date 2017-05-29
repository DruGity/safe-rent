<?php

namespace DefaultBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrder
 *
 * @ORM\Table(name="user_order")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\UserOrderRepository")
 */
class UserOrder
{
    const STATUS_OPEN = 1;
    const STATUS_DONE = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;
    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Users", inversedBy="orders")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\OrderAdvert", mappedBy="order" , cascade= {"persist"})
     */
    private $adverts;


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
     * Set dateCreatedAt
     *
     * @param \DateTime $dateCreatedAt
     *
     * @return UserOrder
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
     * Set status
     *
     * @param integer $status
     *
     * @return UserOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adverts = new ArrayCollection();
        $this->setDateCreatedAt(new \DateTime());
        $this->setStatus(self::STATUS_OPEN);
    }

    /**
     * @return Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * Add advert
     *
     * @param \DefaultBundle\Entity\OrderAdvert $advert
     *
     * @return UserOrder
     */
    public function addAdvert(\DefaultBundle\Entity\OrderAdvert $advert)
    {
        $advert->setOrder($this);
        $this->adverts[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \DefaultBundle\Entity\OrderAdvert $advert
     */
    public function removeAdvert(\DefaultBundle\Entity\OrderAdvert $advert)
    {
        $this->adverts->removeElement($advert);
    }

    /**
     * Get adverts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdverts()
    {
        return $this->adverts;
    }
}
