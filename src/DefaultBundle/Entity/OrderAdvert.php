<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderAdvert
 *
 * @ORM\Table(name="order_advert")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\OrderAdvertRepository")
 */
class OrderAdvert
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
     * @ORM\Column(name="idAdvert", type="string", length=255)
     */
    private $idAdvert;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="pricePerMonth", type="float")
     */
    private $pricePerMonth;
    /**
     * @var UserOrder
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\UserOrder", inversedBy="adverts")
     * @ORM\JoinColumn(name="id_order", referencedColumnName="id")
     */
    private $order;


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
     * Set description
     *
     * @param string $description
     *
     * @return OrderAdvert
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
     * Set pricePerMonth
     *
     * @param float $pricePerMonth
     *
     * @return OrderAdvert
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
     * Set idAdvert
     *
     * @param string $idAdvert
     *
     * @return OrderAdvert
     */
    public function setIdAdvert($idAdvert)
    {
        $this->idAdvert = $idAdvert;

        return $this;
    }

    /**
     * Get idAdvert
     *
     * @return string
     */
    public function getIdAdvert()
    {
        return $this->idAdvert;
    }

    /**
     * Set order
     *
     * @param \DefaultBundle\Entity\UserOrder $order
     *
     * @return OrderAdvert
     */
    public function setOrder(\DefaultBundle\Entity\UserOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \DefaultBundle\Entity\UserOrder
     */
    public function getOrder()
    {
        return $this->order;
    }
}
