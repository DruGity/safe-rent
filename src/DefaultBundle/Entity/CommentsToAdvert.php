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
     * @var string
     * @Assert\NotBlank(message="Поле комментарий не должно быть пустым")
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="commentator", type="text")
     */
    private $commentator;

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
     * @var Adverts
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Adverts", inversedBy="comments")
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
     * Set advert
     *
     * @param \DefaultBundle\Entity\Adverts $advert
     *
     * @return CommentsToAdvert
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

    /**
     * Set commentator
     *
     * @param string $commentator
     *
     * @return CommentsToAdvert
     */
    public function setCommentator($commentator)
    {
        $this->commentator = $commentator;

        return $this;
    }

    /**
     * Get commentator
     *
     * @return string
     */
    public function getCommentator()
    {
        return $this->commentator;
    }
}
