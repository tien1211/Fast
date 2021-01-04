<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+84 354546137</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">hatien.1211@gmail.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">TIỂU LUẬN TỐT NGHIỆP &amp; HỒNG ANH TIẾN B1607034</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="{{route('index')}}">FF</a>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="{{route('index')}}" class="nav-link">Trang chủ</a></li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
              @foreach ($category as $cate)
          <a class="dropdown-item" href="{{route('categoryPages',['id'=>$cate->id_cate])}}">{{$cate->name_cate}} </a>
              @endforeach
            
          </div>
        </li>
          {{-- <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> --}}
          <li class="nav-item"><a href="{{route('wishlistPage')}}" class="nav-link" >Wishlist  [<span id="wishlist">{{ Cart::instance('wishlist')->count() }}</span>]</a></li>
          @if (!isset($auth))
          <li class="nav-item"><a href="{{route('signInPages')}}" class="nav-link">Sign In</a></li>
          @elseif($auth->per_emp == 0)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$auth->name_emp}}</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="{{route('getProfile',['id'=>$auth->id_emp])}}">Profile</a>
                <a class="dropdown-item" href="{{route('changePass')}}">Change Password</a>
              <a class="dropdown-item" href="{{route('adminIndex')}}">Back Admin</a>
              <a class="dropdown-item" href="{{route('signOut')}}">Sign out</a>
              </div>
            </li>

          @else
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$auth->name_emp}}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="{{route('getProfile',['id'=>$auth->id_emp])}}">Profile</a>
              <a class="dropdown-item" href="{{route('changePass')}}">Change Password</a>
            <a class="dropdown-item" href="{{route('signOut')}}">Sign out</a>
            </div>
          </li>
          @endif
          <li class="nav-item cta cta-colored"><a href="{{route('cartPage')}}" class="nav-link"><span class="icon-shopping_cart" > [<span id="cart">{{ Cart::instance('cart')->count() }}</span>]  </span></a></li>
        </ul>

      </div>

    </div>
  </nav>
<!-- END nav -->