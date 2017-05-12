<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReadyBet
 *
 * @ORM\Table(name="ready_bet")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\ReadyBetRepository")
 */
class ReadyBet
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
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Renters", inversedBy="readyBets")
     * @ORM\JoinColumn(name="renterId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $renter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="Status", type="integer")
     */
    private $status;


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
     * @return ReadyBet
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
     * Set dateCreatedAt
     *
     * @param \DateTime $dateCreatedAt
     *
     * @return ReadyBet
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
     * @return ReadyBet
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
     * Set renter
     *
     * @param \DefaultBundle\Entity\Renters $renter
     *
     * @return ReadyBet
     */
    public function setRenter(\DefualtBundle\Entity\Renters $renter = null)
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
