<?php

$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $_POST['book_takes']['taken_date'] = date('Y-m-d');
    $_POST['book_takes']['must_return_date'] = date('Y-m-d', strtotime('+'.config('return_margin').' day'));

    $db->insert('book_takes',$_POST['book_takes']);

    echo 1;
    die();
}

return compact('success_msg');