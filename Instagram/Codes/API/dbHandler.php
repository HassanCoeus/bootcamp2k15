<?php
$_fp = fopen("php://stdin","r");
include_once 'user.php';
include_once 'newsfeed.php';
  class dbHandler
  {
      private $arrUser;
      private $arrPost;

      function __construct()
      {
          $u1 = new User("M_H_20","hassan","mhassanq1994@gmail.com");
          $u2 = new User("M_H_Q","hash","bitf11m054@pucit.edu.pk");
          $p1 = Post::fromValues(1,"M_H_20","#BEAUTY #NATURE");
          $p2 = Post::fromValues(2,"M_H_Q","#Carma");
          $u1->postArr[sizeof($u1->postArr)]=$p1;
          $u2->postArr[sizeof($u2->postArr)]=$p2;
          $this->arrUser = array($u1,$u2);   
          $this->arrPost = array($p1,$p2);
      }

      function checkUserNamePassword($userName,$pass)
      {
          for($i=0;$i<sizeof($this->arrUser);$i++)
          {
              if($userName == $this->arrUser[$i]->username &&
                  $pass == $this->arrUser[$i]->password)
              {
                  return $this->arrUser[$i];
              }
          }
          return NULL;
      }



      function getUser($username)
      {
          for($i=0;$i<sizeof($this->arrUser);$i++)
          {
              if($username == $this->arrUser[$i]->username)
              {
                  return $this->arrUser[$i];
              }
          }
          return NULL;
      }

          
      function getPosts()
      {
          #echo 'Size of ARR POST' . sizeof($this->arrPost) . "\n";
          return $this->arrPost;
      }
      
      
      function addUser($userName,$email,$pass)
      {
          $i = sizeof($this->arrUser);
          $u = new User($userName,$email,$pass);
          $this->arrUser[$i]=$u;
          return true;
      }

      function save($obj)
      {
          if(get_class($obj)=="User")
          {
            $i=sizeof($this->arrUser);
            $this->arrUser[$i]=$obj;
          }
          else if(get_class($obj)=="Post")
          {
              #echo 'Saving Post: ' . $obj->pId . "\n";
              foreach($this->arrPost as $pArr)
              {
                  if($pArr->pId == $obj->pId)
                  {
                      $pArr = $obj;
                      return;
                  }
              }
              $i=sizeof($this->arrPost);
              $obj->pId = $i+1; 
              $this->arrPost[$i]=$obj;
              #echo 'Size of ARR POST' . $i . "\n";
          }
      }
  }?>
