<?php


namespace Common\Entity\Traits;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Zend\Hydrator\ClassMethods;

/**
 *
 * @ORM\MappedSuperclass(repositoryClass="Doctrine\ORM\EntityRepository")
 */
trait TEntity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
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
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
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
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;
    }

}