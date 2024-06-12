<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

require_once  SITE_ROOT . '/datastore/PostDAO.php';
require_once 'BaseController.php';

class PostsController extends BaseController
{
    public function getPostById($id)
    {
        return $this->dao->getById($id);
    }
}

$postsController = new PostsController(new PostDAO());
