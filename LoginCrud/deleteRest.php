<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include("connection.php");

//getting id of the data from url
$idRestaurante = $_GET['id'];

//deleting the row from table
$result=mysqli_query($mysqli, "DELETE FROM Restaurante WHERE idRestaurante=$idRestaurante");

//redirecting to the display page (funcTable.php in our case)
header("Location:restTable.php");

?>

