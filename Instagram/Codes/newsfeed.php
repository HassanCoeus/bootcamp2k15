<?php 

 $_fp = fopen("php://stdin","r");
 include_once 'post.php';
 include_once 'dbHandler.php';

 class NewsFeed{
     public $arrPost;
     public $uName;

     public function __construct($username)
     {
         $this->uName = $username;
         $this->arrPost = array();
     }

     public function showPosts()
     {
         #$this->arrPost = $dh->getPostList($this->uName);

         for($i=0;$i<sizeof($this->arrPost);$i++)
         {
             $this->arrPost[$i]->showInfo();
         }
     }
 }
?>

