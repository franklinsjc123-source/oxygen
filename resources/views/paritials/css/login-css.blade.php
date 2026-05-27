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
        padding-top: 150px;
        padding-bottom: 30px;
    }
}
</style>