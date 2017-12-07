<?php

namespace TravelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Duration
 *
 * @ORM\Table(name="duration")
 * @ORM\Entity(repositoryClass="TravelBundle\Repository\DurationRepository")
 */
class Duration
{
    /**
     * @ORM\OneToMany(targetEntity="Torder", mappedBy="durations")
     */
    private $torder;


    /**
     * @ORM\ManyToOne(targetEntity="Travel", inversedBy="durations")
     * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     */
    private $travel;


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
     * @ORM\Column(name="days", type="integer")

     */
    private $days;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=true)

     */
    private $price;

    public function __toString()
    {
        return $this->days . ' days ';
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->torder = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set days
     *
     * @param integer $days
     *
     * @return Duration
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Duration
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add torder
     *
     * @param \TravelBundle\Entity\Torder $torder
     *
     * @return Duration
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
    public function removeTorder(\TravelBundle\Entity\Torder $torder)
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
     * Set travel
     *
     * @param \TravelBundle\Entity\Travel $travel
     *
     * @return Duration
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
}
