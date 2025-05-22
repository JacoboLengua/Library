window.addEventListener("DOMContentLoaded", function () {
    const tabla = document.querySelector("#tabla-mensajes tbody");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "mensajes.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);

            if (data.success) {
                data.mensajes.forEach(m => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${m.fecha}</td>
                        <td>${m.nombre}</td>
                        <td>${m.email}</td>
                        <td>${m.mensaje}</td>
                    `;

                    tabla.appendChild(fila);
                });
            } else {
                tabla.innerHTML = `<tr><td colspan="4">${data.message}</td></tr>`;
            }
        }
    };

    xhr.send();
});
