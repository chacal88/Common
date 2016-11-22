<?php

namespace Common\Service;
use Common\Repository\IRepository;

/**
 * Created by PhpStorm.
 * User: chacal
 * Date: 19/10/16
 * Time: 20:19
 */
trait TRepositoryService
{

    /**
     * @var IRepository $repository
     */
    private $repository;

    /**
     * @param $entity
     * @return mixed
     */
    public function save($entity)
    {
        return $this->repository->save($entity);
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function update($entity)
    {
        return $this->repository->update($entity);
    }

    /**
     * @param $class
     * @param $params
     * @return mixed
     */
    public function findOneBy($class, $params)
    {
        return $this->repository->findOneBy($class, $params);
    }

    /**
     * @param $class
     * @return mixed
     */
    public function findAll($class)
    {
        return $this->repository->findAll($class);
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function delete($entity)
    {
        return $this->repository->delete($entity);
    }

}