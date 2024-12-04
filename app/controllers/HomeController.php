<?php
require_once __DIR__ . '/../models/FormModel.php';
require_once __DIR__ . '/../../config/conexionBD.php';

class HomeController {

    public function submitForm() {  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'nombre' => $_POST['nombre'],
                'edad' => $_POST['edad'],
                'profesion' => $_POST['profesion'],
                'correo' => $_POST['correo'],
                'frecuencia' => $_POST['frecuencia'],
                'actividades' => $_POST['actividades'],
                'importancia' => $_POST['importancia'],
                'acciones' => isset($_POST['acciones']) ? (is_array($_POST['acciones']) ? $_POST['acciones'] : [$_POST['acciones']]) : [],
                'voluntariado' => $_POST['voluntariado'],
                'arboles' => $_POST['arboles'],
                'horas' => $_POST['horas'],
                'areas' => isset($_POST['areas']) ? (is_array($_POST['areas']) ? $_POST['areas'] : [$_POST['areas']]) : [],
                'conocimiento' => $_POST['conocimiento'],
                'aprender' => $_POST['aprender'],
                'informacion' => $_POST['informacion'],
                'objetivos' => $_POST['objetivos'],
                'cambios' => $_POST['cambios'],
                'mejorar' => $_POST['mejorar'],
                'comentarios' => $_POST['comentarios']
            ];

            $model = new FormModel();
            if ($model->saveFormData($formData)) {
                header("Location: /MANA/public/layout/pages/form.html?status=success");
            } else {
                header("Location: /MANA/public/layout/pages/form.html?status=error");
            }
            exit;
            

        } else {
            http_response_code(405);
            echo "Método no permitido";
        }
    }
    
}
?>
