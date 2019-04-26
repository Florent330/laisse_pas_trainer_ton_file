<?php


if(!empty($_FILES['files']['name'][0])){

    $files = $_FILES['files'];

    $uploaded = [];

    $failed = [];

    $allowed = ['png', 'jpg', 'gif'];



    foreach ($files['name'] as $position => $file_name){

        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext, $allowed)){
            if($file_error === 0){
                if($file_size <= 1048576 ){
                    $file_name_new = uniqid('image') . '.' . $file_ext;
                    $file_destination = 'img/' . $file_name_new;
                    if(move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$position] = $file_destination;
                    }else{
                        $failed[$position] = "[{$file_name}] failed to upload";
                    }
                }else{
                    $failed[$position] = "[{$file_name}] is too large";
                }
            }else{
                $failed[$position] = "[{$file_name}] errored with code {$file_error}";
            }
        }else{
            $failed[$position] = "[{$file_name}] file extension  '{$file_ext}' is not allowed";
        }
    }
}?>


<! doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Multiple file upload</title>
    </head>
<body>
<div class="container">

    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple="multiple">
        <input type="submit" value="Upload">
    </form>
    <div class="container">
    <div class="row col-3">
<?php
$dir    = 'img/';
$files1 = scandir($dir, 1);

 foreach ($files1 as $key => $image){
    if ($image != '.' && $image != '..'){
    ?>
    <img src="<?= $dir . $image ?>" alt="" class="img-thumbnail">
        <p><?= $image?></p>

        <a href="delete.php?delete=<?= $image ?>" class="btn btn-primary" >delete</a>


    <?php } } ?>

    </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
