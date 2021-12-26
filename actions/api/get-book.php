<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('books',[
    'barcode' => $_GET['barcode']
]);

echo json_encode($data);
die();