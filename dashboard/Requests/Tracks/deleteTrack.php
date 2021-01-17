<?php 

   

$file_pointer = $_POST["filename"];
echo $file_pointer;

/* if (!unlink($file_pointer)) {  
    echo ("$file_pointer cannot be deleted due to an error");  
}  
else {  
    echo ("$file_pointer has been deleted");  
}   */
  
?>