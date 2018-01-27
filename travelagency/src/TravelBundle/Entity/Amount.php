<?php

namespace TravelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Amount
 *
 * @ORM\Table(name="amount")
 * @ORM\Entity(repositoryClass="TravelBundle\Repository\AmountRepository")
 */
class Amount
{
    /**
     * @ORM\OneToMany(targetEntity="Torder", mappedBy="amount")
     */
    private $torder;



    /**
     * @ORM\ManyToOne(targetEntity="Travel", inversedBy="amounts")
     * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     * @Assert\NotBlank
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
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    public function __toString()
    {
        return $this->type . ' ' . $this->price . " PLN";
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
     * Set price
     *
     * @param integer $price
     *
     * @return Amount
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
     * Set type
     *
     * @param string $type
     *
     * @return Amount
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add torder
     *
     * @param \TravelBundle\Entity\Torder $torder
     *
     * @return Amount
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
     * @return Amount
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
