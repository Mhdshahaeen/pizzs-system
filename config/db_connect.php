<?php
$conn =mysqli_connect('localhost' , 'Mhd Shaheen' , 'Mm123456@Sh' , 'pizza');
if (!$conn){
    echo 'connection error'.mysqli_connect_error();
}
?>