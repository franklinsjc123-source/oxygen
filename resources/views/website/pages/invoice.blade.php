@extends('website.layouts.master')

@section('content')

<body class="theme-color-1 bg-light">


  <!-- invoice 1 start -->
  <section class="theme-invoice-1 section-b-space">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 m-auto">
          <div class="invoice-wrapper">
            <div class="invoice-header">
              <div class="upper-icon">
                <img src="../assets/images/invoice/invoice.svg" class="img-fluid" alt="">
              </div>
              <div class="row header-content">
                <div class="col-md-6">
                    <img src="../assets/images/dashboard/logo/newlogo.png" class="img-fluid" alt="">
                    <div class="mt-md-4 mt-3">
                    <h4 class="mb-2">
                     Oxygen Ecommerce, <br>Chennai ,
					 India - 620025
                    </h4>
                    <h4 class="mb-0">support@oxygen.com</h4>
                  </div>
                </div>
                <div class="col-md-6 text-md-end mt-md-0 mt-4">
                  <h2>invoice</h2>
                  <div class="mt-md-4 mt-3">
                    <h4 class="mb-2">
                      264  North Street, Trichy <br>Tamilnadu-620012 
                    </h4>
                    
                  </div>
                </div>
              </div>
              <div class="detail-bottom">
                <ul>
                  <li><span> date :</span><h4> 20 march, 2022</h4></li>
                  <li><span>invoice no :</span><h4> 8425</h4></li>
                  <li><span>email :</span><h4> user@gmail.com</h4></li>
                </ul>
              </div>
            </div>
            <div class="invoice-body table-responsive-md">
              <table class="table table-borderless mb-0">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Short Top</td>
                    <td>Rs 500</td>
                    <td>5</td>
                    <td>Rs. 2500</td>
                  </tr>
                   <tr>
                    <th scope="row">2</th>
                    <td>Long Top</td>
                    <td>Rs 700</td>
                    <td>2</td>
                    <td>Rs. 1400</td>
                  </tr>
				   <tr>
                    <th scope="row">3</th>
                    <td>Short Top</td>
                    <td>Rs 500</td>
                    <td>5</td>
                    <td>Rs. 2500</td>
                  </tr>
				   <tr>
                    <th scope="row">4</th>
                    <td>Short Top</td>
                    <td>Rs 500</td>
                    <td>5</td>
                    <td>Rs. 2500</td>
                  </tr>
                 
                 
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td class="font-bold text-dark" colspan="2">GRAND TOTAL</td>
                    <td class="font-bold text-theme">Rs 8900.00</td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="invoice-footer text-end">
              <div class="authorise-sign">
                <img src="../assets/images/invoice/sign.png" class="img-fluid" alt="sing">
                <span class="line"></span>
                <h6>Authorised Sign</h6>
              </div>
              <div class="buttons">
                <a href="#" class="btn black-btn btn-solid rounded-2 me-2" onclick="window.print();">export as PDF</a>
                <a href="#" class="btn btn-solid rounded-2" onclick="window.print();">print</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- invoice 1 end -->


  <!-- latest jquery-->
  <script src="../assets/js/jquery-3.3.1.min.js"></script>

  <!-- Bootstrap js-->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
@endsection