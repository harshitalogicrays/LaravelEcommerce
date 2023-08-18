 <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   myShop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/collections')}}">All Categories</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="">Products</a>
                        </li> 
                    </ul>
                    
                    <form class="d-flex" style="marign-left:400px" action="{{url('search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="search product here" value="{{Request::get('search')}}">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('cart')}}"><i class="bi bi-cart"></i>Cart 
                            <span class="badge rounded-pill text-bg-danger" style="position: relative;top:-10px;left:-5px">
                                <livewire:frontend.cart.cart-count/>
                            </span>
                            </a>
                        </li> 

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Welcome {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="{{url('profile')}}"><i class="bi bi-person-circle"></i>My Profile</a>
                                    <hr class="dropdown-divider"/>
                                    <a class="dropdown-item" href="{{url('orders')}}"><i class="bi bi-list"></i>My Orders</a>
                                    <hr class="dropdown-divider"/>
                                    <a class="dropdown-item" href="{{url('cart')}}"><i class="bi bi-cart"></i>My Cart</a>
                                    <hr class="dropdown-divider"/>
                                    <a class="dropdown-item" href=""><i class="bi bi-heart-fill"></i>My Wishlist</a>
                                    <hr class="dropdown-divider"/>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>