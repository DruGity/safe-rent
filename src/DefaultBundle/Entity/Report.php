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
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Users", inversedBy="reportsList", cascade={"persist"})
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     *
     */
    private $user;


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
     * Set user
     *
     * @param \DefaultBundle\Entity\Users $user
     *
     * @return Report
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
