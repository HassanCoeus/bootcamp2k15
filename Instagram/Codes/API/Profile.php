<?php
$_fp = fopen("php://stdin","r");

 class Profile{
     private $prof_name;
     private $img_path;
     private $gender;
    
     public function showProfileInfo(){
        echo "Profile Name: " . $this->prof_name . "\n";
        echo "Gender: " . $this->gender . "\n";
     }
    
     public function editInfo(){
        echo "Enter New Profile Name: ";
        $this->prof_name = trim(fgets(STDIN));
        echo "Congragulations, Your new profile name is: " . $this->prof_name . "\n";
     }

     function __construct(){
         $this->prof_name = "ABC";
         $this->gender = "Male";
     }
 }
?>
