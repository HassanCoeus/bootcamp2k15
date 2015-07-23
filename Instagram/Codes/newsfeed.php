<?php 

 $_fp = fopen("php://stdin","r");
 include 'post.php';
 include 'dbHandler.php';

 class NewsFeed{
     public $arrPost;
     public $uName;

     public function __construct($username)
     {
         $this->uname = $username;
         $this->arrPost = array();
     }

     public function showPosts($dh)
     {
         $this->arrPost = $dh->getPostList($this->uname);

         for($i=0;$i<sizeof($this->arrPost);$i++)
         {
             $this->arrPost[$i]->showInfo();
         }
     }
 }
?>



     }

