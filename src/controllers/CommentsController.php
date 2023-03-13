<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

require_once  SITE_ROOT . '/datastore/CommentDAO.php';
require_once 'BaseController.php';


class CommentController extends BaseController
{
}

$commentsController = new CommentController(new CommentDAO());
