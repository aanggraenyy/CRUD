<?php 
session_start();
	if(isset($_POST["productName"])){
		include 'connect.php';

		$productName = $_POST["productName"];
		$productDesc = $_POST["productDesc"];
		$productPrice = $_POST["productPrice"];
		$productImage = $_FILES["productImage"];

		if($productName==""){
			$message = "product Name must be filed!";
		}else if($productDesc==""){
			$message = "productDescription must be filled!";
		}else if($productPrice==""){
			$message = "productPrice must be filled!";
		}else if(!isset($productImage["tmp_name"]) || $productImage["tmp_name"]==""){
			$message= "productImage must be chosen";
		}else {
			$filePath="upload/".basename($productImage["name"]);
			move_uploaded_file($productImage["tmp_name"],$filePath);

			$connection -> query("INSERT INTO product VALUES (null,'".$productName."','".$productDesc."','".$productPrice."','".$filePath."')");
			$message = "succesfully added new product";
		}
		$_SESSION["message"]=$message;
	}
	header("location:insert.php");
	exit();
?>