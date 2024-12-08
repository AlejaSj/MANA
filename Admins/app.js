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

    function listarProductos() {
        $.get('./backend/product-list.php', function(response) {
            const products = JSON.parse(response);
            const tableBody = $('#products');
            tableBody.empty(); 

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
        let search = $('#search').val().toLowerCase(); 
        if(search) {
            $('#products tr').each(function() {
                let row = $(this);
                let match = false;
    
                row.find('td').each(function() {
                    if ($(this).text().toLowerCase().includes(search)) {
                        match = true;
                    }
                });
    
                if (match) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        } else {
            $('#products tr').show();
        }
    });
    
    

    $('#product-form').submit(e => {
        e.preventDefault();
    
        let postData = JSON.parse($('#description').val());
    
        postData['nombre'] = $('#name').val();
        postData['edad'] = $('#edad').val(); 
        postData['profesion'] = $('#profesion').val(); 
        postData['correo'] = $('#correo').val(); 
        postData['frecuencia'] = $('#frecuencia').val(); 
        postData['actividades'] = $('#actividades').val(); 
        postData['importancia'] = $('#importancia').val(); 
        postData['acciones'] = $('#acciones').val(); 
        postData['voluntariado'] = $('#voluntariado').val(); 
        postData['arboles'] = $('#arboles').val(); 
        postData['horas'] = $('#horas').val(); 
        postData['areas'] = $('#areas').val(); 
        postData['conocimiento'] = $('#conocimiento').val(); 
        postData['apreder'] = $('#apreder').val(); 
        postData['informacion'] = $('#informacion').val(); 
        postData['objetivos'] = $('#objetivos').val(); 
        postData['cambios'] = $('#cambios').val(); 
        postData['mejorar'] = $('#mejorar').val(); 
        postData['comentarios'] = $('#comentarios').val(); 
        postData['id'] = $('#productId').val(); 
    
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
            const element = $(this).closest('tr'); 
            const id = $(element).attr('productId'); 

            $.post('./backend/product-delete.php', { id }, function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    $(element).remove();
                } else {
                    alert('Error al eliminar: ' + data.message);
                }
            });
        }
    });
    
     
    

    $(document).on('click', '.product-item', function(e) {
    e.preventDefault();

    let productId = $(this).closest('tr').attr('productId');

    $.get('./backend/product-edit.php?id=' + productId, function(response) {
        if (response.status !== 'error') {
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

            $('#productId').val(response.id);
        } else {
            alert('Error al cargar los datos');
        }
    });
});

});