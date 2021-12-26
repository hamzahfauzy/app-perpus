<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$db->query = "SELECT book_takes.*, books.title as book_title FROM book_takes JOIN books ON books.id = book_takes.book_id";
$data = $db->exec('all');

return [
    'datas' => $data,
    'success_msg' => $success_msg
];