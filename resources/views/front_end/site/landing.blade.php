<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Area Check</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Optional Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('website_assets/images/landing.png'); /* Replace with your actual image URL */
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #111; /* White text color for contrast */
      font-family: 'Arial', sans-serif;
    }
    .container {
      background-color: rgb(255 255 255 / 92%); /* Semi-transparent black background for contrast */
      max-width: 400px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    .title {
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
    }
    .description {
      font-size: 16px;
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-check {
      width: 100%;
      padding: 10px;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent background for the input field */
      color: #111;
    }
    .form-text {
      color: #111;
    }
    #responseMessage {
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="title">Check Delivery Area</div>
    <div class="description">Enter your pincode to check if we deliver to your area.</div>
   <form id="pincodeForm">
      <div class="form-group">
        <label for="pincode">Pincode</label>
        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pincode"value="{{ session('pincode') }}"  required pattern="^\d{6}$" maxlength="6">
        <small id="pincodeHelp" class="form-text">Please enter a 6-digit pincode.</small>
      </div>
      <button type="submit" class="btn btn-primary btn-check">Check Delivery Area</button>
    </form>
    <!-- Optional Success/Error message (you can use JavaScript to show it) -->
    <div id="pincodeResponse" class="mt-3"></div>
  </div>

  <!-- jQuery (Make sure jQuery is loaded first before Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>
    $(document).ready(function() {
        // When the form is submitted
        $('#pincodeForm').on('submit', function(e) {
            e.preventDefault();  // Prevent form from submitting the traditional way
             var siteurl = "{{ url('/') }}";
            var pincode = $('#pincode').val(); // Get the value of the pincode field
			//alert(pincode);
            // AJAX request to check the pincode
            $.ajax({
                url: '{{ route("checkPincode") }}',  // The route we created in web.php
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // Include CSRF token for security
                    pincode: pincode  // Send the pincode as data
                },
                success: function(response) {
                    // Handle the response from the server
                    if (response.status === 'success') {
                        $('#pincodeResponse').html('<p style="color: success;">' + response.message + '</p>');
						window.location.href = siteurl;
                    } 
					else
					{
                        $('#pincodeResponse').html('<p style="color: red;">' + response.message + '</p>');
						window.location.href = siteurl;
					}
                },
                error: function(xhr, status, error) {
                    // If there is an error with the AJAX request
                    $('#pincodeResponse').html('<p style="color: red;">An error occurred. Please try again.</p>');
                }
            });
        });
    });
  </script>
</body>
</html>
