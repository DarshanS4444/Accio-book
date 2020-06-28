<?php
session_start();
include("connect.php");
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>blood-O-nation</title>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
  <link href="css/style.css" rel="stylesheet">
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
  $nameErr = $emailErr = $genderErr = $contactErr = $stateErr = $ageErr = $b_groupErr = $doctorErr = $hospitalErr = $partyErr = $passwordErr = $con_passwordErr = $decErr = "";
  $name = $email = $city = $state = $gender = $age = $contact = $b_group = $reason = $password = $con_password = $party = $s_name = $s_email = $hospital = $doctor = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
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

    if (empty($_POST["contact"])) {
      $contactErr = "Contact number is required";
    } else {
      $contact = test_input($_POST["contact"]);
      // check if contact number is well-formed

    }

    if (empty($_POST["state"])) {
      $stateErr = "State is required";
    } else {
      $state = test_input($_POST["state"]);
      // check if state only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $state)) {
        $stateErr = "Only letters and white space allowed";
      }
    }


    if (empty($_POST["age"])) {
      $ageErr = "Age is required";
    } else {
      $age = test_input($_POST["age"]);
    }

    if (empty($_POST["weight"])) {
      $weightErr = "Weight is required";
    } else {
      $weight = test_input($_POST["weight"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["b_group"])) {
      $b_groupErr = "Blood group is required";
    } else {
      $b_group = test_input($_POST["b_group"]);
    }


    $reason = $_POST["reason"];
    $city = $_POST["city"];



    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
    } else {
      $password = test_input($_POST["password"]);
    }

    if (empty($_POST["con_password"])) {
      $con_passwordErr = "Confirmation of password is required";
    } //else if($con_password!=$password){
    //$con_passwordErr = "Password and confirm password did not match"; }
    else {
      $con_password = test_input($_POST["con_password"]);
    }

    if (empty($_POST["weight"])) {
      $weightErr = "Weight is required";
    } else {
      $weight = test_input($_POST["weight"]);
    }

    if (empty($_POST["hospital"])) {
      $hospitalErr = "Hospital name is required";
    } else {
      $hospital = test_input($_POST["hospital"]);
    }

    if (empty($_POST["doctor"])) {
      $doctorErr = "Consultant doctor name is required";
    } else {
      $doctor = test_input($_POST["doctor"]);
    }

    if (empty($_POST["party"])) {
      $partyErr = "Mention the party enrolling the request";
    } else {
      $party = test_input($_POST["party"]);
    }
    $s_name = $_POST["s_name"];
    $s_email = $_POST["s_email"];

    if (empty($_POST["register"])) {
      $decErr = "Declaration is required";
    } else {
      $dec = test_input($_POST["register"]);
    }


    $_SESSION["b_group"] = $b_group;

    if (empty($nameErr) && empty($emailErr) && empty($stateErr) && empty($contactErr) && empty($ageErr) && empty($genderErr) && empty($b_groupErr) && empty($hospitalErr) && empty($doctorErr) && empty($partyErr) && empty($passwordErr) && empty($con_passwordErr)) {
      $sql = "INSERT INTO recipient(name,email,city,state,contact,age,gender,b_group,reason,hospital,doctor,party,s_name,s_email,password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssissssssssss", $param_name, $param_email, $param_city, $param_state, $param_contact, $param_age, $param_gender, $param_b_group, $param_reason, $param_hospital, $param_doctor, $param_party, $param_s_name, $param_s_email, $param_password);

        // Set parameters
        $param_name = $name;
        $param_email = $email;
        $param_city = $city;
        $param_state = $state;
        $param_contact = $contact;
        $param_age = $age;
        $param_gender = $gender;
        $param_b_group = $b_group;
        $param_reason = $reason;
        $param_hospital = $hospital;
        $param_doctor = $doctor;
        $param_party = $party;
        $param_s_name = $s_name;
        $param_s_email = $s_email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          // Redirect to login page
          header("location: recipient_match.php");
        } else {
          echo "Something went wrong. Please try again later.";
        }
      }
    }
  }


  ?>
  <div class="reg_form">
    <h2 style="color:#1B1464">Recipient registration form</h2>
    <h4 style="color:#1e90ff"><b>1.The following information is collected to ensure the genuinity of the recipient.<br>2.Your name, city, email id and contact number will be given to the donor found compatible to the blood group requested.<b><br></h4>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
      Name:<br> <input type="text" name="name">
      <span class="error">* <?php echo $nameErr; ?></span>
      <br><br>
      E-mail:<br> <input type="text" name="email">
      <span class="error">* <?php echo $emailErr; ?></span>
      <br><br>
      City:<br> <input type="text" name="city">
      <br><br>
      State:<br> <input type="text" name="state">
      <span class="error">* <?php echo $stateErr; ?></span>
      <br><br>
      Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
      <span class="error">* <?php echo $contactErr; ?></span>
      <br><br>
      Age(in years):<br>
      <input type="radio" name="age" value="less">"Less than 18"<br>
      <input type="radio" name="age" value="correct">"Between 18 and 60"<br>
      <input type="radio" name="age" value="more">"More than 60" <br>
      <span class="error">* <?php echo $ageErr; ?></span>
      <br><br>
      Gender:<br>
      <input type="radio" name="gender" value="female">Female<br>
      <input type="radio" name="gender" value="male">Male<br>
      <input type="radio" name="gender" value="other">Other <br>
      <span class="error">* <?php echo $genderErr; ?></span>
      <br><br>
      Blood group required:<br>
      <input type="radio" name="b_group" value="Ap">A+ve<br>
      <input type="radio" name="b_group" value="An">A-ve<br>
      <input type="radio" name="b_group" value="Bp">B+ve <br>
      <input type="radio" name="b_group" value="Bn">B-ve<br>
      <input type="radio" name="b_group" value="Op">O+ve<br>
      <input type="radio" name="b_group" value="On">O-ve<br>
      <input type="radio" name="b_group" value="ABp">AB+ve<br>
      <input type="radio" name="b_group" value="ABn">AB-ve<br>
      <span class="error">* <?php echo $b_groupErr; ?></span>
      <br><br>
      Reason for blood requirement: <br>
      <input type="radio" name="reason" value="accident">Accident<br>
      <input type="radio" name="reason" value="illness">Illness<br>
      <input type="radio" name="reason" value="surgery">Surgery<br>
      <input type="radio" name="reason" value="others">Others<br>
      <br><br>
      Name of the hospital the recipient is receiving treatment in: <br>
      <input type="text" name="hospital"><br>
      <span class="error">* <?php echo $hospitalErr; ?></span>
      <br><br>
      Name of the consultant doctor of the recipient: <br>
      <input type="text" name="doctor"><br>
      <span class="error">* <?php echo $doctorErr; ?></span>
      <br><br>
      The request is made by: <br>
      <input type="radio" name="party" value="first">First party(The direct recipient of blood)<br>
      <input type="radio" name="party" value="second">Second party(The gaurdian of the recipient)<br>
      <span class="error">* <?php echo $partyErr; ?></span>
      If request is made by Second party:<br>
      Name(second party): <br> <input type="text" name="s_name">
      <br><br>
      E-mail(second party):<br> <input type="text" name="s_email">
      <br><br>
      Password:<br>
      <input type="password" name="password"><br>
      <span class="error">* <?php echo $passwordErr; ?></span>
      <br><br>
      Confirm password:<br>
      <input type="password" name="con_password"><br>
      <span class="error">* <?php echo $con_passwordErr; ?></span>
      <br><br>
      <b>DECLARATION: </b>
      <input type="checkbox" name="register" value="yes"> The following information provided is true. If any of the above information is found false, I will be held responsible.
      <span class="error">* <?php echo $decErr; ?></span>
      <br><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
</body>

</html>