<?php
$_fp = fopen("php://stdin","r");
include_once 'dbHandler.php';
include_once 'newsfeed.php';
include_once 'Profile.php';
#include 'post.php';

echo "WELCOME TO INSTAGRAM!!! \n";
echo "Press 1 to Signup. \n";
echo "Press 2 to Signin. \n";
echo "Press 3 to quit. \n";

$num = fgets($_fp);
$dh = new dbHandler;

if($num==1)
{
  echo "Enter a UserName: ";
  $uname = trim(fgets($_fp));
  
  echo "Enter a password: ";
  $upass = trim(fgets($_fp));
  
  echo "Enter your email address: ";
  $uemail = trim(fgets($_fp));
  
  $flag = $dh->addUser($uname,$uemail,$upass);
  if($flag)
      echo "Successfully Signedup";
}

if($num==2)
{
  do
  {
    $ch='y';
    echo "Enter a Username: ";
    $uname = trim(fgets($_fp));
    echo "Enter a Password: ";
    $upass = trim(fgets($_fp));
    $us=$dh->checkUserNamePassword($uname,$upass);
    #echo "WRONG USERNAME OR PASSWORD !!! \n";
    if($us!=NULL)
    {
      $c = 'y';
      do{
      echo "Press 1 if you want to follow some one \n";
      echo "Press 2 if you want to create a post \n";
      echo "Press 3 if you want to see your news feed \n";
      echo "Press 4 if you want to see your USER Page \n";
      echo "Press 5 if you want to quit \n";
      $n = fgets($_fp);

      switch($n)
      {
      case 1:
          echo "Enter a user name you want to follow: ";
          $uname =  trim(fgets($_fp));
          $us->followUser($uname,$dh);
          $us->showInfo();
          break;
      case 2:
          $dh->save($us->createPost());
          break;
      case 3:
          $nf = $us->getNewsFeed($dh);
          $nf->showPosts();
          break;
      case 4:
          $us->showInfo();
          break;

      default:
          $c='n';
          $ch='n';
          break;
      }
      }while($c=='y');
    }
    else if($us==NULL)
    {
        echo 'WRONG USERNAME OR PASSWORD!!!' . "\n";
        echo 'Press "y" if you want to try again.' . "\n";
        $ch = trim(fgets(STDIN));
    }}while($ch == 'y');

}

if($num==3)
{
    return;
}
?>
