<?php
function insert_function($file_name,$insert_data,$position)
{
    $file_detail=file_get_contents($file_name);
   if($file_detail == false)
   {
    echo "File not found";
   }
   if($position > strlen($file_name))
   {
    echo "File exceeds length";
   }
   $new_file = substring($filename,0,$position) . $insert_data . substring($filename,$position);
}

$file_name = 'SAMPLE.txt';
$insert_data = "middle data";
$position = 30;
insert_function($filename,$insert_data,$position);
?>