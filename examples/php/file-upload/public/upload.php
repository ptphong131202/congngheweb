<?php

// CẦN KIỂM TRA KỸ LƯỠNG HƠN TRƯỚC KHI LƯU FILE TRÊN SERVER
$upload_dir = 'uploads/';
$upload_file1 = $upload_dir . basename($_FILES['file1']['name']);
$upload_file2 = $upload_dir . basename($_FILES['file2']['name']);
move_uploaded_file($_FILES['file1']['tmp_name'], $upload_file1);
move_uploaded_file($_FILES['file2']['tmp_name'], $upload_file2);

header('content-type: application/json');
echo json_encode([
	'$_POST' => $_POST,
	'$_FILES' => $_FILES
]);

