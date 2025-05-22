document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registerForm');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Limpiar mensaje anterior
        messageDiv.textContent = '';
        messageDiv.style.color = 'red';

        const name = form.name.value.trim();
        const lastname = form.lastname.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value;
        const confirmPassword = form.confirm_password.value;

        // Validaciones en frontend
        if (!name || !lastname || !email || !password || !confirmPassword) {
            messageDiv.textContent = 'Todos los campos son obligatorios.';
            return;
        }

        if (!validateEmail(email)) {
            messageDiv.textContent = 'Correo electrónico no válido.';
            return;
        }

        if (password !== confirmPassword) {
            messageDiv.textContent = 'Las contraseñas no coinciden.';
            return;
        }

        const formData = new FormData();
        formData.append('name', name);
        formData.append('lastname', lastname);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('confirm_password', confirmPassword);

        fetch('./backend/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                messageDiv.style.color = 'green';
                messageDiv.textContent = data.message;
                form.reset();
                // Opcional: redirigir tras un tiempo
                // setTimeout(() => window.location.href = 'index.html', 2000);
            } else {
                messageDiv.style.color = 'red';
                messageDiv.textContent = data.message;
            }
        })
        .catch(error => {
            messageDiv.style.color = 'red';
            messageDiv.textContent = 'Error en la comunicación con el servidor.';
            console.error('Error:', error);
        });
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
