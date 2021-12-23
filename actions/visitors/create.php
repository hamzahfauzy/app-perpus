<?php

$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert('visitors',$_POST['visitors']);

    echo 1;
    die();
}

return compact('success_msg');