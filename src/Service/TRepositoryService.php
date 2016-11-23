<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */

namespace Common\Service;

use Common\Repository\IRepository;

/**
 * Class TRepositoryService
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Service
 */
trait TRepositoryService
{

    /**
     * @var IRepository $repository
     */
    private $repository;

    /**
     * save
     *
     * @param $entity
     * @return mixed
     */
    public function save($entity)
    {
        return $this->repository->save($entity);
    }

    /**
     * update
     *
     * @param $entity
     * @return mixed
     */
    public function update($entity)
    {
        return $this->repository->update($entity);
    }

    /**
     * findOneBy
     *
     * @param $class
     * @param $params
     * @return mixed
     */
    public function findOneBy($class, $params)
    {
        return $this->repository->findOneBy($class, $params);
    }

    /**
     * findAll
     *
     * @param $class
     * @return mixed
     */
    public function findAll($class)
    {
        return $this->repository->findAll($class);
    }

    /**
     * delete
     *
     * @param $entity
     * @return mixed
     */
    public function delete($entity)
    {
        return $this->repository->delete($entity);
    }

}