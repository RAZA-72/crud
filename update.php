<?php include ('connect.php'); ?>
<?php

$id = $_GET['id'];
if($id){
$sql = "SELECT * from crud where id =$id";
$result = $conn->query($sql) ;
$row = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">

<input type="text" name="Name" value="<?php echo  $row["Name"];?>" placeholder="enter your name">
<br>
<!-- <input type="file" name="img" value="" placeholder="upload image"> -->
 

<img src="dataimage/<?php echo $row['img']; ?>" width="100" alt="Current Image"><br>

<input type="file" name="img"><br>


<br>
<input type="phone" name="phone" value="<?php echo $row["phone"];?>" placeholder="enter your phone no">
<br>
<button type="submit" name="update">update</button>
</form>   
</body>
</html>

<?php

if (isset($_POST['update'])) {
    $name = $_POST['Name'];
    $phone = $_POST['phone'];

    if ($_FILES['img']['name']) {
        $img = $_FILES['img']['name'];
        $imgTmp = $_FILES['img']['tmp_name'];
        $uploadDir = "dataimage/" . basename($img);
        

        if (move_uploaded_file($imgTmp, $uploadDir)) {
            $newImg = $img;  // Use the new image name
        } 

    $query = "UPDATE crud SET Name = '$name', phone = '$phone', img = '$newImg' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}}
?>
