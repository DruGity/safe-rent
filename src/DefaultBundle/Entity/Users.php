<?php
namespace DefaultBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\UsersRepository")
 */
class Users implements AdvancedUserInterface, \Serializable
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
     * @ORM\Column(name="Password", type="string", length=255)
     */
    private $password;

    private $plainPassword;
    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string", length=255, nullable=true)
     */
    private $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="secondnName", type="string", length=255)
     */
    private $secondName;
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="PhoneNumber", type="string", length=255)
     */
    private $phoneNumber;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreatedAt", type="datetime")
     */
    private $dateCreatedAt;
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\CommentsToUsers", mappedBy="user", cascade={"All"})
     */
    private $comments;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\UserOrder", mappedBy="user", cascade= {"all"})
     */
    private $orders;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\Adverts", mappedBy="user", cascade={"All"})
     */
    private $adverts;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DefaultBundle\Entity\Report", mappedBy="user", cascade={"All"})
     */
    private $reportsList;

    public function __construct()
    {
        $this->isActive = false;
        $this->setDateCreatedAt(new \DateTime());
        $this->orders = new ArrayCollection();
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
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    public function activate()
    {
        $this->isActive = true;
    }
    public function deactivate()
    {
        $this->isActive = false;
    }
    public function jsonSerialize()
    {
        return[
            'id'=>$this->getId(),
            'password'=> $this->getPassword(),
            'name'=>$this->getName(),
            'secondName'=>$this->getSecondName(),
            'login'=>$this->getLogin(),
            'phoneNumber'=>$this->getPhoneNumber(),
            'dateCreatedAt'=>$this->getDateCreatedAt(),
            'email'=>$this->getEmail(),
            'photo'=>$this->getPhoto(),
            'isActive'=>$this->isActive
        ];

    }

    public function serialize()
    {
        $data = serialize([
            $this->getId(),
            $this->getUsername(),
            $this->getPassword(),
            $this->getIsActive(),
        ]);
        return $data;
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getSalt()
    {
        return "";
    }
    public function getUsername()
    {
        return $this->getEmail();
    }
    public function eraseCredentials()
    {
    }
    public function __toString()
    {
        return $this->email;
    }
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Users
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }
    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Users
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }
    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Users
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set dateCreateAt
     *
     * @param \DateTime $dateCreatedAt
     *
     * @return Users
     */
    public function setDateCreatedAt(\DateTime $dateCreatedAt)
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
    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return $this->isActive;
    }




   /**
     * Add order
     *
     * @param \DefaultBundle\Entity\UserOrder $order
     *
     * @return Users
     */
    public function addOrder(\DefaultBundle\Entity\UserOrder $order)
    {
        $order->setUser($this);
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Get secondName
     *
     * Remove order
     *
     * @param \DefaultBundle\Entity\UserOrder $order
     */
    public function removeOrder(\DefaultBundle\Entity\UserOrder $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
    /**
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @param string $secondName
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Add comment
     *
     * @param \DefaultBundle\Entity\CommentsToUsers $comment
     *
     * @return Users
     */
    public function addComment(\DefaultBundle\Entity\CommentsToUsers $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \DefaultBundle\Entity\CommentsToUsers $comment
     */
    public function removeComment(\DefaultBundle\Entity\CommentsToUsers $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }


    /**
     * Add advert
     *
     * @param \DefaultBundle\Entity\Adverts $advert
     *
     * @return Users
     */
    public function addAdvert(\DefaultBundle\Entity\Adverts $advert)
    {
        $this->adverts[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \DefaultBundle\Entity\Adverts $advert
     */
    public function removeAdvert(\DefaultBundle\Entity\Adverts $advert)
    {
        $this->adverts->removeElement($advert);
    }

    /**
     * Get adverts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdverts()
    {
        return $this->adverts;
    }

    /**
     * Add reportsList
     *
     * @param \DefaultBundle\Entity\Report $reportsList
     *
     * @return Users
     */
    public function addReportsList(\DefaultBundle\Entity\Report $reportsList)
    {
        $this->reportsList[] = $reportsList;

        return $this;
    }

    /**
     * Remove reportsList
     *
     * @param \DefaultBundle\Entity\Report $reportsList
     */
    public function removeReportsList(\DefaultBundle\Entity\Report $reportsList)
    {
        $this->reportsList->removeElement($reportsList);
    }

    /**
     * Get reportsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReportsList()
    {
        return $this->reportsList;
    }

}
