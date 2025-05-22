(function () {
    $(document).ready(function () {
        mostrarUsuarios();

        $('#formUsuario').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: '../backend/UserController.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                    $('#formUsuario')[0].reset();
                    $('#id').val('');
                    mostrarUsuarios();
                },
                error: function (xhr) {
                    console.error("Error en submit:", xhr.responseText);
                }
            });
        });

        $('#cancelBtn').click(function () {
            $('#formUsuario')[0].reset();
            $('#id').val('');
        });

        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $.ajax({
                url: '../backend/UserController.php',
                type: 'POST',
                data: { accion: 'obtener', id: id },
                dataType: 'json',
                success: function (usuario) {
                    $('#id').val(usuario.id);
                    $('#full_name').val(usuario.full_name);
                    $('#last_name').val(usuario.last_name);
                    $('#email').val(usuario.email);
                    $('#fk_role_id').val(usuario.fk_role_id);
                    $('#fk_company_id').val(usuario.fk_company_id);
                    $('#fk_departamento_id').val(usuario.fk_departamento_id);
                },
                error: function (xhr) {
                    console.error("Error al obtener usuario:", xhr.responseText);
                }
            });
        });

        $(document).on('click', '.btn-delete', function () {
            const id = $(this).data('id');
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                $.ajax({
                    url: '../backend/UserController.php',
                    type: 'POST',
                    data: { accion: 'eliminar', id: id },
                    dataType: 'json',
                    success: function (data) {
                        alert(data.message);
                        mostrarUsuarios();
                    },
                    error: function (xhr) {
                        console.error("Error al eliminar usuario:", xhr.responseText);
                    }
                });
            }
        });
        function mostrarUsuarios() {
            $.ajax({
                url: '../backend/UserController.php',
                type: 'GET',
                dataType: 'json',
                success: function (usuarios) {
                    let filas = '';
                    usuarios.forEach(usuario => {
                        filas += `
                            <tr>
                                <td>${usuario.full_name} ${usuario.last_name}</td>
                                <td>${usuario.email}</td>
                                <td>${usuario.role_name}</td>  <!-- Mostrar el nombre del rol -->
                                <td><span class="badge bg-success">${usuario.status}</span></td>
                                <td><span class="badge bg-secondary">${usuario.statusChat}</span></td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-edit" data-id="${usuario.id}">✏️</button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="${usuario.id}">🗑️</button>
                                </td>
                            </tr>`;
                    });
                    $('#tablaUsuarios').html(filas);
                },
                error: function (xhr) {
                    console.error("Error al mostrar usuarios:", xhr.responseText);
                }
        
            });
        }
    });
})();
