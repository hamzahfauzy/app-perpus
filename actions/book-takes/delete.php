<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('book_takes',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Peminjaman berhasil dihapus']);
header('location:index.php?r=categories/index');
die();