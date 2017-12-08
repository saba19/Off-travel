<?php

namespace TravelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Torder
 *
 * @ORM\Table(name="torder")
 * @ORM\Entity(repositoryClass="TravelBundle\Repository\TorderRepository")
 */
class Torder
{
    /**
     * @ORM\ManyToOne(targetEntity="Travel", inversedBy="torders")
     * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     */
    private $travel;

     /**
     * @ORM\ManyToOne(targetEntity="Packages", inversedBy="torders")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $package;

 /**
     * @ORM\ManyToOne(targetEntity="Amount", inversedBy="torders")
     * @ORM\JoinColumn(name="amount_id", referencedColumnName="id")
     */
    private $amount;
     /**
     * @ORM\ManyToOne(targetEntity="Duration", inversedBy="torders")
     * @ORM\JoinColumn(name="duration_id", referencedColumnName="id")
     */
    private $duration;


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
     * @ORM\Column(name="comments", type="string", length=600,  nullable=true)
     */
    private $comments;


    /**
     * @var string
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=60,  nullable=true)
     */
    private $email;

    /**
     * @var string
     * @Assert\Length(
     * min = 6,
     * max = 12,
     * minMessage = "Your phone number must be at least {{ limit }} digits",
     * maxMessage = "Your phone number cannot be longer than {{ limit }} digits"
     * )
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;

    public function __toString()
    {
        return $this->phone;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Torder
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Torder
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return Torder
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set travel
     *
     * @param \TravelBundle\Entity\Travel $travel
     *
     * @return Torder
     */
    public function setTravel(\TravelBundle\Entity\Travel $travel = null)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return \TravelBundle\Entity\Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set package
     *
     * @param \TravelBundle\Entity\Packages $package
     *
     * @return Torder
     */
    public function setPackage(\TravelBundle\Entity\Packages $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \TravelBundle\Entity\Packages
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set amount
     *
     * @param \TravelBundle\Entity\Amount $amount
     *
     * @return Torder
     */
    public function setAmount(\TravelBundle\Entity\Amount $amount = null)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return \TravelBundle\Entity\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set duration
     *
     * @param \TravelBundle\Entity\Duration $duration
     *
     * @return Torder
     */
    public function setDuration(\TravelBundle\Entity\Duration $duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \TravelBundle\Entity\Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }
}
