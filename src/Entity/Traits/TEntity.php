<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */
namespace Common\Entity\Traits;


use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Zend\Hydrator\ClassMethods;

/**
 * Class TEntity
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Entity\Traits
 */
trait TEntity
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     * @Serializer\Type("boolean")
     * @Serializer\Exclude
     * @var bool
     */
    protected $active;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @Serializer\Type("DateTime")
     * @var DateTime
     */
    protected $created;

    /**
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     * @Serializer\Type("DateTime")
     * @var DateTime
     */
    protected $updated;

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
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new DateTime();
        $this->updated = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new DateTime();
    }

    /**
     * hydrate
     *
     * @param $data
     * @return $this
     */
    public function hydrate($data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);

        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return TEntity
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     * @return TEntity
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     * @return TEntity
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }


}