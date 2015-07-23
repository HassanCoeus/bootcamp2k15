<?php
  $_fp = fopen("php://stdin","r");

class Post
{
    public $pId;
    public $pUsername;
    public $pCountOfLikes;
    public $pDescription;

    public function __construct()
    { 
        $this->pId = 1;
        $this->pUsername = "abc";
        $this->pDescription = "desc";
        $this->pcountOfLikes = 0;
    }

    public function showInfo()
    {
        echo "Post Id: " . $this->pId . "\n";
        echo "Post Username: " . $this->pUsername . "\n";
        echo "Post Description: " . $this->pDescription . "\n";
        echo "Post Likes: " . $this->pCountOfLikes . "\n";
    }
}
?>

