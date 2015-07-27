<?php
$_fp=fopen("php://stdin","r");
include_once 'Profile.php';
include_once 'post.php';

class User{
    public $username;
    public $password;
    public $email;
    public $prof;
    public $arrFollowers;
    public $arrFollowings;
    public $countOfFollowers;
    public $countOfFollowings;
    public $NewsFeed;
    public $postArr;

    public function showProfile()
    {
        $this->prof->showProfileInfo();
        #$this->prof->editInfo();
        #return true;
    }


    public function editProfileInfo()
    {
        $this->prof->editInfo();
        return true;
    }

    function __construct($uname,$upass,$uemail)
    {
        $this->username = $uname;
        $this->password = $upass;
        $this->email = $uemail;
        $this->prof = new Profile;
        $this->countOfFollowers = 0;
        $this->countOfFollowings = 0;
        $this->postArr = array();
    }

    function followUser($uname,$dh)
    {
        $this->countOfFollowings++;
        $i = sizeof($this->arrFollowings);
        $this->arrFollowings[$i] = $uname;
        $u=$dh->getUser($uname);
        $u->countOfFollowers++;
        $i = sizeof($u->arrFollowers);
        $u->arrFollowers[$i] = $this->username;
        $dh->save($this);
        $dh->save($u); 
    }
    
    function showInfo()
    {
        echo "Username: " . $this->username . "\n";
        echo "Email: " . $this->email . "\n";
        echo "Followers: " . $this->countOfFollowers . "\n";
        echo "Followings: " . $this->countOfFollowings . "\n";
    }

    function createPost($dh)
    {
        $p = new Post;
        #$p->pId = rand(1,10);
        $p->pCountOfLikes = 0;
        echo "Enter Description: ";
        $p->pDescription = trim(fgets(STDIN));
        $p->pUsername = $this->username;
        $n = sizeof($this->postArr);
        $this->postArr[$n]=$p;
        $dh->save($this);
        
        echo "----------------------------POST INFO---------------------\n";        $p->showInfo();
        
        $dh->save($p);
        return;
    }

    function likePost($nf, $id, $dh)
    {
        #echo "The Size of newsFeed before liking: " . sizeof($nf) . "\n";
        foreach($nf->arrPost as $p)
        {
            if($p->pId==$id)
            {
                $p->like($dh,$this->username);
            }
        }
    }

    function editPost($nf,$id,$dh)
    {
        foreach($nf->arrPost as $p)
        {
            if($p->pId==$id)
            {
                if($p->pUsername == $this->username)
                {
                    $p->editInfo($dh);
                }
            }
        }
    }







    function getNewsFeed($dh)
    {
        $arrPost = $dh->getPosts();
        $nf = new NewsFeed($this->username);
        $c = 0;
        $u = $dh->getUser($this->username);
        for($i=0;$i<sizeof($arrPost);$i++)
        {
          if($arrPost[$i]->pUsername == $this->username)
            {
                $nf->arrPost[$c] = $arrPost[$i];
                $c++;
                #break;
            }
            else{
                for($j = 0; $j<sizeof($u->arrFollowings);$j++)
                {
                    if($u->arrFollowings[$j] == $arrPost[$i]->pUsername)
                    {
                         $nf->arrPost[$c] = $arrPost[$i];
                         $c++;
                         break;
                    }
                }
            }
        }
        #echo "size of nf: " . sizeof($nf->arrPost) . "/n";
        return $nf;
    }

    function signup($dh)
    {
        echo "Enter a Username: ";
        $this->username = trim(fgets(STDIN));
        
        echo "Enter a password: ";
        $this->password = trim(fgets(STDIN));

        echo "Enter your email address: ";
        $this->email = trim(fgets(STDIN));

        $flag = $dh->addUser($this->username,$this->email,$this->password);
        return $flag;
    }

    function signin($dh)
    {
        echo "Enter a Username: ";
        $this->username = trim(fgets(STDIN));

        echo "Enter a Password: ";
        $this->password  = trim(fgets(STDIN));

        $us = $dh->checkUserNamePassword($this->username,$this->password);

        return $us;
    }
}
?>
