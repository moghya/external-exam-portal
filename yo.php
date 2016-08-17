<?php
$myfile = fopen("quiz/quiz_1001.txt", "r") or die("Unable to open file!");

while($text = fgets($myfile,filesize("quiz.txt")))
{
    echo $text;
}

fclose($myfile);
?>
