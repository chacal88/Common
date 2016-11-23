<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 */
namespace Common\Lib;


use Respect\Validation\Exceptions\AllOfException;

/**
 * Class Collection
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Lib
 */
class Collection
{

    /**
     * @var array
     */
    protected $objects; // array

    /**
     * @var array
     */
    protected $deletedObjects; // array

    /**
     * @var
     */
    protected $resetFlag;

    /**
     * @var int
     */
    protected $numObjects;

    /**
     * @var
     */
    protected $iterateNum;


    /**
     * Collection constructor.
     */
    public function __construct()
    {
        $this->resetIterator();
        $this->numObjects     = 0;
        $this->objects        = array();
        $this->deletedObjects = array();
    }

    /**
     * add
     *
     * @param $obj
     */
    public function add($obj)
    {
        $this->objects[] = $obj;
        $this->numObjects++;
    }

    /**
     * next
     *
     */
    public function next()
    {
        $num = ($this->currentObjIsLast()) ? 0 : $this->iterateNum + 1;
        $this->iterateNum = $num;
    }


    /**
     * @return bool
     */
    public function isOdd()
    {
        return $this->iterateNum % 2 == 1;
    }

    /**
     * isEven
     *
     * @return bool
     */
    public function isEven()
    {
        return $this->iterateNum % 2 == 0;
    }

    /**
     *get an obj based on one of it's properties.
     * i.e. a User obj with the property 'username' and a value of 'someUser'
     *      can be retrieved by Collection::getByProperty('username', 'someUser')
     *   --    assumes that the obj has a getter method
     *        with the same spelling as the property, i.e. getUsername()
     * @param $propertyName
     * @param $property
     * @return bool|mixed
     */
    public function getByProperty($propertyName, $property)
    {
        $methodName = "get" . ucwords($propertyName);

        foreach ($this->objects as $key => $obj) {

            if ($obj->{$methodName}() == $property) {

                return $this->objects[$key];
            }
        }
        return false;
    }

    /**
     *  alias for getByProperty()
     * @param $propertyName
     * @param $property
     * @return bool|mixed
     */
    public function findByProperty($propertyName, $property)
    {
        return $this->getByProperty($propertyName, $property);
    }


    /**
     *   get an objects number based on one of it's properties.
     *   i.e. a User obj with the property 'username' and a value of 'someUser'
     *       can be retrieved by Collection::getByProperty('username', 'someUser')
     *   --    assumes that the obj has a getter method
     *       with the same spelling as the property, i.e. getUsername()
     *
     * @param $propertyName
     * @param $property
     * @return bool|int|string
     */
    public function getObjNumByProperty($propertyName, $property)
    {
        $methodName = "get" . ucwords($propertyName);

        foreach ($this->objects as $key => $obj) {

            if ($obj->{$methodName}() == $property) {

                return $key;
            }
        }
        return false;
    }

    /**
     *   get the number of objects that have a property
     *       with a value matches the given value
     *   i.e. if there are objs with a property of 'verified' set to 1
     *       the number of these objects can be retrieved by:
     *           Collection::getNumObjectsWithProperty('verified', 1)
     *  --    assumes that the obj has a getter method
     *       with the same spelling as the property, i.e. getUsername()
     *
     * @param $propertyName
     * @param $value
     * @return int
     */
    public function getNumObjectsWithProperty($propertyName, $value)
    {
        $methodName = "get" . ucwords($propertyName);
        $count      = 0;

        foreach ($this->objects as $key => $obj) {

            if ($obj->{$methodName}() == $value) {

                $count++;
            }
        }
        return $count;
    }

    /**
     *   remove an obj based on one of it's properties.
     *   i.e. a User obj with the property 'username' and a value of 'someUser'
     *       can be removed by Collection::removeByProperty('username', 'someUser')
     *   --    assumes that the obj has a getter method
     *       with the same spelling as the property, i.e. getUsername()
     *
     * @param $propertyName
     * @param $property
     * @return bool
     */
    public function removeByProperty($propertyName, $property)
    {
        $methodName = "get" . ucwords($propertyName);

        foreach ($this->objects as $key => $obj) {

            if ($obj->{$methodName}() == $property) {

                $this->deletedObjects[] = $this->objects[$key];
                unset($this->objects[$key]);
                $this->objects    = array_values($this->objects);
                $this->numObjects--;
                $this->iterateNum = ($this->iterateNum >= 0) ? $this->iterateNum - 1 : 0;

                return true;
            }
        }
        return false;
    }

    /**
     * currentObjIsFirst
     *
     * @return bool
     */
    public function currentObjIsFirst()
    {
        return ($this->iterateNum == 0);
    }

    /**
     * currentObjIsLast
     *
     * @return bool
     */
    public function currentObjIsLast()
    {
        return (($this->numObjects - 1) == $this->iterateNum);
    }

    /**
     * getObjNum
     *
     * @param $num
     * @return bool|mixed
     */
    public function getObjNum($num)
    {
        return (isset($this->objects[$num])) ? $this->objects[$num] : false;
    }

    /**
     * getLast
     *
     * @return mixed
     */
    public function getLast()
    {
        return $this->objects[$this->numObjects - 1];
    }

    /**
     * removeCurrent
     *
     */
    public function removeCurrent()
    {
        $this->deletedObjects[] = $this->objects[$this->iterateNum];
        unset($this->objects[$this->iterateNum]);
        $this->objects = array_values($this->objects);

        if ($this->iterateNum == 0) { // if deleting 1st object

            $this->resetFlag = true;
        } elseif ($this->iterateNum > 0) {

            $this->iterateNum--;
        } else {

            $this->iterateNum = 0;
        }
        $this->numObjects--;
    }

    /**
     * removeLast
     *
     */
    public function removeLast()
    {
        $this->deletedObjects[] = $this->objects[$this->numObjects - 1];
        unset($this->objects[$this->numObjects - 1]);
        $this->objects = array_values($this->objects);

        if ($this->iterateNum == $this->numObjects - 1) {

            $this->resetIterator();
        }
        $this->numObjects--;
    }

    /**
     * removeAll
     *
     */
    public function removeAll()
    {
        $this->deletedObjects = array_merge($this->deletedObjects, $this->objects);
        $this->objects        = array();
        $this->numObjects     = 0;
    }

    /**
     *   sort the objects by the value of each objects property
     *
     *  $type:
     *       r    regular, ascending
     *       rr    regular, descending'
     *       n    numeric, ascending
     *       nr    numeric, descending
     *       s    string, ascending
     *       sr    string, descending
     *
     * @param $propName
     * @param string $type
     */
    public function sortByProperty($propName, $type = 'r')
    {
        $tempArray = array();
        $newObjects = array();

        while ($obj = $this->iterate()) {
            $tempArray[] = call_user_func(array($obj, 'get' . ucwords($propName)));
        }

        switch ($type) {
            case 'r':
                asort($tempArray);
                break;
            case 'rr':
                arsort($tempArray);
                break;
            case 'n':
                asort($tempArray, SORT_NUMERIC);
                break;
            case 'nr':
                arsort($tempArray, SORT_NUMERIC);
                break;
            case 's':
                asort($tempArray, SORT_STRING);
                break;
            case 'sr':
                arsort($tempArray, SORT_STRING);
                break;
            default:
                throw new \Exception(
                    'Collection->sortByProperty():
                    illegal sort type "' . $type . '"'
                );
        }

        foreach ($tempArray as $key => $val) {
            $newObjects[] = $this->objects[$key];
        }
        $this->objects = $newObjects;
    }

    /**
     * isEmpty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ($this->numObjects == 0);
    }

    /**
     * getCurrent
     *
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->objects[$this->iterateNum];
    }

    /**
     * setCurrent
     *
     * @param $obj
     */
    public function setCurrent($obj)
    {
        $this->objects[$this->iterateNum] = $obj;
    }

    /**
     * getObjectByIterateNum
     *
     * @param $iterateNum
     * @return bool|mixed
     */
    public function getObjectByIterateNum($iterateNum)
    {
        return (
        isset($this->objects[$iterateNum])
            ? $this->objects[$iterateNum]
            : false
        );
    }

    /**
     * iterate
     *
     * @return bool|mixed
     */
    public function iterate()
    {
        if ($this->iterateNum < 0) {
            $this->iterateNum = 0;
        }

        if ($this->resetFlag) {
            $this->resetFlag = false;
        } else {
            $this->iterateNum++;
        }

        if ($this->iterateNum == $this->numObjects
            || !isset($this->objects[$this->iterateNum])
        ) {
            $this->resetIterator();
            return false;
        }
        return $this->getCurrent();
    }

    /**
     * resetIterator
     *
     */
    public function resetIterator()
    {
        $this->iterateNum = 0;
        $this->resetFlag = true;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        $str = '';
        foreach ($this->objects as $obj) {
            $str .= '--------------------------<br />' . $obj . '<br />';
        }
        return $str;
    }

    /**
     * getDeletedObjects
     *
     * @return array
     */
    public function getDeletedObjects()
    {
        return $this->deletedObjects;
    }

    /**
     * getIterateNum
     *
     * @return mixed
     */
    public function getIterateNum()
    {
        return $this->iterateNum;
    }

    /**
     * getNumObjects
     *
     * @return int
     */
    public function getNumObjects()
    {
        return $this->numObjects;
    }

    /**
     * setDeletedObjects
     *
     * @param $key
     * @param $val
     */
    public function setDeletedObjects($key, $val)
    {
        $this->deletedObjects[$key] = $val;
    }

    /**
     * resetDeletedObjects
     *
     */
    public function resetDeletedObjects()
    {
        $this->deletedObjects = array();
    }

}