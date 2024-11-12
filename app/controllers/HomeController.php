<?php
require_once __DIR__ . '/../models/EnvironmentalTips.php';
require_once __DIR__ . '/../../config/config.php';

class HomeController {
    public function showLandingPage() {
        require '../app/views/home.php';
    }

    public function getEnvironmentalTips() {
        header('Content-Type: application/json');
        $tips = [
            "Reduce el uso de plásticos.",
            "Recicla y reutiliza.",
            "Planta árboles.",
            "Ahorra agua."
        ];
        echo json_encode(['tips' => $tips]);
    }

    public function submitForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            try {
                // Inserta los datos en la base de datos
                $conn = getDBConnection();
                $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':message', $message);
                $stmt->execute();

                // Redirige al usuario con un mensaje de éxito
                header("Location: /MANA/public/form.html?status=success");
                exit;
            } catch (PDOException $e) {
                // Maneja cualquier error en la base de datos
                header("Location: /MANA/public/form.html?status=error");
                exit;
            }
        } else {
            // Si el método no es POST, muestra un error 405
            http_response_code(405); // Método no permitido
            echo "Método no permitido";
        }
    }
}
?>
