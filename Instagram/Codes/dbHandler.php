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
          $u = new User("M_H_20","hassan","mhassanq1994@gmail.com");
          $u2 = new User("M_H_Q","hash","bitf11m054@pucit.edu.pk");
          $this->arrUser = array($u,$u2);   
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
          echo 'Size of ARR POST' . sizeof($this->arrPost) . "\n";
          return $this->arrPost;
      }
      
      
      
      
      
      

      function addUser($userName,$email,$pass)
      {
          $i = sizeof($this->arrUser);
          $u = new User($userName,$email,$pass);
          $this->arrUser[$i]=u;
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
              echo 'Saving Post: ' . $obj->pId . "\n";
              $i=sizeof($this->arrPost);
              
              $this->arrPost[$i]=$obj;
              echo 'Size of ARR POST' . $i . "\n";
          }
      }

  }
?>
