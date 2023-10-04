<?php 

$con = mysqli_connect('localhost','root','','scraper_data');

if(!$con){
    echo 'Connection error: '.mysqli_connect_error();
}

?>