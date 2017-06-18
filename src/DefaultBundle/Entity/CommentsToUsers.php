<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentsToUsers
 *
 * @ORM\Table(name="comments_to_users")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\CommentsToUsersRepository")
 */
class CommentsToUsers
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
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Users", inversedBy="comments")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

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
     * @return CommentsToUsers
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
     * @return CommentsToUsers
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
     * @return CommentsToUsers
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
     * @return CommentsToUsers
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
     * @return CommentsToUsers
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
     * Set user
     *
     * @param \DefaultBundle\Entity\Users $user
     *
     * @return CommentsToUsers
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
}
