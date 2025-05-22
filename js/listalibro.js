(function () {
    $(document).ready(function () {
        mostrarLibros();

        $('#formLibro').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: '../backend/LibroController.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json', 
                success: function (data) {
                    alert(data.message);
                    $('#formLibro')[0].reset();
                    $('#id').val('');
                    mostrarLibros();
                },
                error: function (xhr, status, error) {
                    console.error("Error en submit:", xhr.responseText);
                }
            });
        });

        $('#cancelBtn').click(function () {
            $('#formLibro')[0].reset();
            $('#id').val('');
        });

        // Editar libro: obtener datos y cargar en formulario
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $.ajax({
                url: '../backend/LibroController.php',
                type: 'POST',
                data: { accion: 'obtener', id: id },
                dataType: 'json',
                success: function (libro) {
                    $('#id').val(libro.id);
                    $('#title').val(libro.title);
                    $('#author').val(libro.author);
                    $('#year').val(libro.year);
                    // Nota: Si quieres mostrar la imagen actual, puedes hacerlo aquí
                },
                error: function (xhr) {
                    console.error("Error al obtener libro:", xhr.responseText);
                }
            });
        });

        // Eliminar libro
        $(document).on('click', '.btn-delete', function () {
            const id = $(this).data('id');
            if (confirm('¿Estás seguro de eliminar este libro?')) {
                $.ajax({
                    url: '../backend/LibroController.php',
                    type: 'POST',
                    data: { accion: 'eliminar', id: id },
                    dataType: 'json',
                    success: function (data) {
                        alert(data.message);
                        mostrarLibros();
                    },
                    error: function (xhr) {
                        console.error("Error al eliminar libro:", xhr.responseText);
                    }
                });
            }
        });
        $(document).on('click', '.btn-create', function () {
            window.location.href = 'formulario.php';
        });

        // Mostrar libros
        function mostrarLibros() {
            $.ajax({
                url: '../backend/LibroController.php',
                type: 'GET',
                dataType: 'json',
                success: function (libros) {
                    let filas = '';
                    libros.forEach(libro => {
                        filas += `
                            <tr>
                                <td>${libro.title}</td>
                                <td>${libro.author}</td>
                                <td>${libro.category}</td>
                                <td>${libro.year}</td>
                                 <td><img src="/LibraryManagement/assets/${libro.cover_url}" width="50" height="50" alt="Portada"></td>
                                   <td><button class="btn btn-warning btn-sm btn-edit" data-id="${libro.id}">✏️</button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="${libro.id}">🗑️</button>
                                </td>
                            </tr>`;
                    });
                    $('#tablaLibros').html(filas);
                },
                error: function (xhr) {
                    console.error("Error al mostrar libros:", xhr.responseText);
                }
            });
        }
    });
})();
