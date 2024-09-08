<html>
<body>
<head>
</head>
<?php session_start();

$id = $_SESSION['id'];
if (isset($id)) {
$name = $_SESSION['name'];
$level =$_SESSION['level'];
$_SESSION['timeout'] =time();
}
else
{
header('location:new1.php');
}
?>
</body>
</html>