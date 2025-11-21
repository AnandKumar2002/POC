{{-- CDN's to be added -- DEVELOPMENT --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

{{-- FOR PRODUCTION --}}
{{-- Project must be using Jquery --}}
{{-- npm install sweetalert2
In app.js add
import Swal from 'sweetalert2'
window.Swal = Swal; --}}
{{-- npm install --save toastr
In app.js add
import toastr from "toastr";
import "toastr/build/toastr.min.css"; // Import CSS for styling
window.toastr = toastr; // Make it globally available --}}

{{-- Use this compoent in your layout file --}}

<script>
    // --- Set toastr options once ---
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // --- Global event listeners ---
    window.addEventListener('toast-success', e => toastr.success(e.detail.message));
    window.addEventListener('toast-error', e => toastr.error(e.detail.message));
    window.addEventListener('toast-warning', e => toastr.warning(e.detail.message));

    window.addEventListener('mega-success', e => Swal.fire({
        title: 'Success!',
        text: e.detail.message,
        icon: 'success',
        confirmButtonText: 'OK'
    }));
    window.addEventListener('mega-error', e => Swal.fire({
        title: 'Error!',
        text: e.detail.message,
        icon: 'error',
        confirmButtonText: 'OK'
    }));
    window.addEventListener('mega-warning', e => Swal.fire({
        title: 'Warning!',
        text: e.detail.message,
        icon: 'warning',
        confirmButtonText: 'OK'
    }));

    // --- Simple helper functions ---
    function notifyToast(type, message) {
        window.dispatchEvent(new CustomEvent(`toast-${type}`, {
            detail: {
                message
            }
        }));
    }

    function notifyAlert(type, message) {
        window.dispatchEvent(new CustomEvent(`mega-${type}`, {
            detail: {
                message
            }
        }));
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            notifyToast('success', '{{ session('success') }}');
        @endif
        @if (session('error'))
            notifyToast('error', '{{ session('error') }}');
        @endif
        @if (session('warning'))
            notifyToast('warning', '{{ session('warning') }}');
        @endif

        @if (session('mega-success'))
            notifyAlert('success', '{{ session('mega-success') }}');
        @endif
        @if (session('mega-error'))
            notifyAlert('error', '{{ session('mega-error') }}');
        @endif
        @if (session('mega-warning'))
            notifyAlert('warning', '{{ session('mega-warning') }}');
        @endif
    });
</script>
