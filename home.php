<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>PC Listings</title>
    <style>
/* style4.css */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #2c2c2c;
    color: #f0f0f0;
    margin: 0;
    padding: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

table {
    width: 70%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #3c3c3c;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    color: #f0f0f0;
}

th, td {
    padding: 15px;
    text-align: center;
    border: 1px solid #555;
}

th {
    background-color: #444;
    color: #f0f0f0;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #3e3e3e;
}

tr:hover {
    background-color: #484848;
}

input[type="button"] {
    padding: 10px 15px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="button"]:hover {
    background-color: #45a049;
}

img {
    border-radius: 5px;
}



    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <?php 
        include 'log_out.php';
        $conn = mysqli_connect("localhost", "root", "", "re");

        if ((time()-$_SESSION['timeout'])> 120){

            header("Location: new1.php");
        }
        $_SESSION['timeout'] =time();

        $sql = "SELECT * FROM PC_Q";
        $query = mysqli_query($conn, $sql);

        echo '<table width="50%" bgcolor="beige" border="1" align="center">';
        echo '<tr><th>ID</th><th>Price</th><th>CPU</th><th>RAM</th><th>Graphic Card</th><th>PC Photo</th><th>Details</th>';
        if (isset($level) && $level == 1) {
            echo '<th>Delete</th>';
            echo '<th>updata</th>';     
        }         
        echo '</tr>';

        while ($row = mysqli_fetch_row($query)) {
            echo '<tr align="center">';
            echo '<td>'.$row[0].'</td>'; // id
            echo '<td>'.$row[1].'</td>'; // Price
            echo '<td>'.$row[2].'</td>'; // CPU
            echo '<td>'.$row[3].'</td>'; // RAM
            echo '<td>'.$row[4].'</td>'; // Graphic Card
            echo '<td><img src="'.$row[5].'" width="150" height="150"></td>'; // Image
            echo '<td><a href="page.php?id='.$row[0].'"><input type="button" value="details"></a></td>'; // Details Button
            if (isset($level) && $level == 1) {
                echo '<td><a href="del.php?id='.$row[0].'"><input type="button" value="delete"></a></td>';// Delete Button
            }
            if (isset($level) && $level == 1) {
                if (isset($level) && $level == 1) {
                    echo '<td><a href="updata.php?id='.$row[0].'"><input type="button" value="updata"></a></td>';// Delete Button
                }
            }
            

        }

        echo '</table>';

        mysqli_close($conn);
        ?>
    </form>
</body>
</html>