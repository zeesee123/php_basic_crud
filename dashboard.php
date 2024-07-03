<?php include('helpers.php');

   sess_starter();

   $user_id=$_SESSION['user_id'];

   $array='';


   require_once('db/database.php');

   $sql="select * from articles where user_id='$user_id'";

   $result=mysqli_query($con,$sql);

   if($result && mysqli_num_rows($result)>0){


      $array=mysqli_fetch_all($result,MYSQLI_ASSOC);


      // print_r($array);



   }

   


?>

<?php include('templates/auth_header.php') ?>

<h4>View my posts</h4>


<ul>
<?php foreach($array as $el): ?>

   <li>
      <a href="view_article.php?id=<?=$el['id']?>">
         <?=$el['title']?>
      </a>
   </li>

   

<?php endforeach; ?>
</ul>







<?php include('templates/footer.php') ?>