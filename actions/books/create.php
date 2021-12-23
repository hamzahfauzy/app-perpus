<?php

$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{
    $pic  = $_FILES['books'];
    $ext  = pathinfo($pic['name']['pic'], PATHINFO_EXTENSION);
    $name = strtotime('now').'.'.$ext;
    $file = 'uploads/books/'.$name;
    copy($pic['tmp_name']['pic'],$file);
    $_POST['books']['pic'] = $file;

    $book = $db->insert('books',$_POST['books']);

    set_flash_msg(['success'=>'Buku berhasil ditambahkan']);
    header('location:index.php?r=books/view&id='.$book->id);
}

$categories = $db->all('categories');

return compact('categories');