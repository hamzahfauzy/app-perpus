<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('books',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Buku berhasil dihapus']);
header('location:index.php?r=books/index');
die();