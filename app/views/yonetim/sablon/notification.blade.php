<header class="header">
    <a href="/yonetim" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Eticaret Admin Panel
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>
                            {{Session::get('yonetim_user_id')}}
                            <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                            <p>
                                {{Session::get('yonetim_user_id')}} - 
                                @if(Session::get('yonetim_seviye')==0)
                                Root yönetici
                                @else
                                Yonetici
                                @endif
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="profil" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="cikis" class="btn btn-default btn-flat">Çıkış yap</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
