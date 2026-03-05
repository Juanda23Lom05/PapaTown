document.addEventListener("DOMContentLoaded", function () {
    
    // ==========================================
    // 1. PROTECCIÓN ANTI-DOBLE CLIC (SPINNERS)
    // ==========================================
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const boton = this.querySelector('button[type="submit"]');
            if(boton) {
                // Deshabilitamos el botón para que no le den 20 veces
                boton.disabled = true;
                // Le ponemos el spinner de Bootstrap
                boton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';
            }
        });
    });

    // ==========================================
    // 2. NOTIFICACIONES FLOTANTES (SWEETALERT2)
    // ==========================================
    const backendData = document.getElementById('notificaciones-backend');
    if (!backendData) return;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#1e1e1e', // Fondo oscuro elegante
        color: '#ffffff', // Texto blanco
        iconColor: '#28a745', // Ícono verde de éxito

        customClass: {
            popup: 'rounded-4 shadow-sm'
        },

        // Las animaciones siguen funcionando igual
        showClass: {
            popup: 'animate__animated animate__slideInRight animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutRight animate__faster'
        },

        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    const successMsg = backendData.getAttribute('data-success');
    const errorMsg = backendData.getAttribute('data-error');
    const validationMsg = backendData.getAttribute('data-errores-validacion');

    if (successMsg) {
        Toast.fire({
            icon: 'success',
            title: successMsg
        });
    }

    if (errorMsg) {
        Toast.fire({
            icon: 'error',
            title: errorMsg
        });
    }

    if (validationMsg) {
        Toast.fire({
            icon: 'error',
            title: validationMsg
        });
    }
});