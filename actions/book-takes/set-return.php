<?php

$conn = conn();
$db   = new Database($conn);

$db->update('book_takes',[
    'return_date' => date('Y-m-d')
],[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pengembalian berhasil disimpan']);
header('location:index.php?r=book-takes/index');
die();