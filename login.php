<?php include('templates/header.php') ?>

<?php include('helpers.php') ?>

<?php 

$errors=['email'=>'','password'=>''];

if(isset($_POST['submit'])){

    $email=htmlspecialchars($_POST['email']);
    $password=htmlspecialchars($_POST['password']);

    if(empty($email)){

        $errors['email']='the email field cannot be empty';
    }

    if(empty($password)){

        $errors['password']='the password field cannot be empty';
    }


    if(empty(array_filter($errors))){

        // echo 'good';

        require_once('db/database.php');

        $sql="SELECT * from users where email='$email'";

        $result=mysqli_query($con,$sql);

        if($result && mysqli_num_rows($result)>0){

            // print_r(mysqli_fetch_assoc($result));
            // $ar=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $array=mysqli_fetch_assoc($result);

            // $ar=mysqli_fetch_all($result,MYSQLI_ASSOC);

            print_r($array);
            // print_r($ar);

            // if($array){}
            $password_hash=$array['password'];

            if(password_verify($password,$password_hash)){

                echo 'good it works';

                sess_starter();

                $_SESSION['user']=$array['username'];

                $_SESSION['email']=$array['email'];

                $_SESSION['user_id']=$array['id'];

                $_SESSION['avatar']=$array['avatar']??'default.jpg';

                header('Location:dashboard.php');

            }else{

                echo 'wrong thing';
            }


        }

 }


}


?>


<h3>LOGIN</h3>

<form action="login.php" method="POST">
    <div class="mb-3">
        <input type="text" class="form-control" name="email" placeholder="email">
        <div class="text-danger">
            <?=$errors['email']?>
        </div>
    </div>
    <div class="mb-3">
    <input type="password" class="form-control" name="password" placeholder="password">
    <div class="text-danger">
            <?=$errors['password']?>
        </div>
    </div>

    <button name="submit">Login</button>
</form>

<?php include('templates/footer.php') ?>