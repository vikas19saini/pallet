<?php $categories = DB::table('product_categories')->where(['status' => 'ACTIVE'])->get(); ?>
<header>
    <div class="container">
        <div class="row">
            <div class="header_main">
                <div class="mob_view menu_width">
                    <div class="" id="menu-button">
                        <div class="toggle-wrap">
                            <span class="toggle-bar"></span>
                        </div>
                    </div>
                    <nav id="hide-menu" class="hide-menu navigation">
                        <ul>
                            <li class="mobile-mc"><a href="{{ url('my-account') }}">My Account</a></li>
                            <li>
                                <div class="accordion acco_b_remove acco_head">
                                    <h4 class="accordion-toggle">Scarves</h4>
                                    <div class="accordion-content footer_menu1">
                                        @foreach($categories as $item)
                                        <p><a href="{{ url($item->slug . '/c') }}"> {{ $item->name  }} </a></p>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <li><a href="{{ url('livebrowsing') }}">Live Browsing</a></li>
                            <li><a href="{{ url('contact') }}"> Enquire </a></li>
                            <li>
                                <a href="javascript:$('#logout').submit()"> Logout </a>
                                <form method="post" id="logout" action="{{ url('logout') }}" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ url('img/logo.png') }}" class="img-responsive logo1" /><img src="{{ url('img/logo2.png') }}" class="img-responsive logo2" /></a>
                </div>
                <div class="navigation">
                    <ul>
                        <li class="mobile-mc"><a href="{{ url('my-account') }}">My Account</a></li>
                        @foreach($categories as $item)
                        <li><a href="{{ url($item->slug . '/c') }}"> {{ $item->name  }} </a></li>
                        @endforeach
                        <li><a href="{{ url('livebrowsing') }}">Live Browsing</a></li>
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