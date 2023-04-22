<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $err = false;
    $showerr = false;
    require 'partial/dbConnect.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = @mysqli_query($conn, $existSql);
    $numrows = mysqli_num_rows($result);
    if ($numrows > 0) {
        $showerr = "Email already exists";
    } else {
        // $exist = false;
        if (($cpass == $pass)) {
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `Email`, `password`, `date`) VALUES ( '$email', '$hash', current_timestamp());";
            $result = @mysqli_query($conn, $sql);
            $err = true;
        } else {
            $showerr = "Password do not Match";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
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
        <strong>Succesful!!</strong> your account has been created successufully.
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
        <h1 class="text-center">SignUp</h1>
        <form action="/PHP TUTORIAL/login_System/signup.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby=" emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" minlengh="8" maxlength="11" class=" form-control" id="password" name="password">
            </div>
            <div class=" mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type=" submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>