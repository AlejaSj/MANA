// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    // Suponiendo que tienes una función para listar los productos, aquí agregamos dinámicamente las filas
    function listarProductos() {
        $.get('./backend/product-list.php', function(response) {
            const products = JSON.parse(response); // Suponiendo que la respuesta sea JSON
            const tableBody = $('#products');
            tableBody.empty(); // Limpiamos la tabla antes de agregar nuevos datos

            products.forEach(product => {
                const row = `
                    <tr productId="${product.id}">
                        <td>${product.id}</td>
                        <td>${product.nombre}</td>
                        <td>${product.edad}</td>
                        <td>${product.profesion}</td>
                        <td>${product.correo}</td>
                        <td>${product.frecuencia}</td>
                        <td>${product.actividades}</td>
                        <td>${product.importancia}</td>
                        <td>${product.acciones}</td>
                        <td>${product.voluntariado}</td>
                        <td>${product.arboles}</td>
                        <td>${product.horas}</td>
                        <td>${product.areas}</td>
                        <td>${product.conocimiento}</td>
                        <td>${product.aprender}</td>
                        <td>${product.informacion}</td>
                        <td>${product.objetivos}</td>
                        <td>${product.cambios}</td>
                        <td>${product.mejorar}</td>
                        <td>${product.comentarios}</td>
                        <td>${product.created_at}</td>
                        <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
                tableBody.append(row);
            });
        });
    }

    

    $('#search').keyup(function() {
        let search = $('#search').val().toLowerCase();  // Convierte a minúsculas para hacer la búsqueda insensible a mayúsculas
        if(search) {
            $('#products tr').each(function() {
                let row = $(this);
                let match = false;
    
                // Recorre todas las celdas de la fila
                row.find('td').each(function() {
                    // Si el valor de la celda contiene la búsqueda, se marca la fila como coincidencia
                    if ($(this).text().toLowerCase().includes(search)) {
                        match = true;
                    }
                });
    
                // Si la fila coincide con la búsqueda, la mostramos, de lo contrario, la ocultamos
                if (match) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        } else {
            // Si no hay texto de búsqueda, mostramos todas las filas
            $('#products tr').show();
        }
    });
    
    

    $('#product-form').submit(e => {
        e.preventDefault();
    
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let postData = JSON.parse($('#description').val());
    
        // SE AGREGA EL NOMBRE DEL PRODUCTO Y EL ID (SI EXISTE)
        postData['nombre'] = $('#name').val();
        postData['edad'] = $('#edad').val(); // Agregado
        postData['profesion'] = $('#profesion').val(); // Agregado
        postData['correo'] = $('#correo').val(); // Agregado
        postData['frecuencia'] = $('#frecuencia').val(); // Agregado
        postData['actividades'] = $('#actividades').val(); // Agregado
        postData['importancia'] = $('#importancia').val(); // Agregado
        postData['acciones'] = $('#acciones').val(); // Agregado
        postData['voluntariado'] = $('#voluntariado').val(); // Agregado
        postData['arboles'] = $('#arboles').val(); // Agregado
        postData['horas'] = $('#horas').val(); // Agregado
        postData['areas'] = $('#areas').val(); // Agregado
        postData['conocimiento'] = $('#conocimiento').val(); // Agregado
        postData['apreder'] = $('#apreder').val(); // Agregado
        postData['informacion'] = $('#informacion').val(); // Agregado
        postData['objetivos'] = $('#objetivos').val(); // Agregado
        postData['cambios'] = $('#cambios').val(); // Agregado
        postData['mejorar'] = $('#mejorar').val(); // Agregado
        postData['comentarios'] = $('#comentarios').val(); // Agregado
        postData['id'] = $('#productId').val(); // Si estás editando un producto
    
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            console.log(response);
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            $('#name').val('');
            $('#description').val(JsonString);
            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            edit = false;
        });
    });
    

    $(document).on('click', '.product-delete', function(e) {
        if (confirm('¿Realmente deseas eliminar esta persona?')) {
            const element = $(this).closest('tr'); // Obtener la fila de la persona
            const id = $(element).attr('productId'); // Obtener el ID de la persona
    
            // Hacer la petición para eliminar el producto
            $.post('./backend/product-delete.php', { id }, function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    // Si la eliminación fue exitosa, eliminar la fila de la tabla
                    $(element).remove();
                } else {
                    alert('Error al eliminar: ' + data.message);
                }
            });
        }
    });
    
     
    

    $(document).on('click', '.product-item', function(e) {
    e.preventDefault();

    // Obtener el id del producto (persona)
    let productId = $(this).closest('tr').attr('productId');

    // Hacer una solicitud AJAX para obtener los datos de la persona
    $.get('./backend/product-edit.php?id=' + productId, function(response) {
        if (response.status !== 'error') {
            // Llenar el formulario con los datos obtenidos
            $('#name').val(response.nombre);
            $('#edad').val(response.edad);
            $('#profesion').val(response.profesion);
            $('#correo').val(response.correo);
            $('#frecuencia').val(response.frecuencia);
            $('#actividades').val(response.actividades);
            $('#importancia').val(response.importancia);
            $('#acciones').val(response.acciones);
            $('#voluntariado').val(response.voluntariado);
            $('#arboles').val(response.arboles);
            $('#horas').val(response.horas);
            $('#areas').val(response.areas);
            $('#conocimiento').val(response.conocimiento);
            $('#apreder').val(response.apreder);
            $('#informacion').val(response.informacion);
            $('#objetivos').val(response.objetivos);
            $('#cambios').val(response.cambios);
            $('#mejorar').val(response.mejorar);
            $('#comentarios').val(response.comentarios);

            // Establecer el id para edición
            $('#productId').val(response.id);
        } else {
            alert('Error al cargar los datos');
        }
    });
});

});