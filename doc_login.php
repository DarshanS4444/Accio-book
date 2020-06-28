<?php
include("connect2.php");
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location:doc_main.php");
    exit;
}
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "select username,password from admin where username='$username' and password='$password' ";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION["loggedin"] = true;
        header("location:admin_main.php");
    } else {
        $error = "Usernaame or password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/style2.css" rel="stylesheet">

</head>

<body>

    <h1 style="text-align:center">Doctor Login</h1>

    <div class="form">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div>
                <label>username:</label>
                <input type="text" name="username" required>
                <br><br>

            </div>
            <br><br>
            <label>Password:</label>
            <input type="password" name="password" required><br> <br>

            <input type="submit" value="Submit">
            <br>
            <p><?php echo $error ?></p>

        </form>

    </div>
    <footer style="color:#0984e3; padding:50px;">
        <p>For more details, contact us:</p>
        <p>Email us at: bloodonation@gmail.com</p>
        <p>Ring us at: 1200 930 234</p>
    </footer>

</body>

</html>