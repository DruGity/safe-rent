<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentsToRenter
 *
 * @ORM\Table(name="comments_to_renter")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\CommentsToRenterRepository")
 */
class CommentsToRenter
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
     * @var Renters
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Renters", inversedBy="comments")
     * @ORM\JoinColumn(name="renterId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $renter;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="text")
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="Mark", type="integer")
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateOfRenting", type="datetime")
     */
    private $dateOfRenting;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateofLeaving", type="datetime")
     */
    private $dateofLeaving;


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
     * Set text
     *
     * @param string $text
     *
     * @return CommentsToRenter
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     *
     * @return CommentsToRenter
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return int
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set dateCreatedAt
     *
     * @param \DateTime $dateCreatedAt
     *
     * @return CommentsToRenter
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
     * Set dateOfRenting
     *
     * @param \DateTime $dateOfRenting
     *
     * @return CommentsToRenter
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
     * Set dateofLeaving
     *
     * @param \DateTime $dateofLeaving
     *
     * @return CommentsToRenter
     */
    public function setDateofLeaving($dateofLeaving)
    {
        $this->dateofLeaving = $dateofLeaving;

        return $this;
    }

    /**
     * Get dateofLeaving
     *
     * @return \DateTime
     */
    public function getDateofLeaving()
    {
        return $this->dateofLeaving;
    }

    /**
     * Set renter
     *
     * @param \DefaultBundle\Entity\Renters $renter
     *
     * @return CommentsToRenter
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
