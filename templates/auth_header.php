<?php 

if(!isset($_SESSION['user'])){

    header('Location:login.php');


};

if(isset($_POST['logout'])){


    sess_destroy();

    header('Location:login.php');



}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
        <a class="nav-link " href="create_article.php">Create article</a>
        <!-- <a class="nav-link" href="#">Pricing</a> -->
        <div class="dropdown">

  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <span><img src="public/avatar/<?=$_SESSION['avatar']?>" alt="my image" style="border-radius:50%;height:10vmin;width:10vmin;"></span><?=$_SESSION['user']?>
  </button>

  <ul class="dropdown-menu">
    
    <!-- <li><a class="dropdown-item" href="create_article.php">Create article</a></li> -->
    <li><a class="dropdown-item" href="my_profile.php">MY profile</a></li>
    <form method="POST" action="">            
    <button name="logout" style="border:none;">
    Log out
    </button>
    </form>
  </ul>
</div>
      </div>
    </div>
  </div>
</nav>

<div class='container'>


    
