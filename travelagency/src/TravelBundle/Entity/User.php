<?php

namespace TravelBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\OneToMany(targetEntity="Travel", mappedBy="users")
     */
    private $travel;


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add travel
     *
     * @param \TravelBundle\Entity\Travel $travel
     *
     * @return User
     */
    public function addTravel(\TravelBundle\Entity\Travel $travel)
    {
        $this->travel[] = $travel;

        return $this;
    }

    /**
     * Remove travel
     *
     * @param \TravelBundle\Entity\Travel $travel
     */
    public function removeTravel(\TravelBundle\Entity\Travel $travel)
    {
        $this->travel->removeElement($travel);
    }

    /**
     * Get travel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTravel()
    {
        return $this->travel;
    }
}
