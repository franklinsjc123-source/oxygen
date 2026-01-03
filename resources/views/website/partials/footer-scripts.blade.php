<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script>
// Note: This is only hard coded for example purposes, it should probably come from user input


function myFunction() {

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (username == 'admin' || password == 'admin123') {
        window.location = "dashboard.php";
    } else {

        alert("username & password wrong");
    }
}
</script>
<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/slick.js"></script>

<!-- Jsgrid js-->
<script src="../assets/js/jsgrid/jsgrid.min.js"></script>
<script src="../assets/js/jsgrid/griddata-invoice.js"></script>
<script src="../assets/js/jsgrid/jsgrid-invoice.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>
<script>
$('.single-item').slick({
    arrows: false,
    dots: true
});
</script>
