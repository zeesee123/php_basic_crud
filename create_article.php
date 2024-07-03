<?php include('helpers.php');

sess_starter();
?>



<?php include('templates/auth_header.php') ?>

<?php 


$errors=['title'=>'','body'=>''];

$session_message='';

if(isset($_POST["submit"])){

    $title=htmlspecialchars($_POST['title']);
    $body=htmlspecialchars($_POST['title']);
    $user_id=htmlspecialchars($_SESSION['user_id']);

    // echo 'you just submitted the form';


    if(empty($title)){

        $errors['title']='title cannot be empty';


    }

    if(empty($body)){

        $errors['body']='body field cannot be empty';
    }


    if(empty(array_filter($errors))){

        require_once('db/database.php');

        $sql="INSERT INTO articles (title,body,user_id) values ('$title','$body','$user_id')";

        $result=mysqli_query($con,$sql);

        if($result){

            $session_message="<div class='alert alert-success'>article posted successfully</div>";


        }else{

            $session_message="<div class='alert alert-danger'>there is an error</div>";
        }



           
    }


}


?>

<h3>Create article</h3>

<div>
    <?=$session_message?>
</div>

<form action="" method="POST">
    <div class="mb-3">
    <input type="text" class="form-control" name="title" placeholder='enter title'>
    <div class="text-danger">
        <?=$errors['title']?>
    </div>
    </div>
    

    <div class="mb-3">
    <textarea name="" id="" cols="30" rows="10" class="form-control" name="body" placeholder='body'></textarea>
    <div class="text-danger">
    <?=$errors['body']?>
    </div>
    </div>

    <button name="submit">POST</button>
    
</form>





<?php include('templates/footer.php') ?>