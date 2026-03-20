let toastInstance = null;

export function getToast() {
    // Return stored instance if available
    if (toastInstance) {
        return toastInstance;
    }
    
    // Try to get from window app if available
    if (window.__VUE_APP__?.config?.globalProperties?.$toast) {
        toastInstance = window.__VUE_APP__.config.globalProperties.$toast;
        return toastInstance;
    }
    
    // Try to get from mounted app element
    const appElement = document.getElementById('app');
    if (appElement && appElement.__vue_app__) {
        const toast = appElement.__vue_app__.config.globalProperties.$toast;
        if (toast) {
            toastInstance = toast;
            return toastInstance;
        }
    }
    
    return null;
}

export function setToast(toast) {
    toastInstance = toast;
}

export function showSuccess(message, options = {}) {
    const toast = getToast();
    if (toast) {
        toast.success(message, options);
    } else {
        alert(message);
    }
}

export function showError(message, options = {}) {
    const toast = getToast();
    if (toast) {
        toast.error(message, options);
    } else {
        alert(message);
    }
}

