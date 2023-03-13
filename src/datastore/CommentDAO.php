<?php

require_once 'BaseDao.php';
require_once SITE_ROOT . '/models/Comment.php';

class CommentDAO extends BaseDAO
{
    protected function getModelClass()
    {
        return 'Comment';
    }

    protected function getModelTable()
    {
        return 'comments';
    }

    public function add($comment)
    {
        $query = "INSERT INTO " . $this->getModelTable() . " (articleId, contributorName, contributorEmail, text) VALUES (:articleId, :contributorName, :contributorEmail, :text)";

        if ($stmt = $this->pdo->prepare($query)) {

            // Bind variables to the prepared statement parameters
            $stmt->bindParam(":articleId", $comment->getArticleId());
            $stmt->bindParam(":contributorName", $comment->getContributorName());
            $stmt->bindParam(":contributorEmail", $comment->getContributorEmail());
            $stmt->bindParam(":text", $comment->getText());

            $result = $stmt->execute();
            return $result;
        }
    }


    public function getAll($arg)
    {
        $query = "SELECT * FROM " . $this->getModelTable() . " WHERE articleId = :articleId;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':articleId', $arg);


        if ($stmt->execute()) {
            $result = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $this->mapToObject($row));
            }
            return $result;
        }
        return [];
    }

    public function getById($id)
    {
    }
}
