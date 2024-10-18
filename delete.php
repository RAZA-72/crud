<?php include ('connect.php');
?>
<?php

$id = $_GET['id'];

$query = "delete from crud where id= $id";

$result = mysqli_query($conn,$query);

if ($result) {
    // Reorder the remaining IDs sequentially
    $reorderQuery = "
        SET @count = 0; 
        UPDATE crud SET id = @count := @count + 1; 
        ALTER TABLE crud AUTO_INCREMENT = 1;
    ";}
if($result){
    header("location:view.php");
    exit();
}

?>
