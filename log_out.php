<html>
<body>
<head>
</head>
<?php 
session_start();

$id = $_SESSION['id'];
if (isset($id)) {
$name = $_SESSION['name'];
$level =$_SESSION['level'];
$_SESSION['timeout'] =time();
echo '<font>welcome <b>'. $name. '</b></font> ';
echo '<a href="new1.php"><input type="button" value="log_out"></a>';
}
else
{
header('location:new1.php');
}
?>
</body>
</html>