<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    private $data;

    public function __construct($db, $user='root', $pass='rS7;A35_nj39L') {
        $this->data = array();
        parent::__construct($db, $user, $pass);
    }

    public function add($jsonOBJ) {
        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $this->data = array(
            'status'  => 'error',
            'message' => 'Ya existe un registro con ese nombre'
        );
        if(isset($jsonOBJ->nombre)) {
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM form_info WHERE nombre = '{$jsonOBJ->nombre}' AND correo = '{$jsonOBJ->correo}'";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO form_info (nombre, edad, profesion, correo, frecuencia, actividades, importancia, acciones, voluntariado, arboles, horas, areas, conocimiento, apreder, informacion, objetivos, cambios, mejorar, comentarios, created_at)
                        VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->edad}', '{$jsonOBJ->profesion}', '{$jsonOBJ->correo}', '{$jsonOBJ->frecuencia}', '{$jsonOBJ->actividades}', '{$jsonOBJ->importancia}', '{$jsonOBJ->acciones}', '{$jsonOBJ->voluntariado}', {$jsonOBJ->arboles}, {$jsonOBJ->horas}, '{$jsonOBJ->areas}', '{$jsonOBJ->conocimiento}', '{$jsonOBJ->apreder}', '{$jsonOBJ->informacion}', '{$jsonOBJ->objetivos}', '{$jsonOBJ->cambios}', '{$jsonOBJ->mejorar}', '{$jsonOBJ->comentarios}', NOW())";
                if($this->conexion->query($sql)){
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Registro agregado";
                } else {
                    $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
    
            $result->free();
            $this->conexion->close();
        }
    }
    
    
    public function delete($id) {
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
    
        if (isset($id)) {
            // Consulta SQL para eliminar el registro
            $sql = "DELETE FROM form_info WHERE id = {$id}"; // Asegúrate de que "form_info" sea el nombre correcto de tu tabla
        
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Registro eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($this->conexion);
            }
    
            $this->conexion->close();
        }
    }
    
    
    
    

    public function edit($jsonOBJ) {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($jsonOBJ->id) ) {
            // SE REALIZA LA QUERY DE ACTUALIZACIÓN
            $sql = "UPDATE form_info 
                    SET nombre='{$jsonOBJ->nombre}', 
                        edad='{$jsonOBJ->edad}', 
                        profesion='{$jsonOBJ->profesion}', 
                        correo='{$jsonOBJ->correo}', 
                        frecuencia='{$jsonOBJ->frecuencia}', 
                        actividades='{$jsonOBJ->actividades}', 
                        importancia='{$jsonOBJ->importancia}', 
                        acciones='{$jsonOBJ->acciones}', 
                        voluntariado='{$jsonOBJ->voluntariado}', 
                        arboles={$jsonOBJ->arboles}, 
                        horas={$jsonOBJ->horas}, 
                        areas='{$jsonOBJ->areas}', 
                        conocimiento='{$jsonOBJ->conocimiento}', 
                        apreder='{$jsonOBJ->apreder}', 
                        informacion='{$jsonOBJ->informacion}', 
                        objetivos='{$jsonOBJ->objetivos}', 
                        cambios='{$jsonOBJ->cambios}', 
                        mejorar='{$jsonOBJ->mejorar}', 
                        comentarios='{$jsonOBJ->comentarios}' 
                    WHERE id={$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Registro actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }
    

    public function list() {
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ($result = $this->conexion->query("SELECT * FROM form_info")) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
    
            if (!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    
    

    public function search($search) {
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($search) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "SELECT * FROM form_info WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR edad LIKE '%{$search}%' OR profesion LIKE '%{$search}%' OR correo LIKE '%{$search}%')";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function single($id) {
        if( isset($id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM form_info WHERE id = {$id}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();
    
                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function getData() {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}

//$productos = new Productos();
?>