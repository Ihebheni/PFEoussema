<!-- SweetAlert CSS -->
<link rel="stylesheet" href="{{ mix('css/sweetalert2.min.css') }}">

<!-- SweetAlert JS -->
<script src="{{ mix('js/sweetalert2.all.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: '{{ $type }}',
        title: '{{ $title }}',
        text: '{{ $text }}',
        footer: `{!! $footer !!}`
    });
});
</script>
