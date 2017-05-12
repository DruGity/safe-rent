<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\ReportRepository")
 */
class Report
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
     * @Assert\NotBlank(message="Поле Жалоба не должно быть пустым")
     * @ORM\Column(name="report", type="text")
     */
    private $report;


    /**
     * @var Renters
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Renters", inversedBy="reportsList", cascade={"persist"})
     * @ORM\JoinColumn(name="renter", referencedColumnName="id")
     *
     */
    private $renter;


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
     * Set report
     *
     * @param string $report
     *
     * @return Report
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return string
     */
    public function getReport()
    {
        return $this->report;
    }


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Report
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
     * Set renter
     *
     * @param \DefaultBundle\Entity\Renters $renter
     *
     * @return Report
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
