<?php

namespace TravelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packages
 *
 * @ORM\Table(name="packages")
 * @ORM\Entity(repositoryClass="TravelBundle\Repository\PackagesRepository")
 */
class Packages
{
    /**
     * @ORM\OneToMany(targetEntity="Torder", mappedBy="package")
     */
    private $torder;

    /**
     * @ORM\ManyToOne(targetEntity="Travel", inversedBy="packages")
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="descript", type="string", length=100)
     */
    private $descript;


    /**
     * @var string
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;


    public function __toString()
    {
        return $this->name . ' ' . $this->price . " PLN";
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
     * Set name
     *
     * @param string $name
     *
     * @return Packages
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
     * Set descript
     *
     * @param string $descript
     *
     * @return Packages
     */
    public function setDescript($descript)
    {
        $this->descript = $descript;

        return $this;
    }

    /**
     * Get descript
     *
     * @return string
     */
    public function getDescript()
    {
        return $this->descript;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Packages
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
     * @return Packages
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
     * @return Packages
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
