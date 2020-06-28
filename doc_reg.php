<?php
session_start();
include("connect2.php");
?>

<!DOCTYPE HTML>
<html>

 <head>
    <title>AROGYA</title>
    <style>
        .error {
            color: rgb(12, 45, 45);
        }
    </style>
    <link href="css/style2.css" rel="stylesheet">
 </head>

  <body>

    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // define variables and set to empty values
    $idErr = $nameErr = $usernameErr = $emailErr = $passwordErr = $con_passwordErr = $contactErr = $h_depErr = $aboutErr = $registerErr = "";
    $id = $name = $username = $email = $password = $con_password = $contact = $h_dep = $specialization = $about = $register = $con_passwordw = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["id"])) 
        {
            $idErr = "ID is required";
        } 
        else 
        {
            $id = test_input($_POST["id"]);
        }
        if (empty($_POST["name"])) 
        {
            $nameErr = "Name is required";
        } 
        else 
        {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) 
            {
                $nameErr = "Only letters and white space allowed";
            }
        }
          if (empty($_POST["username"])) {
            $usernameErr = "USERNAME is required";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
        //$con_passwordw = test_input($_POST["con_password"]);
        //$con_password = password_hash($con_passwordw, PASSWORD_DEFAULT);
       // if (empty($_POST["con_password"])) {
        //   $con_passwordErr = "Confirmation of password is required";
       //} else if($con_password!=$password){
        //$con_passwordErr = "Password and confirm password did not match"; }
       // else {
            $con_password = test_input($_POST["con_password"]);
       // }

        if (empty($_POST["contact"])) {
            $contactErr = "Contact number is required";
        } else {
            $contact = test_input($_POST["contact"]);
            // check if contact number is well-formed

        }
        if (empty($_POST["h_dep"])) {
            $h_depErr = "HEALTH DEPARTMENT is required";
        } else {
            $h_dep = test_input($_POST["h_dep"]);
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $specialization)) {
            $stateErr = "Only letters and white space allowed";
        } else {
            $specialization = test_input($_POST["specialization"]);
            // check if state only contains letters and whitespace
           
        }

        $about = test_input($_POST["about"]);

        if (empty($_POST["register"])) {
            $registerErr = "Declaration is required";
        } else {
            $register = test_input($_POST["register"]);
        }


        $_SESSION["h_dep"] = $h_dep;


        if (empty($idErr) && empty($nameErr) && empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($con_passwordErr) && empty($contactErr) && empty($h_depErr) && empty($aboutErr) && empty($registerErr)) 
        {
            $sql = "INSERT INTO doctor(id,name,username,email,password,contact number,health department,specialization,about) VALUES(?,?,?,?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $sql))
             {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssisss", $param_id, $param_name, $param_username, $param_email, $param_password, $param_contact, $param_h_dep, $param_specialization, $param_about);
                // Set parameters
                $param_id = $id;
                $param_name = $name;
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_contact = $contact;
                $param_h_dep = $h_dep;
                $param_specialization = $specialization;
                $param_about = $about;
               
                 // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: doc_login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }
    }
    ?>
    <div class="reg_form">
        <h2 style="color:#470b04">Doctor registration form</h2>
        <br><br>
        <p><span class="error">* required field</span></p>
        <form method="post" action="">
            ID:<br> <input type="number" name="id">
            <span class="error">* <?php echo $idErr; ?></span>
            <br><br>
            NAME:<br> <input type="text" name="name">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>
            USERNAME:<br> <input type="text" name="username">
            <span class="error">* <?php echo $usernameErr; ?></span>
            <br><br>
            
            E-mail:<br> <input type="email" name="email">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
            PASSWORD:<br> <input type="password" name="password">
            <span class="error">* <?php echo $passwordErr; ?></span>
            <br><br>
            Confirm password:<br>
            <input type="password" name="con_password">
            <span class="error">* <?php echo $con_passwordErr; ?></span>
            <br><br>
            Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
            <span class="error">* <?php echo $contactErr; ?></span>
            <br><br>
            HEALTH DEPARTMENT:<br>
            <input type="radio" name="h_dep" value="card">Cardiology<br>
            <input type="radio" name="h_dep" value="neur">Neurology<br>
            <input type="radio" name="h_dep" value="Bp">B+ve <br>
            <input type="radio" name="h_dep" value="Bn">B-ve<br>
            <input type="radio" name="h_dep" value="Op">O+ve<br>
            <input type="radio" name="h_dep" value="On">O-ve<br>
            <input type="radio" name="h_dep" value="ABp">AB+ve<br>
            <input type="radio" name="h_dep" value="ABn">AB-ve<br>
            <span class="error">* <?php echo $h_depErr; ?></span>
            <br><br>
            SPECIALIZATION:<br> <input type="text" name="specialization">
            <br><br>
            ABOUT:<br> <input type="text" name="about">
            <span class="error">* <?php echo $aboutErr; ?></span>
            <br><br>
            <b>DECLARATION: </b>
            <input type="checkbox" name="register" value="yes"> The following information provided is true. If any of the above information is found false, I will be held responsible.
            <span class="error">* <?php echo $registerErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
  </body>

</html>