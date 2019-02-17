<header id="head">
    <div class="container-fluid" style = "height: 90px;">
        <div class="row">
            <div class="fheader col-md-8">
                <a class="navbar-brand" href="/">
                    <img src="/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
                </a>
            </div>
            <div class="fheader col-md-4" id="list">
                <div id="div_top_hypers">
                    <ul id="ul_top_hypers">
                        <li><a href="" class="a_top_hypers"> HELP</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MY ACCOUNT <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/account">ACCOUNT SETTINGS</a></li>
                                <li><a href="/gift-dashboard">DASHBOARD</a></li>
                                <li><a href="{{ url('/logout') }}">LOGOUT</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>