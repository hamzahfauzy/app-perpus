<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('books',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    if(!empty($_FILES['books']['name']['pic']))
    {
        $pic  = $_FILES['books'];
        $ext  = pathinfo($pic['name']['pic'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/books/'.$name;
        copy($pic['tmp_name']['pic'],$file);
        $_POST['books']['pic'] = $file;
    }
    else
        $_POST['books']['pic'] = $data->pic;

    $db->update('books',$_POST['books'],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Buku berhasil diupdate']);
    header('location:index.php?r=books/view&id='.$_GET['id']);
}

$categories = $db->all('categories');

return compact('data','categories');