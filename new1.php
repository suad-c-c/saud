<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <title>Log in</title>
    <style>
body {
    display: flex;
    flex-direction: column; 
    justify-content: center; 
    align-items: center;
    margin: 200px; 
    background-color: #2A272A;
    font-family: Arial, sans-serif;
    color: white;
}

.box {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

.h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: white;
}

label {
    display: block;
    margin-bottom: 8px;
    color: white;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    text-align: center;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error {
    color: red;
    margin-bottom: 20px;
}
a {
    color: #4CAF50; 
    text-decoration: none; 
    transition: color 0.3s; 
}

a:hover {
    color: #45a049; 
}


    </style>
</head>
<body>
<div class="box">
<h1 class="h1">Log In</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <label class="textbar1" for="textbar1">Enter username:</label><br>
    <input class="username" id="textbar1" name="user" type="text" placeholder="username"><br><br><br><br>

    <label class="textbar2" for="textbar2">Enter Password:</label><br>
    <input class="pws" id="textbar2" name="pws" type="password" placeholder="Password"><br><br>
<P>you dont have account  <a href="re.php">click here</a></P>
<p>If you forget password <a href="password.php">click here</a></p>

    <input class="sub" type="submit" name="sub" value="Continue"><br><br>

    <?php
    session_start();

    $ms1 = $ms2 = $ms3 = "";
    if (isset($_POST['sub'])) {
        $username = $_POST['user'];
        $pws = $_POST['pws'];

        if (empty($username)) {
            $ms1 = 'Please enter username';
            echo $ms1 . "<br>";
        }

        if (empty($pws)) {
            $ms2 = 'Please enter password';
            echo $ms2 . "<br>";
        }

        if ($ms1 == "" && $ms2 == "") {
            $conn = mysqli_connect("localhost", "root", "", "re");
            
            $password = md5($pws);
            $sql = "SELECT * FROM reg_in WHERE username='$username' AND password='$pws'";
            $query = mysqli_query($conn, $sql);

            if ($query) {

                $row_num = mysqli_num_rows($query);
                
                if ($row_num == 1) {
                    $rslt = mysqli_fetch_assoc($query);
                    $_SESSION['id'] = $rslt['ID'];
                    $_SESSION['name'] = $rslt['username'];
                    $_SESSION['timeout'] =time(); 
                    $_SESSION['level'] = $rslt['level'];
                    header("location:home.php");
                    if ($_SESSION['level'] == 0) {
                    $_SESSION['id'] = $rslt['ID'];
                    $_SESSION['name'] = $rslt['username'];
                    $_SESSION['timeout'] =time(); 
                    $_SESSION['level'] = $rslt['level'];
                        header("location:insert_page.php");
                    } 
                } else {
                    $ms3 = "Invalid username or password";
                    echo $ms3 . "<br>";
                }
            }
            mysqli_close($conn);
        }
    }
    ?>
</form>
</div>
</body>
</html>