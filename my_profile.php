<?php include('helpers.php');

require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;

echo Uuid::uuid4()->toString();

 sess_starter();

 $array='';

 require_once('db/database.php');

 $id=$_SESSION['user_id'];

 $sql="SELECT * FROM users where id='$id'";

 $result=mysqli_query($con,$sql);

 if($result && mysqli_num_rows($result)>0){

    $array=mysqli_fetch_assoc($result);

    print_r($array);


 }


 $session_msg='';


 if(isset($_POST['save'])){

  echo 'you just tried to save stuff';

  print_r($_FILES);

  if(isset($_FILES['avatar'])){

    $ogimg='';

    $sql="SELECT * from users where id='$id'";

    $result=mysqli_query($con,$sql);

    if($result && mysqli_num_rows($result)>0){

      $ar=mysqli_fetch_assoc($result);

      if($ar['avatar']){

        $ogimg=$ar['avatar'];
      }

      

    }

    // $_FILES['']
    // $filename=
    $tmp_name=$_FILES['avatar']['tmp_name'];

    echo $tmp_name;

    $filename=$id;

    $allowed_ext=['jpeg','jpg','png','webp'];

    if($_FILES['avatar']['size']<5*1024*1024){

      echo 'good the file size is fine';

      $ext=pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);

      if(!in_array($ext,$allowed_ext)){

        echo 'ext should be valid';
      }

      $filename=Uuid::uuid4()->toString().'.'.$ext;

      if(move_uploaded_file($tmp_name,'public/avatar/'.$filename)){

        echo 'file uploaded successfully';

        $sql="UPDATE users set avatar='$filename' where id='$id'";

        $result_1=mysqli_query($con,$sql);

        if($result_1){

          if(!empty($ogimg)){

            $old_path='public/avatar/'.$ogimg;

            unlink($old_path);

          }
          
          $_SESSION['avatar']=$filename;

          $session_msg='<div class="alert alert-success">
          profile updated</div>';
          

          echo 'your work is done';
        }else{

          echo 'mission could not be accomplished';
        }
      }

    }else{

      echo 'the file size is not right';


    }

    //Extract file extension 
    // $ext=pathinfo($_FILES[]);

    
  }

  if(isset($_POST['username']) && isset($_POST['email'])){

    $username=htmlspecialchars($_POST['username']);
    $email=htmlspecialchars($_POST['email']);

    $sql="UPDATE users set username='$username',email='$email' where id='$id'";

    $result=mysqli_query($con,$sql);

    if($result){

      $session_msg='<div class="alert alert-success">
      profile updated</div>';

      $_SESSION['user']=$username;
      $_SESSION['email']=$email;


    }



  }
 }

//  echo $sql;





 ?>

<?php include('templates/auth_header.php') ?>


<!-- Password Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
        <div class="mb-3">
<input type="password" class="form-control"  placeholder="enter old password">
</div>


<div class="mb-3">
<input type="password"  class="form-control" placeholder="enter new password">
</div>

<div class="mb-3">
<input type="password"  class="form-control" placeholder="confirm new password">
</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div>
  <?=$session_msg?>
</div>
<form action="" enctype="multipart/form-data" method="POST">


<div class="d-flex">
      
      <div class="mb-3">
          <input type="file" placeholder="upload image" name="avatar">
      </div>

      <div>
        <img src="public/avatar/default.jpg" alt="user image live" style="height:15vmin;width:15vmin">
      </div>
</div>


<div class="mb-3">
<input type="text" name="username" class="form-control"  placeholder="enter your username" value="<?=$_SESSION['user']?>">
</div>


<div class="mb-3">
<input type="email" name="email" class="form-control"  placeholder="enter your email" value="<?=$_SESSION['email']?>">
</div>



<button name="save">save</button>

</form>

<button data-bs-toggle="modal" data-bs-target="#exampleModal">advanced</button>


<?php include('templates/footer.php') ?>