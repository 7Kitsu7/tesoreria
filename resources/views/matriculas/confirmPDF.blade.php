<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Confirmación',
            text: '{{ $message }}',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a la URL de generación de PDF en una nueva pestaña
                window.open('{{ $pdfUrl }}', '_blank');
                // Redirigir a la vista index en la pestaña actual
                window.location = '{{ $indexUrl }}';
            } else {
                // Redirigir a la vista index en la pestaña actual
                window.location = '{{ $indexUrl }}';
            }
        });
    });
</script>
