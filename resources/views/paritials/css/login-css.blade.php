<style>
body {
    background-color: #f4f7f6;
}

/* Fix for mobile webview keyboard overlap issue where form gets pushed to the top and cut off */
.authentication-box {
    align-items: flex-start !important;
}

.authentication-box .container {
    margin-top: auto !important;
    margin-bottom: auto !important;
}

/* Apply specific padding only for mobile views */
@media (max-width: 767px) {
    .authentication-box .container {
        padding-top: 60px;
        padding-bottom: 30px;
    }
}

/* Custom Visible Tick Checkbox for Login Portals */
.form-check {
    display: flex !important;
    align-items: center !important;
    padding-left: 0 !important;
    margin-bottom: 0 !important;
}

.form-check-input#remember {
    cursor: pointer !important;
    width: 16px !important;
    height: 16px !important;
    min-width: 16px !important;
    margin: 0 8px 0 0 !important;
    float: none !important;
    border: 1.5px solid #b2bec3 !important;
    border-radius: 4px !important;
    background-color: #ffffff !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    outline: none !important;
    box-shadow: none !important;
    transition: all 0.2s ease-in-out !important;
    position: relative !important;
}

.form-check-input#remember:hover {
    border-color: #0984e3 !important;
}

.form-check-input#remember:checked {
    background-color: #0984e3 !important;
    border-color: #0984e3 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M4 10l4.5 4.5L16 5'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
    background-size: 11px 11px !important;
}

.staff-portal .form-check-input#remember:hover,
.staff-portal .form-check-input#remember:checked {
    border-color: #4834d4 !important;
    background-color: #4834d4 !important;
}

.vendor-portal .form-check-input#remember:hover,
.vendor-portal .form-check-input#remember:checked {
    border-color: #ff5e57 !important;
    background-color: #ff5e57 !important;
}

.form-check-label {
    cursor: pointer !important;
    user-select: none !important;
    margin-bottom: 0 !important;
    font-size: 1rem !important;
}
</style>