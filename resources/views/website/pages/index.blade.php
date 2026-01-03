@extends('website.layouts.master')

@section('title')
    Home | MyWebsite
@endsection

@section('content')
<body style="background-color: rgb(102, 205, 255);">

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row">

                    <div class="col-md-5 m-auto p-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo-wrapper text-center"><a href="index.html"><img
                                            class="blur-up lazyloaded" src="../assets/images/dashboard/logo/newlogo.png"
                                            alt=""></a></div>
                                <br>
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="password" class="form-control" id="pwd" name="password" required>
                                    </div>

                                    <div class="form-terms">
                                        <div class="form-check mesm-2">
                                            <input type="checkbox" class="form-check-input"
                                                id="customControlAutosizing">
                                            <label class="form-check-label ps-2" for="customControlAutosizing">Remember
                                                me</label>
                                            <a href="#" class="btn btn-default forgot-pass">lost your password</a>
                                        </div>
                                    </div>
                                    <div class="form-button text-center">
                                        <button type="submit" name="submit" class="btn btn-warning">Cancel</button>
                                        <button type="submit"  name="submit" class="btn btn-secondary">Login</button>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
 <!-- latest jquery-->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script>
    // Note: This is only hard coded for example purposes, it should probably come from user input


    function myFunction() {
    // alert('test');
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


</body>
@endsection
