<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */

namespace Common\Repository;

/**
 * Interface IRepository
 * @package Common\Repository
 */
interface IRepository
{

    /**
     * save
     *
     * @param $entity
     * @return mixed
     */
    public function save($entity);

    /**
     * update
     *
     * @param $entity
     * @return mixed
     */
    public function update($entity);

    /**
     * findOneBy
     *
     * @param $class
     * @param $params
     * @return mixed
     */
    public function findOneBy($class, $params);

    /**
     * findBy
     *
     * @param $class
     * @return array
     */
    public function findBy($class, $params, $order);

    /**
     * findAll
     *
     * @param $class
     * @return mixed
     */
    public function findAll($class);

    /**
     * delete
     *
     * @param $entity
     * @return mixed
     */
    public function delete($entity);
}