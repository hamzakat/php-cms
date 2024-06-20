<?php

require_once 'BaseDAO.php';
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
        $query = "INSERT INTO " . $this->getModelTable() . " (postId, contributorName, contributorEmail, text) VALUES (:postId, :contributorName, :contributorEmail, :text)";

        if ($stmt = $this->pdo->prepare($query)) {

            // Bind variables to the prepared statement parameters
            $stmt->bindParam(":postId", $comment->getPostId());
            $stmt->bindParam(":contributorName", $comment->getContributorName());
            $stmt->bindParam(":contributorEmail", $comment->getContributorEmail());
            $stmt->bindParam(":text", $comment->getText());

            $result = $stmt->execute();
            return $result;
        }
    }


    public function getAll($arg)
    {
        $query = "SELECT * FROM " . $this->getModelTable() . " WHERE postId = :postId;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':postId', $arg);


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
