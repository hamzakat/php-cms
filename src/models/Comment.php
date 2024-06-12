<?php

class Comment
{
    private $postId;
    private $contributorName;
    private $contributorEmail;
    private $publishDate;
    private $text;

    function __construct($postId, $contributorName, $contributorEmail, $publishDate, $text)
    {
        $this->postId = $postId;
        $this->contributorName = $contributorName;
        $this->contributorEmail = $contributorEmail;
        $this->publishDate = $publishDate;
        $this->text = $text;
    }

    /**
     * Using factory pattern
     */
    public static function makeComment($postId, $contributorName, $contributorEmail, $text)
    {
        $commentObj = new Comment($postId, $contributorName, $contributorEmail, 0, $text);
        return $commentObj;
    }

    /**
     * Get the value of contributorName
     *
     * @return  mixed
     */
    public function getContributorName()
    {
        return $this->contributorName;
    }

    /**
     * Get the value of contributorEmail
     *
     * @return  mixed
     */
    public function getContributorEmail()
    {
        return $this->contributorEmail;
    }

    /**
     * Get the value of postId
     *
     * @return  mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Get the value of publishDate
     *
     * @return  mixed
     */
    public function getPublishDate()
    {
        $date_obj = date_create($this->publishDate);
        return date_format($date_obj, "d M Y");
    }

    /**
     * Get the value of text
     *
     * @return  mixed
     */
    public function getText()
    {
        return $this->text;
    }
}
