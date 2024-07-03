<?php include('templates/header.php') ?>

<?php

$array=[1,2,3];

// echo "this is the count of the array ".count($array);

$errors=['username'=>'','email'=>'','password'=>'']; //this one is an associative array as it is using key value pairs in this

if(isset($_POST['submit'])){

    // echo 'you tried to submit';

    $username=htmlspecialchars($_POST['username']);
    $email=htmlspecialchars($_POST['email']);
    $password=htmlspecialchars($_POST['password']);
    $confirm_password=htmlspecialchars($_POST['confirm_password']);

    if(empty($username)){

        $errors['username']='the username field cannot be left empty';
    }


    if(empty($email)){

        $errors['email']='the email field cannot be left empty';

    }else{

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

            $errors['email']='please enter in a valid email address';
        }
    }

    if(empty($password)){

        $errors['password']='the password field cannot be empty';
    
    }

    if(empty($confirm_password) && !empty($password)){

        $errors['password']='please confirm your password';

    }else{

        if($confirm_password!=$password){

            $errors['password']='please make sure both the passwords match';
        }


    }

    if(empty(array_filter($errors))){

        echo 'this form is error free';

        require_once('db/database.php');

        print_r($con);

        $hashed_password=password_hash($password,PASSWORD_DEFAULT);

        $query="INSERT INTO users (username,email,password) values ('$username','$email','$hashed_password')";

        // echo 'this is the query '.$query;
        $result=mysqli_query($con,$query);

        if($result){

            echo 'the operation was successful';

        }else{

            echo 'the operation was shit';
        }


    }



    }
    
    ?>


<h3>REGISTER</h3>

<form action="register.php" method="POST">


<div class="mb-3">
<input type="text" placeholder="enter username" name="username" class="form-control">

<div class="text-danger">

<?=$errors['username'];?>

</div>

</div>



<div class="mb-3">
<input type="text" placeholder="enter email" name="email" class="form-control">

<div class="text-danger">

<?=$errors['email'];?>
    
</div>

</div>

<div class="mb-3">
<input type="password" placeholder="enter a password" name="password" class="form-control">

<div class="text-danger">

<?=$errors['password'];?>
    
</div>

</div>

<div class="mb-3">
<input type="password" placeholder="confirm password" name="confirm_password" class="form-control">
</div>


<button name="submit">SUBMIT</button>

</form>


<?php include('templates/footer.php') ?>