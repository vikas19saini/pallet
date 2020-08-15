<header>
    <div class="container">
        <div class="row">
            <div class="header_main">
                <span class="menu_icon"><i class="mobile_menu"></i></span>
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ url('img/logo.png') }}" class="img-responsive logo1" /><img src="{{ url('img/logo2.png') }}" class="img-responsive logo2" /></a>
                </div>
                <div class="navigation">
                    <ul>
                        <li class="mobile-mc"><a href="{{ url('my-account') }}">My Account</a></li>
                        <?php $count = 0 ?>
                        @foreach(DB::table('product_categories')->where(['status' => 'ACTIVE'])->limit(7)->get() as $item)
                        @if($count < 3) <li><a href="{{ url($item->slug . '/c') }}"> {{ $item->name  }} </a></li>
                            <?php $count++ ?>
                            @endif
                            @endforeach
                            <li><a href="{{ url('contact') }}"> Enquire </a></li>
                    </ul>
                </div>
                <div class="profile_icon">
                    <ul>
                        <li><a href="{{ url('my-account') }}"><i class="fa fa-heart"></i></a></li>
                        <li><a href="{{ url('cart') }}"><i class="fa fa-cart-plus"></i></a></li>
                        <li><a href="{{ url('my-account') }}"><i class="fa fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>