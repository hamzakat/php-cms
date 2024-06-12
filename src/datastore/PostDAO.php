<?php

require_once 'BaseDao.php';
require_once SITE_ROOT . '/models/Post.php';

class PostDAO extends BaseDAO
{
    protected function getModelClass()
    {
        return 'Post';
    }

    protected function getModelTable()
    {
        return 'posts';
    }

    public function add($post)
    {
        $query = "INSERT INTO " . $this->getModelTable() . " (title, contributorName, text) VALUES (:title, :contributorName, :text)";

        if ($stmt = $this->pdo->prepare($query)) {

            // Bind variables to the prepared statement parameters
            $stmt->bindParam(":title", $post->getTitle());
            $stmt->bindParam(":contributorName", $post->getContributorName());
            $stmt->bindParam(":text", $post->getText());

            $result = $stmt->execute();
            return $result;
        }
    }


    public function getAll($arg = false)
    {

        $query = "SELECT * FROM " . $this->getModelTable() . ";";
        $stmt = $this->pdo->prepare($query);

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
        $query = "SELECT * FROM " . $this->getModelTable() . " WHERE id = :id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $this->mapToObject($row);
            }
        }
        return null;
    }
}
