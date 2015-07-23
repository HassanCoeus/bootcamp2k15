<?php
$_fp=fopen("php://stdin","r");
include 'Profile.php';
include 'post.php';

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

    public function editProfile()
    {
        $this->prof->showProfileInfo();
        $this->prof->editInfo();
        return true;
    }

    function __construct($uname,$upass,$uemail)
    {
        $this->username = $uname;
        $this->password = $upass;
        $this->email = $uemail;
        $this->profile = new Profile;
        $this->countOfFollowers = 0;
        $this->countOfFollowings = 0;
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


    function createPost()
    {
        $p = new Post;
        $p->pCountOfLikes = 0;
        echo "Enter Description: ";
        $p->pDescription = trim(fgets(STDIN));
        $p->pUsername = $this->username;
        return $p;
    }
}
?>
