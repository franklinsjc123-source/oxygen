
       <?php 
       
        $categorymain = App\Models\Category\CategoryMain::where('status',1)->limit(7)->get();
        $category = App\Models\Category\Category::where('status',1)->get();
        $Categorysub = App\Models\Category\CategorySub::where('status',1)->get();
        ?>
<section class="mt-5" style="padding:15px;">
    <div  class="container-fuild" style="margin-top: 3rem !important; ">
        <div class="col-md-12 m-auto">
            <div class="row margin-default ratio_square">               
                
                    <!-- <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('allproductshow')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>ALL</h6>                                 
                            </div>
                        </a>
                    </div>
                    
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{ route('allvendors') }}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>VENDORS</h6>                                 
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('alloffers')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>DEALS</h6>                                 
                            </div>
                        </a>
                    </div> -->
                 
                           



                                <nav id="main-nav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                   
                                        <li class="mega" id="hover-cls">
                                        <a href="{{route('allproductshow')}}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>ALL</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>

                                        <li class="mega" id="hover-cls">
                                        <a href="{{ route('allvendors') }}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>VENDORS</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>

                                        <li class="mega" id="hover-cls">
                                        <a href="{{route('alloffers')}}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>DEALS</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>
                                        @foreach ($categorymain as $categoriesmain)
                                       @if(count($categoriesmain->submenu) > 0)
                                        <li class="mega" id="hover-cls">
                                            <a href="{{ url( 'MainCatergoryproductshow/'.$categoriesmain->id ) }}">
                                                 <div class="">           <!--col-xl-1 p-0 col-sm-1 col-3  -->
                                                        <div class="img-category">                                                   
                                                            <div class="img-sec" width="100px" heigth="100px">
                                                                <img  src=" {{ asset('assets/images/categoryMain') . '/' . $categoriesmain->category_main_image }} "class="img-fluid bg-img" alt="">
                                                            </div>                                                     
                                                            <h6>{{ $categoriesmain->category_main_name }}</h6>
                                                        </div>                                            
                                                </div>
                                            </a>
                                            <ul class="mega-menu full-mega-menu">
                                            @foreach($categoriesmain->submenu as $submenus)                                                
                                               @if(count($submenus->childmenu) > 0)
                                                <li>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <!--<h5>{{ $submenus->category_name }}</h5>-->
                                                                              <a href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                        @foreach($submenus->childmenu as $childmenus)
                                                                            <li><a href="{{ url( 'Subcategoryproductshow/'.$childmenus->id ) }}">{{ $childmenus->category_sub_name }}</a>
                                                                            </li>
                                                                        @endforeach 
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>                                                        
                                                    </div>
                                                </li>
                                                @else
                                               <li><a href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a></li>
                                                @endif
                                               @endforeach
                                            </ul>
                                        </li>  
                                        @else
                                      <li>
                                      <a href="index.html">
                                                <div class="">                                            
                                                        <div class="img-category">                                                   
                                                            <div class="img-sec">
                                                                <img  src="  "class="img-fluid bg-img" alt="">
                                                            </div>                                                     
                                                            <h6>{{ $categoriesmain->category_main_name }}</h6>
                                                        </div>                                            
                                                </div>
                                            </a>
                                      </li> 
                                        @endif
                                       @endforeach                                      
                                    </ul>
                                </nav>
            </div>
        </div>
    </div>
</section>