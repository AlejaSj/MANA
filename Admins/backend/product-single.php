<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('mana');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>