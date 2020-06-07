<?php

include("connect.php");
$name=$email=$password=$con_pass="";
$email_error=$password_error=$con_pass_error="";

if($_SERVER['REQUEST_METHOD']=='POST'){


    $name=$_POST['name'];
    
    $sql="select id from user where email=? ";

    if($stmt=mysqli_prepare($link,$sql)){

        mysqli_stmt_bind_param($stmt,"s",$param_email);
        $param_email=$_POST['email'];

        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt)==1){

                $email_error="This email already exists";
            }
            else{

                $email=$_POST["email"];
            }
        }
    }
}




?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/starter-template/">
    <title>Sign up</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    
  </head>

  <body>
<form action="post">
    <h2>Sign up form</h1>
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    <label>Email id:</label><br>
    <input type="email" name="email" id="" required><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" id="" required><br><br>
    <label>Confirm password:</label><br>
    <input type="password" name="con_pass" id="" required><br><br>
    <input type="submit" value="Submit"><br><br>
</body>
</html>
