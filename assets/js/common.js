function showNotice(type, message) {
    var alertifyFunctions = {
        'success': alertify.success,
        'error': alertify.error,
        'info': alertify.message,
        'warning': alertify.warning
    };
    alertifyFunctions[type](message, 10);
}

// Alertify
window.addEventListener('load', function () {
    alertify.set('notifier','position', 'top-right');
});