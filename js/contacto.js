document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-contacto');
    const respuesta = document.getElementById('respuesta');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const datos = new FormData(form);

        fetch('../backend/contacto.php', {
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                respuesta.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                form.reset();
            } else {
                respuesta.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            respuesta.innerHTML = `<div class="alert alert-danger">Ocurrió un error al enviar el mensaje.</div>`;
        });
    });
});
