<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuctionBet
 *
 * @ORM\Table(name="auction_bet")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\AuctionBetRepository")
 */
class AuctionBet
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
     * @var int
     *
     * @ORM\Column(name="Advert_id", type="integer")
     */
    private $advertId;

    /**
     * @var Renters
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Renters", inversedBy="auctionBets")
     * @ORM\JoinColumn(name="renterId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $renter;

    /**
     * @var float
     *
     * @ORM\Column(name="FullSum", type="float")
     */
    private $fullSum;


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
     * Set advertId
     *
     * @param integer $advertId
     *
     * @return AuctionBet
     */
    public function setAdvertId($advertId)
    {
        $this->advertId = $advertId;

        return $this;
    }

    /**
     * Get advertId
     *
     * @return int
     */
    public function getAdvertId()
    {
        return $this->advertId;
    }

    /**
     * Set fullSum
     *
     * @param float $fullSum
     *
     * @return AuctionBet
     */
    public function setFullSum($fullSum)
    {
        $this->fullSum = $fullSum;

        return $this;
    }

    /**
     * Get fullSum
     *
     * @return float
     */
    public function getFullSum()
    {
        return $this->fullSum;
    }

    /**
     * Set renter
     *
     * @param \DefaultBundle\Entity\Renters $renter
     *
     * @return AuctionBet
     */
    public function setRenter(\DefaultBundle\Entity\Renters $renter = null)
    {
        $this->renter = $renter;

        return $this;
    }

    /**
     * Get renter
     *
     * @return \DefaultBundle\Entity\Renters
     */
    public function getRenter()
    {
        return $this->renter;
    }
}
