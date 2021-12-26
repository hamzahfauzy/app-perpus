<?php

$conn = conn();
$db   = new Database($conn);

$db->delete('visitors',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pengunjung berhasil dihapus']);
header('location:index.php?r=visitors/index');
die();