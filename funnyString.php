
$number=1;

while($number<1 || $number>10){
    fscanf(STDIN, "%d\n", $number);
}

$length=1;

for($i=0;$i<$number;$i++)
    {
    while(strlen($str[$i])<2 || strlen($str[$i])>10000 )
        {
        $str[$i]=trim(fgets(STDIN));
    }
}

for($i=0;$i<$number;$i++)
    {
        $revStr[$i]=strrev($str[$i]);
    }

$flag=TRUE;

for($i=0;$i<$number;$i++)
    {
        $flag=TRUE;
        for($j=1;$j<strlen($str[$i]);$j++)
            {
                if(abs(ord($str[$i][$j])-ord($str[$i][$j-1]))!=abs(ord($revStr[$i][$j])-ord($revStr[$i][$j-1])))
                    {
                    $flag=FALSE;
                    echo "Not Funny\n";
                    break;
                }
        }
    if($flag==TRUE)
        {
        echo "Funny\n";
    }
}
?>
