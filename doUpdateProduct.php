<?php 
session_start();
	if(isset($_POST["productName"])){
		include 'connect.php';
		$productID = $_POST["id"];
		$productName = $_POST["productName"];
		$productDesc = $_POST["productDesc"];
		$productPrice = $_POST["productPrice"];
		$productImage = $_FILES["productImage"];

		if($productName==""){
			$message = "product Name must be filed!";
		}else if($productDesc==""){
			$message = "productDesc must be filled!";
		}else if($productPrice==""){
			$message = "productPrice must be filled!";
		}else {

			if(isset($productImage["tmp_name"]) && $productImage["tmp_name"]!=""){
				$filePath="upload/".basename($productImage["name"]);
				move_uploaded_file($productImage["tmp_name"],$filePath);
				$connection -> query("UPDATE product SET productImage='".$filePath."' WHERE productID = ".$productID);
			}
			
			$connection -> query("UPDATE product SET productName='".$productName."',productDesc='".$productDesc."',productPrice='".$productPrice."' WHERE productID = ".$productID);
			$message = "succesfully UPDATE product";
		}
		$_SESSION["message"] = $message;
		header("location:update.php?id=".$productID);
		exit();
	}
	header("location:view.php");
	exit();
?>