<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="home.css" type="text/css">
    <title>Login Page</title>
  </head>
  <body>
    <?php

    $dbname = 'userdetails';
    $username = 'root';
    $password = "";
    $servername = "localhost";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if(!$conn){
      die("Error in connection to database");
    }

  if($_SERVER["REQUEST_METHOD"] == "POST") {

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $stmt = $conn->prepare('SELECT id FROM accountDetails where username=? and password=?');
      $stmt->bind_param("ss", $myusername,$mypassword);
      $stmt->execute();

      $result = $stmt->get_result();
      if($result->num_rows === 0)
        echo "Wrong id or password";
        else {
          echo("Done");
          alert("succees!");
          header('location: map.php');

        }


        }

   // --    $sql = "SELECT id FROM accountDetails WHERE username = '$myusername' and passcode = '$mypassword'";
   // --    $result = mysqli_query($db,$sql);
   // --    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   // --    $active = $row['active'];
   // --
   // --    $count = mysqli_num_rows($result);
   // --
   // --    // If result matched $myusername and $mypassword, table row must be 1 row
   // --
   // --    if($count == 1) {
   // --       session_register("myusername");
   // --       $_SESSION['login_user'] = $myusername;
   // --
   // --       header("location: map.php");
   // --    }else {
   // --       $error = "Your Login Name or Password is invalid";
   // --    }
   // -- }
?>

    <div class="login">
      <h1>Login </h1>
      <form method="post" action="">
        <p><input type="text" name="login" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
</div>

<div class="login-help">
  <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
</div>

  </body>
</html>
