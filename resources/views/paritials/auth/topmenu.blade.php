<div class="page-wrapper" id="top-menu">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row p-0">
            <div class="main-header-left d-lg-none w-auto">
                <div class="logo-wrapper"><a href="{{ url('admin/dashboard') }}"><img class="blur-up lazyloaded"
                            src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt=""></a></div>
            </div>
            <div class="mobile-sidebar w-auto">
                <div class="media-body text-end switch-sm">
                    <a href="javascript:void(0)" class="sidebar-toggle-btn" id="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events:none;"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                    </a>
                </div>
            </div>
            
            
             @php
                $user_info="App\Models\User"::where('id',session('userId'))->first();
                
            //    dd($user_info);
                
                $userId = session('userId');
                
                
                $adminorders_pro = DB::table('ordersproducts')
                ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                ->join('products','products.id','=','products_details.products_id')
                ->where('products.created_by', 1)
                ->where('products.logintype', 'Admin')
                 ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                ->count();
                //  dd($adminorders_pro);
              
               //dd($user_info->login_id);
                 $vendarorders_pro = DB::table('ordersproducts')
                ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                ->join('products', 'products_details.products_id', '=', 'products.product_id')
                ->where('products.login_id', $user_info->login_id)
                ->where('products.logintype', 'Vendor')
                //->where('ordersproducts.order_status', 'New')
                ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                ->count();
               // dd($vendarorders_pro);

               
                $adminorders_pro1 = DB::table('ordersproducts')
                ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                ->join('products','products.id','=','products_details.products_id')
                ->where('products.created_by', 1)
                ->where('products.logintype', 'Admin')
                ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                ->first();
              //dd($adminorders_pro1);
            
               
                
                $vendarorders_pro1 = DB::table('ordersproducts')
                ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                ->join('products','products.id','=','products_details.products_id')
                ->where('products.logintype', 'Vendor')
                
             
                ->get();


            //    dd($vendarorders_pro1);
                  $orderspro = DB::table('notifications')->get();
                  
                  $venorderspro = DB::table('notifications')->where('login_id', '<>', 1)->get();
                  



                
            @endphp
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li class="onhover-dropdown"><i data-feather="bell"></i><span
                            class="badge badge-pill badge-primary pull-right notification-badge">{{($adminorders_pro)? $adminorders_pro : $vendarorders_pro}}</span><span
                            class="dot"></span>
                        <ul class="notification-dropdown onhover-show-div p-0">
                            
                         
                            
                            @if(!empty($adminorders_pro1) || empty($adminorders_pro1) )
                                        
                           
                                      
                            
                                        @if(isset($adminorders_pro1) && $adminorders_pro1->created_by == 1)
                                           @foreach ($orderspro as $item)
                                                        @php           
                                                            $ptime1 = $item->created_at;
                                                            $ptime = strtotime($ptime1);
                                                            // echo time_elapsed_string($ptime);
                                                        @endphp
                                                @if ($item->details == "New")
                                                    <li>New Order {{$item->orders_id}} Placed by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                @elseif($item->details == "Accept")
                                                    @php
                                                        $acc_count = DB::table('notifications')->where('details','Accept')->count();
                                                        $acc_count1 = DB::table('notifications')->where('details','Accept')->get();
                                                    @endphp
                                                    <li>Orders {{$acc_count1->orders_id}}have been Accepted by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                                @elseif($item->details == "Dispatch")
                                                    @php
                                                        $acc_count = DB::table('notifications')->where('details','Dispatch')->count();
                                                      //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                    @endphp
                                                    <li>Orders have been Dispatched by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                    @elseif($item->details == "Delivered")
                                                    @php
                                                        $acc_count = DB::table('notifications')->where('details','Delivered')->count();
                                                      //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                    @endphp
                                                    <li>Orders have been Delivered by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
    
                                                
                                                    @elseif($item->details == "Cancel")
                                                    <li>New Order {{$item->orders_id}}has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
    
                                                    @elseif($item->details == "Return")
                                                    <li>New Order {{$item->orders_id}} has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
    
                                                @endif
    
                                            @endforeach     
                                            
                                            
                                         @elseif($vendarorders_pro1)
                                         {{-- [0]->logintype =='Vendor' --}}
                                            @foreach($venorderspro as $item)
                                               
                                                @php           
                                                    $ptime1 = $item->created_at;
                                                    $ptime = strtotime($ptime1);
                                                    // echo time_elapsed_string($ptime);
                                                    $userId = session('userId');
                                                      
                                                @endphp
                                             
                                                
                                                @if ($item->details == "New")
                                                  
                                                <li>New Order {{$item->orders_id}} Placed by Vendar<span class="badge badge-pill badge-primary pull-right"> <a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                @elseif($item->details == "Accept")
                                              
                                                 @php
                                                   $acc_count = DB::table('notifications')->where('details','Accept')->count();
                                                   $acc_count1 = DB::table('notifications')->where('details','Accept')->get();
                                                 
                                                   
                                                 @endphp
                                                
                                                <li>Orders  
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id.' has been Accepted by Vendor' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                        <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                                @elseif($item->details == "Dispatch")
                                                 @php
                                                   $acc_count = DB::table('notifications')->where('details','Dispatch')->count();
                                                   $acc_count1 = DB::table('notifications')->where('details','Dispatch')->get();
                                                   
                                                 @endphp
                                                <li>Orders
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id.'has been Dispatched by Vendor' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                
                                                
                                               <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                                @elseif($item->details == "Cancel")
                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                
                                                 @endif

                                            @if ($item->details == "New")
                                                <li>New Order Placed by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                            @elseif($item->details == "Accept" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Accept')->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Accept')->get();
                                                @endphp
                                                <li>Orders {{ $acc_count1->orders_id }} have been Accepted by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                            @elseif($item->details == "Dispatch" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Dispatch')->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Dispatch')->get();
                                                    
                                                  //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders {{$acc_count1->orders_id }} have been Dispatched by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>



                                                @elseif($item->details == "Delivered" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Delivered')->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Delivered')->get();
                                                    
                                                  //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders
                                                
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id. 'have been Delivered by Vendar' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            
                                                @elseif($item->details == "Cancel")
                                                
                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                                @elseif($item->details == "Return")
                                                <li>New Order has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @endif

                                        @endforeach  
                                        
                                        
                                        @else
                                    
                                            <li>Notification Vendar  product<span class="badge badge-pill badge-primary pull-right">{{ $vendarorders_pro}}</span></li>     
                                        
                                        @endif
                                
                                   
                                @elseif($vendarorders_pro1[0]->logintype =='Vendor')
                                
                                    @foreach($venorderspro as $item)
                                                
                                                @php           
                                                    $ptime1 = $item->created_at;
                                                    $ptime = strtotime($ptime1);
                                                    // echo time_elapsed_string($ptime);
                                                    $userId = session('userId');
                                                      
                                                @endphp
                                                
                                                
                                                @if ($item->details == "New")
                                               
                                                <li>New Order {{$item->orders_id}} Placed by Vendar<span class="badge badge-pill badge-primary pull-right"> <a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                @elseif($item->details == "Accept")
                                                 @php
                                                   $acc_count = DB::table('notifications')->where('details','Accept')->where('login_id',$userId)->count();
                                                   $acc_count1 = DB::table('notifications')->where('details','Accept')->where('login_id',$userId)->get();
                                                   //dd($acc_count1[0]->orders_id);
                                                   
                                                 @endphp
                                                
                                                <li>Orders  
                                                
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id.' has been Accepted by Vendor' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                        <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                                @elseif($item->details == "Dispatch")
                                                 @php
                                                   $acc_count = DB::table('notifications')->where('details','Dispatch')->where('login_id',$userId)->count();
                                                   $acc_count1 = DB::table('notifications')->where('details','Dispatch')->where('login_id',$userId)->get();
                                                   
                                                 @endphp
                                                <li>Orders
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id.'has been Dispatched by Vendor' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                
                                                
                                               <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                                @elseif($item->details == "Cancel")
                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                
                                                 @endif

                                            @if ($item->details == "New")
                                                <li>New Order Placed by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                            @elseif($item->details == "Accept" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Accept')->where('login_id',$userId)->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Accept')->where('login_id',$userId)->get();
                                                @endphp
                                                <li>Orders {{ $acc_count1->orders_id }} have been Accepted by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                            @elseif($item->details == "Dispatch" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Dispatch')->where('login_id',$userId)->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Dispatch')->where('login_id',$userId)->get();
                                                    
                                                  //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders {{$acc_count1->orders_id }} have been Dispatched by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>



                                                @elseif($item->details == "Delivered" && $item->login_id  == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details','Delivered')->where('login_id',$userId)->count();
                                                    $acc_count1 = DB::table('notifications')->where('details','Delivered')->where('login_id',$userId)->get();
                                                    
                                                  //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders
                                                
                                                {{ isset($acc_count1[0]->orders_id) ? 
                                                            ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id. 'have been Delivered by Vendar' : 'Not Accepted') 
                                                            : 'NA' 
                                                            }}
                                                <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            
                                                @elseif($item->details == "Cancel")
                                                
                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                                @elseif($item->details == "Return")
                                                <li>New Order has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @endif

                                        @endforeach
                                       
                                
                             @else
                            
                             <li>Notification Vendar  product<span class="badge badge-pill badge-primary pull-right">{{ $vendarorders_pro}}</span></li>     
                                
                            @endif
                            
                           
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h6 class="mt-0"><span><i class="shopping-color"
                                                    data-feather="shopping-bag"></i></span>Login by {{$user_info->name }} </h6>
                                                   
                                        <p class="mb-0">Short top</p>
                                    </div>
                                </div>
                            </li>


                            <li class="txt-dark"><a href="{{ route('order') }}">All notification</a> </li>
                        </ul>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img
                                class="align-self-center pull-right img-30 rounded-circle blur-up lazyloaded"
                                src="{{ asset('assets/images/dashboard/logo/4.png') }}" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span
                                    class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            {{-- <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="mail"></i>Inbox</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="settings"></i>Settings</a></li> --}}
                            <li><a href="{{ url('admin/logout') }}"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
