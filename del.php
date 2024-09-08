<?php    
$conn = mysqli_connect("localhost","root","","re");
    if($conn===false){
        die("error".mysqi_connect_error());
    }
    $id = $_GET['id'];

    $sql="DELETE from pc_q where id=$id";
if (mysqli_query($conn,$sql)){
echo'<script>
alert("product successfully deleted");
window.location.href ="home.php";
</script>';
mysqli_close($conn);
}

    
?>