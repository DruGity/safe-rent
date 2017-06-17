<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * CommentsToAdvert
 *
 * @ORM\Table(name="comments_to_advert")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\CommentsToAdvertRepository")
 */
class CommentsToAdvert
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
    private $advertId; // дописать связь

    /**
     * @var int
     *
     * @ORM\Column(name="User_id", type="integer")
     */
    private $userId; // дописать связь

    /**
     * @var string
     * @Assert\NotBlank(message="Поле комментарий не должно быть пустым")
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     *  @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Пожалуйста, оцените по шкале от 1 до 5",
     *      maxMessage = "Пожалуйста, оцените по шкале от 1 до 5"
     *)
     * @ORM\Column(name="Mark", type="integer", nullable=true)
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\CommentPhoto", mappedBy="comment", cascade={"All"})
     */
    private $photosToComment;

    /**
     * @var Adverts
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Adverts", inversedBy="commentsList", cascade={"persist"})
     * @ORM\JoinColumn(name="id_advert", referencedColumnName="id")
     */
    private $advert;

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
     * Set advertId
     *
     * @param integer $advertId
     *
     * @return CommentsToAdvert
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return CommentsToAdvert
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return CommentsToAdvert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     *
     * @return CommentsToAdvert
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
     * @return CommentsToAdvert
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
     * Add photosToComment
     *
     * @param \DefaultBundle\Entity\CommentPhoto $photosToComment
     *
     * @return CommentsToAdvert
     */
    public function addPhotosToComment(\DefaultBundle\Entity\CommentPhoto $photosToComment)
    {
        $this->photosToComment[] = $photosToComment;

        return $this;
    }

    /**
     * Remove photosToComment
     *
     * @param \DefaultBundle\Entity\CommentPhoto $photosToComment
     */
    public function removePhotosToComment(\DefaultBundle\Entity\CommentPhoto $photosToComment)
    {
        $this->photosToComment->removeElement($photosToComment);
    }

    /**
     * Get photosToComment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotosToComment()
    {
        return $this->photosToComment;
    }

    /**
     * Set advert
     *
     * @param \DefaultBundle\Entity\Advert $advert
     *
     * @return CommentsToAdvert
     */
    public function setAdvert(\DefaultBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \DefaultBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
