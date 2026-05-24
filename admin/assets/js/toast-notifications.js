// Toast Notification System

const ToastNotification = {
    defaultDuration: 3000,

    init: function() {
        // Create toast container if not exists
        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
    },

    show: function(message, type = 'info', duration = null) {
        this.init();

        const container = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();

        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <span class="toast-message">${this.escapeHtml(message)}</span>
                <button class="toast-close" onclick="ToastNotification.hide('${toastId}')">×</button>
            </div>
        `;

        container.appendChild(toast);

        // Trigger animation
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Auto hide
        const hideDelay = duration || this.defaultDuration;
        setTimeout(() => {
            this.hide(toastId);
        }, hideDelay);

        return toastId;
    },

    hide: function(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    },

    success: function(message, duration) {
        return this.show(message, 'success', duration);
    },

    error: function(message, duration) {
        return this.show(message, 'error', duration || 5000); // Longer for errors
    },

    info: function(message, duration) {
        return this.show(message, 'info', duration);
    },

    warning: function(message, duration) {
        return this.show(message, 'warning', duration || 4000);
    },

    escapeHtml: function(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    ToastNotification.init();
});
