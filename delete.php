<?php
if (file_exists('img/'. $_GET['delete'])){
    unlink('img/'. $_GET['delete']);
    header('Location: index.php');
}