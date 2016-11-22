<?php
/**
 * Created by PhpStorm.
 * User: chacal
 * Date: 19/10/16
 * Time: 20:11
 */

namespace Common\Repository;


interface IRepository
{

    public function save($entity);

    public function update($entity);

    public function findOneBy($class, $params);

    public function findAll($class);

    public function delete($entity);
}