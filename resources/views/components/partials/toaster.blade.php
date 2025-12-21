{{-- ======================================================
|  Notifications Component (Livewire v3 Safe)
|  Toastr + SweetAlert2
|  Include ONCE in main layout
====================================================== --}}

{{-- ===============================
|  GLOBAL INITIALIZATION (ONCE)
================================ --}}
<script>
(function () {
    // Prevent re-initialization on Livewire navigate
    if (window.__notificationsInitialized) return;
    window.__notificationsInitialized = true;

    // ----------------------------
    // Toastr global configuration
    // ----------------------------
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: false,
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };

    // ----------------------------
    // Global maps
    // ----------------------------
    window.toastMap = {
        success: toastr.success,
        error: toastr.error,
        warning: toastr.warning,
    };

    window.alertMap = {
        success: 'success',
        error: 'error',
        warning: 'warning',
    };

    // ----------------------------
    // Global event listeners
    // ----------------------------
    Object.keys(window.toastMap).forEach(type => {
        window.addEventListener(`toast-${type}`, e => {
            window.toastMap[type](e.detail.message);
        });
    });

    Object.keys(window.alertMap).forEach(type => {
        window.addEventListener(`mega-${type}`, e => {
            Swal.fire({
                title: type.charAt(0).toUpperCase() + type.slice(1) + '!',
                text: e.detail.message,
                icon: window.alertMap[type],
                confirmButtonText: 'OK'
            });
        });
    });

    // ----------------------------
    // Global helper functions
    // ----------------------------
    window.notifyToast = (type, message) =>
        window.dispatchEvent(
            new CustomEvent(`toast-${type}`, { detail: { message } })
        );

    window.notifyAlert = (type, message) =>
        window.dispatchEvent(
            new CustomEvent(`mega-${type}`, { detail: { message } })
        );
})();
</script>

{{-- =======================================
|  SESSION-BASED NOTIFICATIONS (EVERY NAV)
======================================= --}}
<script>
document.addEventListener('livewire:navigated', () => {

    const sessionToasts = {
        success: @json(session('success')),
        error: @json(session('error')),
        warning: @json(session('warning')),
    };

    const sessionAlerts = {
        success: @json(session('mega-success')),
        error: @json(session('mega-error')),
        warning: @json(session('mega-warning')),
    };

    Object.entries(sessionToasts).forEach(([type, message]) => {
        if (message) window.notifyToast(type, message);
    });

    Object.entries(sessionAlerts).forEach(([type, message]) => {
        if (message) window.notifyAlert(type, message);
    });

});
</script>
