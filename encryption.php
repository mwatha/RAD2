<?php
function encrypt($str) {

 $encryptionKey = array("A" => "Z","B" => "Y","C" => "X","D" => "W",
 "E" => "V","F" => "U","G" => "T","H" => "S","I" => "R","J" => "Q",
 "K" => "P","L" => "0","M" => "N","N" => "M","O" => "L","P" => "K",
 "Q" => "J","R" => "I","S" => "H","T" => "G","U" => "F","V" => "E",
 "W" => "D","X" => "C","Y" => "B","Z" => "A",

 "a" => "z","b" => "y","c" => "x","d" => "w","e" => "v","f" => "u",
 "g" => "t","h" => "s","i" => "r","j" => "q","k" => "p","l" => "o",
 "m" => "n","n" => "m","o" => "l","p" => "k","q" => "j","r" => "i",
 "s" => "h","t" => "g","u" => "f","v" => "e","w" => "d","x" => "c",
 "y" => "b", "z" => "a", 
 
 "1" => "0","2" => "9","3" => "8","4" => "7","5" => "6", "6" => "5",
 "7" => "4", "8" => "3","9" => "2","0" => "1");

 $return_string = "";
 $stringArray = str_split($str);

 for($i = 0; $i < count($stringArray); $i++) {
   $str = $encryptionKey[$stringArray[$i]];
   if ($str) {
     $return_string = $return_string.$str; 
   }else{
     $return_string = $return_string.$stringArray[$i];
   }
 }
 return $return_string;
}

