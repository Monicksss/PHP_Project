<?php


require './assets/config/function.php';


if (isset($_SESSION['loggedIn'])){


    logoutsession();
    redirect('login.php','Logged out Sucessfully.');

}

?>

