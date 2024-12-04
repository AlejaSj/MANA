<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('mana');
    if (isset($_POST['id'])) {
        $productos->delete($_POST['id']);
        echo $productos->getData();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
    }
?>
