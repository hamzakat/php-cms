<?php

require_once 'BaseDao.php';
require_once SITE_ROOT . '/models/Article.php';

class ArticleDAO extends BaseDAO
{
    protected function getModelClass()
    {
        return 'Article';
    }

    protected function getModelTable()
    {
        return 'articles';
    }

    public function add($article)
    {
        $query = "INSERT INTO " . $this->getModelTable() . " (title, contributorName, text) VALUES (:title, :contributorName, :text)";

        if ($stmt = $this->pdo->prepare($query)) {

            // Bind variables to the prepared statement parameters
            $stmt->bindParam(":title", $article->getTitle());
            $stmt->bindParam(":contributorName", $article->getContributorName());
            $stmt->bindParam(":text", $article->getText());

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
