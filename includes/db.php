<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con = mysqli_connect('localhost', 'root', '', 'swaf');
} else {
    $con = mysqli_connect('localhost', 'u708087849_swaf', 'Silverwrap@11', 'u708087849_swaf');
}


// if($con){
//     echo " connected ";
// }else{
//     echo " not connected :" . mysqli_connect_error();
// }
