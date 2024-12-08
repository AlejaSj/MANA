<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('mana');
    $productos->list();
    echo $productos->getData();
?>