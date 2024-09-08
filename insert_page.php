<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Store</title>
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: #ffffff;
    margin: 0;
    padding: 0;
}

.form {
    width: 50%;
    margin: 50px auto;
    background-color: #1e1e1e;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"], 
input[type="file"], 
select {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #333;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
    background-color: #2e2e2e;
    color: #ffffff;
}

input[type="radio"] {
    margin-right: 10px;
}

input[type="submit"] {
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.radio-group {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.radio-group label {
    margin-right: 20px;
}


    </style>
</head>
<body>
    
<div class="form">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <label for="textbar" class="textbar">Enter the price for the products:</label><br>
    <input type="text" name="textbar" class="textbar1"><br><br><br><br>

    <label>Enter which CPU do you need:</label><br><br>
    <div class="radio-group">
        <input type="radio" name="cpu" value="i5 core" id="cpu1">
        <label for="cpu1">i5 core</label>
        <input type="radio" name="cpu" value="i7 core" id="cpu2">
        <label for="cpu2">i7 core</label>
        <input type="radio" name="cpu" value="i9 core" id="cpu3">
        <label for="cpu3">i9 core</label>
    </div>

    <label>Enter how much RAM do you need:</label><br><br>
    <div class="radio-group">
        <input type="radio" value="8 RAM" name="RAM" id="RAM1">
        <label for="RAM1">8 RAM</label>
        <input type="radio" value="16 RAM" name="RAM" id="RAM2">
        <label for="RAM2">16 RAM</label>
        <input type="radio" value="32 RAM" name="RAM" id="RAM3">
        <label for="RAM3">32 RAM</label>
    </div>

    <label for="Graphiccard">Enter which Graphic card do you need:</label>
    <select name="Graphiccard" id="Graphiccard">
        <option value="RTX4070">RTX4070</option>
        <option value="RTX3050">RTX3050</option>
        <option value="RTX3060">RTX3060</option>
        <option value="RTX1650">RTX1650</option>
    </select><br><br><br><br>

    <label for="image">Enter a photo of the PC case:</label>
    <input type="file" name="photo" id="image"><br><br>

    <input type="submit" name="submit" value="Insert"><br><br>

    </form>
</div>

<?php
include 'log_out.php';
if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost","root","","re");

    if ((time()-$_SESSION['timeout'])> 120){
        header("Location: new1.php");
        exit();
    }
    $_SESSION['timeout'] = time();

    $file_loc = 'img/';
    $filename = time() . '_' . basename($_FILES["photo"]["name"]);
    $path = $file_loc . $filename;
    $price = $_POST['textbar'];
    $CPU = isset($_POST['cpu']) ? $_POST['cpu'] : '';
    $RAM = isset($_POST['RAM']) ? $_POST['RAM'] : '';
    $Graphiccard = $_POST['Graphiccard'];
    
    // Check for empty values
    if(empty($price) || empty($CPU) || empty($RAM) || empty($Graphiccard) || empty($_FILES["photo"]["name"])){
        echo "Please fill in all fields before proceeding.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $path)) {
            $sql = "INSERT INTO pc_q (Price, CPU, RAM, Graphiccard, photo) VALUES ('$price', '$CPU', '$RAM', '$Graphiccard', '$path')";
            if (mysqli_query($conn, $sql)) {
                header("location:home.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload file.";
        }
    }

    mysqli_close($conn);
}
?>

</body>
</html>