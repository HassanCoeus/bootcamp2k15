<?php
$_fp = fopen("php://stdin","r");
include_once 'API/dbHandler.php';
include_once 'API/newsfeed.php';
include_once 'API/Profile.php';

echo "WELCOME TO INSTAGRAM!!! \n";
echo "Press 1 to Signup. \n";
echo "Press 2 to Signin. \n";
echo "Press 3 to quit. \n";

$num = fgets($_fp);
$dh = new dbHandler;

if($num==1)
{
  $us = new user("ABC","123","example@gmail.com"); 
  $flag = $us->signup($dh);
  if($flag)
      echo "Successfully Signedup";
  echo "Enter 1 if you want to login with you new account now\n";
  if(fgets(STDIN)==1)
  {
      $num=2;
  }
}

if($num==2)
{
  do
  {
    $ch='y';
    $us = new user("ABC","123","sample@gmail.com");
    $us = $us->signin($dh);
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
          #$us->showInfo();
          break;
      case 2:
          $us->createPost($dh);
          break;
      case 3:
          $nf = $us->getNewsFeed($dh);

          $nf->showPosts();
          echo "Press 1 if you want to like a post from above\n";
          echo "Press 2 if you want to edit your post from above\n";
          echo "Press 3 if you want to delete your post from above\n";
          echo "Choice: ";
          $choice = fgets(STDIN);
          switch($choice)
          {
            case 1:
            {
                echo "Enter the Post id from the above shown posts: ";
                $us->likePost($nf,fgets(STDIN),$dh);
                break;
            }
            case 2:
            {
                echo "Enter the Post id from above shown posts: ";
                $us->editPost($nf,fgets(STDIN),$dh);
                break;
            }
            case 3:
            {
                echo "Enter the Post id you want to delete from above: ";
                $us->deletePost($nf,fgets(STDIN),$dh);
                break;
            }
            default:
            {
                break;
            }
          }
          break;
      case 4:
          $us->showInfo();
          echo "Press 1 if you want to move to your profile information.\n";
          if(fgets(STDIN)==1)
          {
             $us->showProfile();
             echo "Press 1 if you want to edit your profile.\n";
             if(fgets(STDIN)==1)
             {
                 $us->editProfileInfo();
             }
          }
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
