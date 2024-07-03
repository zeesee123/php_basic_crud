<?php 


$con=mysqli_connect('localhost','root','','simplecrud');

// echo 'this is the connection string ';

// print_r($con);

if($con){

    // echo 'great the connection has been established';

}else{

    echo 'sorry the connection is not working fine';

    exit(0);
}