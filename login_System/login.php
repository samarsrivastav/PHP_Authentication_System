<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'partial/dbConnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $exist = false;
    // $sql = "Select * from users where email='$email' AND password='$password'";
    $sql = "Select * from users where email='$email' ";
    $result = @mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($rows = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $rows['password'])) {
                $err = true;
                $showerr = false;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                header("location: welcome.php");
            } else {
                $err = false;
                $showerr = "Invalid credentials";
            }
        }
    } else {
        $err = false;
        $showerr = "Invalid credentials";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    require 'partial/_navbar.php';
    ?>
    <?php
    if ($err) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succesful!!</strong> you are successfully logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showerr) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!!</strong> ' . $showerr . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Login Page</h1>
        <form action="/PHP TUTORIAL/login_System/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby=" emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type=" submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
</body>

</html>