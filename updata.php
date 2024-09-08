<!DOCTYPE html>
<?php
include 'session.php';
$conn = mysqli_connect("localhost", "root", "", "re");

if (!isset($_SESSION['name'])) {
    // header("Location: new1.php");
    exit;
} else {
    if ((time() - $_SESSION['timeout']) > 900) {
        // header("Location: new1.php");
        exit;
    }
    $_SESSION['timeout'] = time();
    echo '<button>Welcome ' . $_SESSION['name'] . '</button>';
    $user = $_SESSION['name'];
}

$id = $_GET['id'];
if (!$id) {
    die("Invalid request");
}
$sql = "SELECT * FROM pc_q WHERE ID ='$id'";
$query = mysqli_query($conn, $sql);
if (!$query) {
    die("Error executing query: " . mysqli_error($conn));
}
$rslt = mysqli_fetch_assoc($query);
if (!$rslt) {
    die("No record found with ID: " . $id);
}
$price = $rslt['price'];
$cpu = $rslt['CPU'];
$RAM = $rslt['RAM'];
$gd = $rslt['graphiccard'];
$photo = $rslt['photo'];

if (isset($_POST['submit'])) {
    $filelocation = 'img/';
    $filename = basename($_FILES["photo"]["name"]);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $path = $filelocation . time() . $user . '.' . $ext;

    $price = $_POST['textbar'];
    $cpu = $_POST['cpu'];
    $RAM = $_POST['RAM'];
    $gd = $_POST['Graphiccard'];

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $path)) {
        $upimg = "UPDATE pc_q SET photo='$path' WHERE ID='$id'";
        mysqli_query($conn, $upimg);
    }

    $update = "UPDATE pc_q SET price='$price', CPU='$cpu', RAM='$RAM', graphiccard='$gd' WHERE ID='$id'";
    if (mysqli_query($conn, $update)) {
        header('Location: home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update Form</title>
    <style>
        .form {
            max-width: 500px;
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .radio-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        label {
            margin-bottom: 10px;
            display: block;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post" enctype="multipart/form-data">
        <label for="textbar" class="textbar">Enter the price for the products:</label>
        <input type="text" name="textbar" class="textbar1" value="<?php echo htmlspecialchars($price); ?>"><br><br><br><br>

        <label>Enter which CPU do you need:</label>
        <div class="radio-group">
            <input type="radio" name="cpu" value="i5 core" id="cpu1" <?php if ($cpu == 'i5 core') echo 'checked'; ?>>
            <label for="cpu1">i5 core</label>
            <input type="radio" name="cpu" value="i7 core" id="cpu2" <?php if ($cpu == 'i7 core') echo 'checked'; ?>>
            <label for="cpu2">i7 core</label>
            <input type="radio" name="cpu" value="i9 core" id="cpu3" <?php if ($cpu == 'i9 core') echo 'checked'; ?>>
            <label for="cpu3">i9 core</label>
        </div>

        <label>Enter how much RAM do you need:</label>
        <div class="radio-group">
            <input type="radio" value="8 RAM" name="RAM" id="RAM1" <?php if ($RAM == '8 RAM') echo 'checked'; ?>>
            <label for="RAM1">8 RAM</label>
            <input type="radio" value="16 RAM" name="RAM" id="RAM2" <?php if ($RAM == '16 RAM') echo 'checked'; ?>>
            <label for="RAM2">16 RAM</label>
            <input type="radio" value="32 RAM" name="RAM" id="RAM3" <?php if ($RAM == '32 RAM') echo 'checked'; ?>>
            <label for="RAM3">32 RAM</label>
        </div>

        <label for="Graphiccard">Enter which Graphic card do you need:</label>
        <select name="Graphiccard" id="Graphiccard">
            <option value="RTX4070" >RTX4070</option>
            <option value="RTX3050" >RTX3050</option>
            <option value="RTX3060" >RTX3060</option>
            <option value="RTX1650" >RTX1650</option>
        </select><br><br><br><br>

        <label for="image">Enter a photo of the PC case:</label>
        <input type="file" name="photo" id="image"><br><br>

        <input type="submit" name="submit" value="Insert"><br><br>
    </form>
</div>
</body>
</html>
