<!DOCTYPE html>
<html lang="en">
<head>
    <style>
body {
    display: flex;
    flex-direction: column; 
    justify-content: center; 
    align-items: center;
    margin: 0; 
    height: 100vh;
    background-color: #2A272A;
    font-family: Arial, sans-serif;
    color: white;
}

form {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: white;
}

label {
    display: block;
    margin-bottom: 8px;
    color: white;
}

input[type="password"] {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="textbar2" for="textbar2">Enter the new Password:</label><br>
        <input class="pws" id="textbar2" name="pws" type="password" placeholder="Password"><br><br>

        <label class="textbar3" for="password2">Confirm Password:</label><br>
        <input class="pws" id="password2" name="password2" type="password" placeholder="Confirm Password"><br><br>

        <input type="submit" value="submit" name="sub">
    </form>
</body>
</html>
<?php
if (isset($_POST['sub'])) {

    include 'session.php';
    $conn = mysqli_connect('localhost', 'root', '', 're');

    $pws = $_POST['pws'];
    $pws2 = $_POST['password2'];
  
    $email = $_SESSION['email'];

    $sql = "UPDATE reg_in SET password = '$pws' WHERE email ='$email'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $row_num = mysqli_affected_rows($conn);
        
        if ($row_num == 0) {
            echo 'Password updated successfully.';
        } else {
            echo 'No records updated. Make sure the email exists in the database.';
        }
    } else {
        echo 'Update failed.';
    }
}
?>