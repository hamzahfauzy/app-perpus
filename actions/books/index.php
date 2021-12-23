<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$datas = $db->all('books',[],[
    'id' => 'DESC'
]);

foreach($datas as $data)
{
    $data->category = $db->single('categories',[
        'id' => $data->category_id
    ]);
}

return compact('datas','success_msg');