<?php
class FormModel {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function saveFormData($data) {
        try {
            $data['acciones'] = implode(',', $data['acciones']);
            $data['areas'] = implode(',', $data['areas']);

            $query = "INSERT INTO form_info (
                nombre, edad, profesion, correo, frecuencia, actividades, importancia, acciones, voluntariado, 
                arboles, horas, areas, conocimiento, aprender, informacion, objetivos, cambios, mejorar, comentarios
            ) VALUES (
                :nombre, :edad, :profesion, :correo, :frecuencia, :actividades, :importancia, :acciones, :voluntariado,
                :arboles, :horas, :areas, :conocimiento, :aprender, :informacion, :objetivos, :cambios, :mejorar, :comentarios
            )";

            $stmt = $this->db->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            error_log("Error al guardar datos: " . $e->getMessage());
            return false;
        }
    }
}
?>
