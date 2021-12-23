<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('books',[
    'id' => $_GET['id']
]);

$data->category = $db->single('categories',[
    'id' => $data->category_id
]);

return compact('data');