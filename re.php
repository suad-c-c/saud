<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create an Account</title>
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
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
}

label {
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 5px;
    background-color: #3c3c3c;
    color: white;
    text-align: center;
}

a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    color: #45a049;
}

.sub {
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.sub:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
<div class="box">
    <h1 class="h1">Create an account</h1>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label class="textbar1" for="textbar1">Enter username:</label><br>
        <input class="username" id="textbar1" name="user" type="text" placeholder="username">
        <span class="error"><?php echo $ms1 ?? ''; ?></span><br><br><br><br>

        <label class="textbar2" for="textbar2">Enter Password:</label><br>
        <input class="pws" id="textbar2" name="pws" type="password" placeholder="Password">
        <span class="error"><?php echo $ms3 ?? ''; ?></span><br><br>

        <label class="textbar3" for="password2">Confirm Password:</label><br>
        <input class="pws" id="password2" name="password2" type="password" placeholder="Confirm Password">
        <span class="error"><?php echo $ms4 ?? ''; ?></span><br><br>

        <label class="textbar4" for="email">Enter Email:</label><br>
        <input class="pws" id="email" name="email" type="email" placeholder="Email">
        <span class="error"><?php echo $ms6 ?? ''; ?></span><br><br>

        <p>If you have an account <a name="link" href="new1.php">click here</a></p>
        <input class="sub" type="submit" name="sub" value="Create">
    </form>

    <?php
    session_start();

    $ms1 = $ms2 = $ms3 = $ms4 = $ms5 = $ms6 = "";
    if (isset($_POST['sub']))  { 
        $username = $_POST['user'];
        $pws = $_POST['pws'];
        $pws2 = $_POST['password2'];
        $email = $_POST['email'];
        $_SESSION['success'] = "";

        if (empty($username)) {
            $ms1 = 'Username is required';
        }
        if (empty($pws)) {
            $ms3 = 'Password is required';
        }
        if (empty($pws2)) {
            $ms4 = 'Password confirmation is required';
        }
        if (empty($email)) {
            $ms6 = 'Email is required';
        }

        if ($pws != $pws2) {
            $ms5 = 'Passwords do not match';

        }

        if ($ms1 == "" && $ms3 == "" && $ms4 == "" && $ms5 == "" && $ms6 == "") {    
            $db = mysqli_connect('localhost', 'root', '', 're');
            
            $checkQuery = "SELECT * FROM reg_in WHERE username='$username' OR email='$email' LIMIT 1";
            $result = mysqli_query($db, $checkQuery);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                if ($user['username'] === $username) {
                    echo 'Username already exists'.'<br>';
                }

                if ($user['email'] === $email) {
                    echo 'Email already exists'.'<br>';
                }
            } else {
                $password = md5($pws);
                $query = "INSERT INTO reg_in (username, password, email, level) VALUES ('$username', '$pws', '$email', 0)";
                if (mysqli_query($db, $query)) {
                    $_SESSION['username'] = $username;
                    header('location: new1.php');
                    exit();
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($db);
                }
            }

            mysqli_close($db);
        }
    }
    ?>
</div>
</body>
</html>