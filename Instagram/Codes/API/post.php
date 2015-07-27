<?php
  $_fp = fopen("php://stdin","r");
class Post
{
    public $pId;
    public $pUsername;
    public $pCountOfLikes;
    public $pDescription;
    public $plikes;

    public function __construct()
    { 
        $this->pId = rand();
        $this->pUsername = "abc";
        $this->pDescription = "desc";
        $this->pCountOfLikes = 0;
        $this->plikes = array();
    }


    public static function fromValues($i,$u,$d)
    {
          $p = new Post;
          $p->pId = $i;                  
          $p->pUsername = $u;
          $p->pDescription = $d;
          $p->pCountOfLikes = 0;
          $p->plikes = array();
          return $p;
    }



    public function showInfo()
    {
        echo "Post Id: " . $this->pId . "\n";
        echo "Post Username: " . $this->pUsername . "\n";
        echo "Post Description: " . $this->pDescription . "\n";
        echo "Post Likes: " . $this->pCountOfLikes . "\n";
    }


    public function editInfo($dh)
    {
        echo "Enter new description\n";
        $this->pDescription = trim(fgets(STDIN));
        $dh->save($this);
    }

    public function like($dh,$username)
    {
        $key = array_search($username,$this->plikes);
        if($key!==false){
            unset($this->plikes[$key]);
            $this->pCountOfLikes--;
            $dh->save($this);
            return;
        }
        
        $this->pCountOfLikes++;
        $n = sizeof($this->plikes);
        $this->plikes[$n] = $username;
        $dh->save($this);
        return;
    }
}?>
