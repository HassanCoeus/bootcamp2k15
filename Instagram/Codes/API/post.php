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
        $this->pCountOfLikes = 0;
    }


    public static function fromValues($i,$u,$d)
    {
          $p = new Post;
          $p->pId = $i;                  
          $p->pUsername = $u;
          $p->pDescription = $d;
          $p->pCountOfLikes = 0;
          return $p;
    }



    public function showInfo()
    {
        echo "Post Id: " . $this->pId . "\n";
        echo "Post Username: " . $this->pUsername . "\n";
        echo "Post Description: " . $this->pDescription . "\n";
        echo "Post Likes: " . $this->pCountOfLikes . "\n";
    }

    public function like($dh)
    {
        $this->pCountOfLikes++;
        $dh->save($this);
    }
}?>
