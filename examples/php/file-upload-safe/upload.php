<?php

$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$hasErrors = false;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$extensions = array("jpeg", "jpg", "png", "gif");

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ". ";
	} else {
		echo "File is not an image.";
		$hasErrors = true;
	}
}

// Check if file already exists
if (file_exists($targetFile)) {
	echo "Sorry, file already exists.";
	$hasErrors = true;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$hasErrors = true;
}

// Allow certain file formats
if (! in_array($imageFileType, $extensions)) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$hasErrors = true;
}

// Check if $hasErrors is set to 0 by an error
if ($hasErrors) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
		$safeImageName = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
		echo "The file " . $safeImageName . " has been uploaded. <br/>";
		echo "<img src='/uploads/" . $safeImageName . "'>";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
