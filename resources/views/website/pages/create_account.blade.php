    @extends('website.layouts.master')

    @section('content')
<body style="background-color: rgb(102, 205, 255);">

<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="authentication-box">
        <div class="container">
            <div class="row">
                 
                <div class="col-md-6 m-auto p-0 card-right">
                    <div class="card tab2-card">
                        <div class="card-body">
                            <div class="logo-wrapper text-center"><a href="index.html"><img class="blur-up lazyloaded" src="../assets/images/dashboard/logo/newlogo.png" alt=""></a></div>
           <br>
    <form action="" method="post">
        @csrf
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
	  <div class="form-group">
        <label for="username">Mobile Number</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
	  <div class="form-group">
        <label for="username">Email</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
	    <div class="form-group">
        <label for="username">Address</label>
       <textarea class="form-control" id="username" name="username" rows="2"required></textarea>
      </div>
	  
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="password" required>
      </div>
	   <div class="form-group">
        <label for="pwd">Confirm Password:</label>
        <input type="password" class="form-control" id="pwd" name="password" required>
      </div>

      <div class="form-terms">
                                           
                                        </div>
                                        <div class="form-button">
                                        <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
                                         <a href="index.php" class="btn btn-default forgot-pass" style="margin-left:100px;">Login</a>
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

    var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;
    if (username=='admin' || password == 'admin123') {
      window.location = "dashboard.php";
    }
    else{

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
        }
    );
</script>



