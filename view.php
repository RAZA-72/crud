<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
        .container {
            margin-top: 40px;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .add-btn {
            margin-left: 10px;
        }
        .table img {
            border-radius: 5px;
        }
        .btn {
            margin: 2px;
        }
    </style>
</head>
<body>

    <h1>CRUD Application</h1>

    <div class="container">
        <!-- Search Form -->
        <div class="search-bar">
            <form method="GET" class="d-flex w-75">
                <input type="text" name="search" class="form-control me-2" 
                       placeholder="Search by name..." required>
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <a href="insert.php" class="btn btn-success add-btn">Add New Record</a>
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                // Query to fetch data based on search or all records
                $query = "SELECT * FROM crud";
                if ($search) {
                    $query .= " WHERE Name LIKE '%$search%'";
                }

                $data = mysqli_query($conn, $query);

                if (mysqli_num_rows($data) > 0) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        $id = $row['id'];
                        $name = $row['Name'];
                        $imgData = $row['img'];
                        $phone = $row['phone'];

                        echo "
                        <tr>
                            <th scope='row'>$id</th>
                            <td>$name</td>
                            <td><img src='dataimage/$imgData' width='80' height='80' alt='Profile'></td>
                            <td>$phone</td>
                            <td>
                                <a href='update.php?id=$id' class='btn btn-warning btn-sm'>Edit</a>
                            </td>
                            <td>
                                <a href='delete.php?id=$id' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
            integrity="sha384-oBqDVmMz4fnFO9gybBy8zk5jBJ7lF1JTlKChM1KqVvQ4l1zZr3K6czQeR9E1FQGs" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
            integrity="sha384-2DgM6JnVfeVYBYKejlq/OVJDKVI9GR03sMnpbnjLD0vGYlNLlql+BYcbPZOdyw6g" 
            crossorigin="anonymous"></script>

</body>
</html>
