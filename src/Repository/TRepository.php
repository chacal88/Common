<?php


namespace Common\Repository;

use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;


/**
 * Class TRepository
 * @package Common\Repository
 */
trait TRepository
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param $entity
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function save($entity)
    {
        $this->em->getConnection()->beginTransaction();

        try {

            $this->em->persist($entity);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (UniqueConstraintViolationException $ex) {

            $this->em->getConnection()->rollBack();
            $error = sprintf('Entidade ja cadastrada "%s/%s"', $entity->getId, get_class($entity));
            throw new InvalidArgumentException($error, 409, $ex);
        } catch (\Exception $ex) {
            $this->em->getConnection()->rollBack();

            throw new InvalidArgumentException($ex->getMessage(), 500, $ex);
        }

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function update($entity)
    {
        $this->em->getConnection()->beginTransaction();

        try {

            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (UniqueConstraintViolationException $ex) {

            $this->em->getConnection()->rollBack();
            $error = sprintf('Entidade ja cadastrada "%s/%s"', $entity->getId, get_class($entity));
            throw new InvalidArgumentException($error, 409, $ex);
        } catch (\Exception $ex) {
            $this->em->getConnection()->rollBack();

            throw new InvalidArgumentException($ex->getMessage(), 500, $ex);
        }

        return $entity;
    }

    /**
     * @param $class
     * @param $params
     * @return bool
     */
    public function findOneBy($class, $params)
    {
        $entity = $this->em->getRepository($class)->findOneBy($params);

        if (null === $entity) {
            return false;
        }

        return $entity;
    }

    /**
     * @param $class
     * @return mixed
     */
    public function findAll($class)
    {
        $data = $this->em->getRepository($class)->findAll();

        return $data;
    }

    /**
     * @param $entity
     * @return bool
     */
    public function delete($entity)
    {

        $this->em->remove($entity);

        $this->em->flush();

        return true;
    }

}
