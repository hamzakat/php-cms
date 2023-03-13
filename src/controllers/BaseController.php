<?php

abstract class BaseController
{

    protected $dao;

    function __construct($dao)
    {
        $this->dao = $dao;
    }

    public function getAll($arg)
    {
        return $this->dao->getAll($arg);
    }


    public function add($object)
    {
        return $this->dao->add($object);
    }
}
