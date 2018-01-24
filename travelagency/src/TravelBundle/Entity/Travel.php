<?php

namespace TravelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="TravelBundle\Repository\TravelRepository")
 */
class Travel
{


    /**
     * @ORM\OneToMany(targetEntity="Torder", mappedBy="travel")
     */
    private $torder;


    /**
     * @ORM\OneToMany(targetEntity="Packages", mappedBy="travel")
     *
     */

    private $travels;

    /**
     *@ORM\OneToMany(targetEntity="Duration", mappedBy="travel")
     *
     */
    private $durations;

    /**
     * @ORM\OneToMany(targetEntity="Amount", mappedBy="travel")
     *
     */
    private $amounts;


    public function __toString()
    {
       return $this->name;
    }

    public function __construct()
    {
     $this->travels= new ArrayCollection();
     $this->durations= new ArrayCollection();
     $this->amounts= new ArrayCollection();
     $this->torder= new ArrayCollection();
     $this->date= new \DateTime();
    }

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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;


   /**
     * @var string
     *
     * @ORM\Column(name="Longdescription", type="string", length=1200)
     */
    private $Longdescription;


 /**
     * @var string
     *
     * @ORM\Column(name="price_from", type="integer")
     */
    private $priceFrom;


    /**
     * @var string
     *
     * @ORM\Column(name="data_from", type="date")
     */
    private $dateFrom;




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
     * Set name
     *
     * @param string $name
     *
     * @return Travel
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
     * Set description
     *
     * @param string $description
     *
     * @return Travel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set longdescription
     *
     * @param string $longdescription
     *
     * @return Travel
     */
    public function setLongdescription($longdescription)
    {
        $this->Longdescription = $longdescription;

        return $this;
    }

    /**
     * Get longdescription
     *
     * @return string
     */
    public function getLongdescription()
    {
        return $this->Longdescription;
    }

    /**
     * Set priceFrom
     *
     * @param integer $priceFrom
     *
     * @return Travel
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    /**
     * Get priceFrom
     *
     * @return integer
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     *
     * @return Travel
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }


    /**
     * Add torder
     *
     * @param \TravelBundle\Entity\Torder $torder
     *
     * @return Travel
     */
    public function addTorder(\TravelBundle\Entity\Torder $torder)
    {
        $this->torder[] = $torder;

        return $this;
    }

    /**
     * Remove torder
     *
     * @param \TravelBundle\Entity\Torder $torder
     */
    public function removeTorder(\TravelBundle\Entity\Torder $toorder)
    {
        $this->torder->removeElement($torder);
    }

    /**
     * Get torder
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTorder()
    {
        return $this->torder;
    }

    /**
     * Add travel
     *
     * @param \TravelBundle\Entity\Packages $travel
     *
     * @return Travel
     */
    public function addTravel(\TravelBundle\Entity\Packages $travel)
    {
        $this->travels[] = $travel;

        return $this;
    }

    /**
     * Remove travel
     *
     * @param \TravelBundle\Entity\Packages $travel
     */
    public function removeTravel(\TravelBundle\Entity\Packages $travel)
    {
        $this->travels->removeElement($travel);
    }

    /**
     * Get travels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTravels()
    {
        return $this->travels;
    }

    /**
     * Add duration
     *
     * @param \TravelBundle\Entity\Duration $duration
     *
     * @return Travel
     */
    public function addDuration(\TravelBundle\Entity\Duration $duration)
    {
        $this->durations[] = $duration;

        return $this;
    }

    /**
     * Remove duration
     *
     * @param \TravelBundle\Entity\Duration $duration
     */
    public function removeDuration(\TravelBundle\Entity\Duration $duration)
    {
        $this->durations->removeElement($duration);
    }

    /**
     * Get durations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDurations()
    {
        return $this->durations;
    }

    /**
     * Add amount
     *
     * @param \TravelBundle\Entity\Amount $amount
     *
     * @return Travel
     */
    public function addAmount(\TravelBundle\Entity\Amount $amount)
    {
        $this->amounts[] = $amount;

        return $this;
    }

    /**
     * Remove amount
     *
     * @param \TravelBundle\Entity\Amount $amount
     */
    public function removeAmount(\TravelBundle\Entity\Amount $amount)
    {
        $this->amounts->removeElement($amount);
    }

    /**
     * Get amounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAmounts()
    {
        return $this->amounts;
    }
}
