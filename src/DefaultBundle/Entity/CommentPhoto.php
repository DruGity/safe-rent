<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CommentPhoto
 *
 * @ORM\Table(name="comment_photo")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\CommentPhotoRepository")
 */
class CommentPhoto
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
     * @ORM\Column(name="fileName", type="string", length=255, unique=true)
     */
    private $fileName;

    /**
     * @var CommentsToAdvert
     *
     *@ORM\ManyToOne(targetEntity="DefaultBundle\Entity\CommentsToAdvert", inversedBy="photosToComment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $comment;  // Будет связь и две переменные для двух типов комментов


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
     * Set fileName
     *
     * @param string $fileName
     *
     * @return CommentPhoto
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set commentId
     *
     * @param integer $commentId
     *
     * @return CommentPhoto
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * Get commentId
     *
     * @return int
     */
    public function getCommentId()
    {
        return $this->commentId;
    }


    /**
     * Set comment
     *
     * @param \DefaultBundle\Entity\CommentToAdvert $comment
     *
     * @return CommentPhoto
     */
    public function setComment(\DefaultBundle\Entity\CommentToAdvert $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \DefaultBundle\Entity\CommentToAdvert
     */
    public function getComment()
    {
        return $this->comment;
    }
}
