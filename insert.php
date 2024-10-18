<?php include ('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Add New Record</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="Name" id="name" 
                                placeholder="Enter your name" required>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="img" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" name="img" id="img" required>
                                <div class="invalid-feedback">
                                    Please upload an image.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" 
                                placeholder="Enter your phone number" required>
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="save" class="btn btn-success btn-block">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBy8zk5jBJ7lF1JTlKChM1KqVvQ4l1zZr3K6czQeR9E1FQGs" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-2DgM6JnVfeVYBYKejlq/OVJDKVI9GR03sMnpbnjLD0vGYlNLlql+BYcbPZOdyw6g" crossorigin="anonymous"></script>

    <script>
        // Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['Name'];
    $img = $_FILES['img']['name'];
    $imgTmp = $_FILES['img']['tmp_name'];

    $uploadDir = "dataimage/" . basename($img);
    move_uploaded_file($imgTmp, $uploadDir);

    $phone = $_POST['phone'];

    $query = "INSERT INTO crud(Name, phone, img) VALUES ('$name', '$phone', '$img')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        header("location:view.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
