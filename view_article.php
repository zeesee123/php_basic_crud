<?php include('helpers.php');

sess_starter();
?>



<?php include('templates/auth_header.php') ?>

<?php 


$article_id='';
$array='';


if(isset($_GET['id'])){

    $article_id=$_GET['id'];


}



require_once('db/database.php');


$sql="SELECT * from articles where id='$article_id'";

$result=mysqli_query($con,$sql);

if($result and mysqli_num_rows($result)>0){

    $array=mysqli_fetch_assoc($result);


    // print_r($array);

    
}


?>

<h3><?=$array['title']?></h3>

<p><?=$array['body']?></p>





<?php include('templates/footer.php') ?>