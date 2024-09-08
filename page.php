<!DOCTYPE html>
<head>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #2c2c2c;  
    color: #f0f0f0; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.bord {
    background-color: #3c3c3c;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); 
    border-radius: 8px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th {
    background-color: #007BFF;
    color: #fff;
    padding: 10px;
    text-align: center;
    font-size: 1.2em;
}

td {
    padding: 10
}

</style>
<html>
<body>
    <div class="bord">
    <?php
    if (isset($_GET['id'])) {
        include 'log_out.php';
        $id = $_GET['id'];
        
        $conn = mysqli_connect("localhost","root","","re");

        if ((time()-$_SESSION['timeout'])> 120){

            header("Location: new1.php");
        }
        $_SESSION['timeout'] =time();
        

        
        $sql = "SELECT * FROM pc_q WHERE ID=$id";
        $query = mysqli_query($conn, $sql);
        
        if ($query) {
            echo '<table>';
            $rslt = mysqli_fetch_assoc($query);
            echo '<tr><th colspan="2"><span>All Details</span></th></tr>';
            echo '<tr><td>Price:</td><td>' . $rslt['price'] . '</td></tr>';
            echo '<tr><td>CPU:</td><td>' . $rslt['CPU'] . '</td></tr>';
            echo '<tr><td>Graphic Card:</td><td>' . $rslt['graphiccard'] . '</td></tr>';
            echo '<tr><td colspan="2"><img width="100" height="100" src="' . $rslt['photo'] . '"></td></tr>';
            echo '</table>';
        }

        mysqli_close($conn);
    }
    ?>
    </div>
</body>
</html>
