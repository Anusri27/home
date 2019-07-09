
<?php

if(isset($_POST['submit'])){

    $dbHost = "localhost";        //Location Of Database usually its localhost

    $dbUser = "root";            //Database User Name

    $dbPass = "";            //Database Password

    $dbDatabase = "userdetails";    //Database Name



    $db = mysqli_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database.");

    //Connect to the databasse

    mysqli_select_db($db,$dbDatabase)or die("Couldn't select the database.");

    //Selects the database



    /*

    The Above code can be in a different file, then you can place include'filename.php'; instead.

    */



    //Lets search the databse for the user name and password

    //Choose some sort of password encryption, I choose sha256

    //Password function (Not In all versions of MySQL).

    $usr = mysqli_real_escape_string($_POST['username']);

    $pas = hash('sha256', mysql_real_escape_string($_POST['password']));

    $sql = mysqli_query("SELECT * FROM accountDetails

        WHERE username='$usr' AND

        password='$pas'

        LIMIT 1");

    if(mysqli_num_rows($sql) == 1){

        $row = mysqli_fetch_array($sql);

        session_start();

        $_SESSION['username'] = $row['username'];

        $_SESSION['fname'] = $row['first_name'];

        $_SESSION['lname'] = $row['last_name'];

        $_SESSION['logged'] = TRUE;

        header("Location: map.php"); // Modify to go to the page you would like

        exit;

    }else{

        header("Location: login_page.php");

        exit;

    }

}else{    //If the form button wasn't submitted go to the index page, or login page

    header("Location: map.php");

    exit;

}

?>
