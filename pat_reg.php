<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link href="css/style2.css" rel="stylesheet">

</head>

<body style="background-color:rgb(228, 241, 254)">
    <div id="main_wrapper">
        <h1><b>Patient Login Form</b></h1>

        <form action="#" method="POST" class="form">
            <label><b>Username</b></label>
            <input name="username" type="text" class="inputvalues" placeholder="Type your username"><br><br>
            <label><b>Card Number</b></label>
            <input name="card number" type="number" class="inputvalues" placeholder="Enter your card number"><br><br>
            <label><b>Password</b></label>
            <input name="password" type="password" class="inputvalues" placeholder="Type your password"><br><br>
            <input name="login" type="submit" id="login_btn" value="login">

            <a href="register.php"><input type="button" id="register_btn" value="register">
        </form>
    </div>
</body>

</html>