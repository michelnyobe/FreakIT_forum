<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>freakIT</title>

    
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <link rel="icon" sizes="16x16" href="../images/favicon.png">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/line-awesome.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    <link rel="stylesheet" href="../css/selectize.css">
    <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>


    <header class="header-area bg-white border-bottom border-bottom-gray">
        <div class="container">
            <div class="row align-items-center p-3">
                <div class="col-lg-2">
                    <div class="logo-box">
                        <a href="{{ route('dashboard')}}" class="logo"><img src="../images/logo-black.png" alt="logo"></a>
                        <div class="user-action">
                            <div class="search-menu-toggle icon-element icon-element-xs shadow-sm mr-1" data-toggle="tooltip" data-placement="top" title="Search">
                                <i class="la la-search"></i>
                            </div>
                            <div class="off-canvas-menu-toggle icon-element icon-element-xs shadow-sm mr-1" data-toggle="tooltip" data-placement="top" title="Main menu">
                                <i class="la la-bars"></i>
                            </div>
                            <div class="user-off-canvas-menu-toggle icon-element icon-element-xs shadow-sm" data-toggle="tooltip" data-placement="top" title="User menu">
                                <i class="la la-user"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-10">
                    <div class="menu-wrapper border-left border-left-gray pl-4">
                        <nav class="menu-bar mr-auto">
                            
                        </nav><!-- end main-menu -->
                        <form method="post" class="mr-2">
                            <div class="form-group mb-0">
                                <input class="form-control form--control form--control-bg-gray" type="text" name="search" placeholder="recherhe....">
                                <button class="form-btn" type="button"><i class="la la-search"></i></button>
                            </div>
                        </form>
                        <div class="nav-right-button">
                            <ul class="user-action-wrap d-flex align-items-center">
                                
                                @if(auth()->check())
                                <li class="dropdown user-dropdown">
                                    <a class="nav-link dropdown-toggle dropdown--toggle pl-2" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                            <div class="media-img media-img-xs flex-shrink-0 rounded-full mr-2">
                                                @if(auth()->user()->profile_photo_path)
                                                <img src="{{asset('storage/' . Auth()->user()->profile_photo_path) }}" alt="{{asset('storage/' . Auth::user()->profile_photo_path) }}">
                                                @else
                                                <img src="{{ asset('img/avatar.jpg') }}" alt="Avatar">
                                                @endif

                                            </div>
                                            <div class="media-body p-0 border-left-0">
                                                <h5 class="fs-14">{{ Auth::user()->name }}!</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open" aria-labelledby="userMenuDropdown">
                                        <h6 class="dropdown-header">Hi,{{ Auth::user()->name }}</h6>
                                        <div class="dropdown-divider border-top-gray mb-0"></div>
                                        <div class="dropdown-item-list">
                                            <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="la la-user mr-2"></i>Profile</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:underline dropdown-item"><i class="la la-power-off mr-2"></i>Se déconnecter</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                @else
                                <div class="nav-right-button">
                                    <a href="{{ route('login')}}" class="btn theme-btn theme-btn-sm theme-btn-outline mr-1">se connecter</a>
                                    <a href="{{ route('register')}}" class="btn theme-btn theme-btn-sm">S'inscrire</a>
                                </div>
                               @endif 
                            </ul>
                        </div><!-- end nav-right-button -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-10 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="off-canvas-menu custom-scrollbar-styled">
            <div class="off-canvas-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <ul class="generic-list-item off-canvas-menu-list pt-90px">
               
            </ul>
            <div class="off-canvas-btn-box px-4 pt-5 text-center">
                <a href="login.html" class="btn theme-btn theme-btn-sm theme-btn-outline"><i class="la la-sign-in mr-1"></i> Login</a>
                <span class="fs-15 fw-medium d-inline-block mx-2">Or</span>
                <a href="signup.html" class="btn theme-btn theme-btn-sm"><i class="la la-plus mr-1"></i> Sign up</a>
            </div>
        </div><!-- end off-canvas-menu -->
        <div class="user-off-canvas-menu custom-scrollbar-styled">
            <div class="user-off-canvas-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end user-off-canvas-menu-close -->
            <ul class="nav nav-tabs generic-tabs generic--tabs pt-90px pl-4 shadow-sm" id="myTab2" role="tablist">
                <li class="nav-item"><div class="anim-bar"></div></li>
                <li class="nav-item">
                    <a class="nav-link active" id="user-notification-menu-tab" data-toggle="tab" href="#user-notification-menu" role="tab" aria-controls="user-notification-menu" aria-selected="true">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="user-profile-menu-tab" data-toggle="tab" href="#user-profile-menu" role="tab" aria-controls="user-profile-menu" aria-selected="false">Profile</a>
                </li>
            </ul>
            <div class="tab-content pt-3" id="myTabContent2">
                <div class="tab-pane fade show active" id="user-notification-menu" role="tabpanel" aria-labelledby="user-notification-menu-tab">
                    <div class="dropdown--menu shadow-none w-auto rounded-0">
                        <div class="dropdown-item-list">
                            <a class="dropdown-item" href="notifications.html">
                                <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                    <div class="media-img media-img-sm flex-shrink-0">
                                        <img src="images/img3.jpg" alt="avatar">
                                    </div>
                                    <div class="media-body p-0 border-left-0">
                                        <h5 class="fs-14 fw-regular">John Doe following your post</h5>
                                        <small class="meta d-block lh-24">
                                            <span>45 secs ago</span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="notifications.html">
                                <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                    <div class="media-img media-img-sm flex-shrink-0">
                                        <img src="images/img4.jpg" alt="avatar">
                                    </div>
                                    <div class="media-body p-0 border-left-0">
                                        <h5 class="fs-14 fw-regular">Arnold Smith answered on your post</h5>
                                        <small class="meta d-block lh-24">
                                            <span>5 mins ago</span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="notifications.html">
                                <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                    <div class="media-img media-img-sm flex-shrink-0">
                                        <img src="images/img4.jpg" alt="avatar">
                                    </div>
                                    <div class="media-body p-0 border-left-0">
                                        <h5 class="fs-14 fw-regular">Saeed bookmarked your post</h5>
                                        <small class="meta d-block lh-24">
                                            <span>1 hour ago</span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a class="dropdown-item border-bottom-0 text-center btn-text fw-regular" href="notifications.html">View All Notifications <i class="la la-arrow-right icon ml-1"></i></a>
                    </div>
                </div><!-- end tab-pane -->
                <div class="tab-pane fade" id="user-profile-menu" role="tabpanel" aria-labelledby="user-profile-menu-tab">
                    <div class="dropdown--menu shadow-none w-auto rounded-0">
                        <div class="dropdown-item-list">
                            <a class="dropdown-item" href="user-profile.html"><i class="la la-user mr-2"></i>Profile</a>
                            <a class="dropdown-item" href="notifications.html"><i class="la la-bell mr-2"></i>Notifications</a>
                            <a class="dropdown-item" href="referrals.html"><i class="la la-user-plus mr-2"></i>Referrals</a>
                            <a class="dropdown-item" href="setting.html"><i class="la la-gear mr-2"></i>Settings</a>
                            <a class="dropdown-item" href="index.html"><i class="la la-power-off mr-2"></i>Log out</a>
                        </div>
                    </div>
                </div><!-- end tab-pane -->
            </div>
        </div><!-- end user-off-canvas-menu -->
        <div class="mobile-search-form">
            <div class="d-flex align-items-center">
                <form method="post" class="flex-grow-1 mr-3">
                    <div class="form-group mb-0">
                        <input class="form-control form--control pl-40px" type="text" name="search" placeholder="Type your search words...">
                        <span class="la la-search input-icon"></span>
                    </div>
                </form>
                <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                    <i class="la la-times"></i>
                </div><!-- end off-canvas-menu-close -->
            </div>
        </div><!-- end mobile-search-form -->
        <div class="body-overlay"></div>
    </header>



    @yield('content')


    <section class="footer-area pt-80px bg-dark position-relative">
        <span class="vertical-bar-shape vertical-bar-shape-1"></span>
        <span class="vertical-bar-shape vertical-bar-shape-2"></span>
        <span class="vertical-bar-shape vertical-bar-shape-3"></span>
        <span class="vertical-bar-shape vertical-bar-shape-4"></span>
        <div class="container">
           
        </div><!-- end container -->
        <hr class="border-top-gray my-5">
        <div class="container">
            <div class="row align-items-center pb-4 copyright-wrap">
                <div class="col-lg-6">
                    <a href="index.html" class="d-inline-block">
                        <img src="images/logo-white.png" alt="footer logo" class="footer-logo">
                    </a>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <p class="copyright-desc text-right fs-14">Copyright &copy; 2024 nyobe michel </p>
                </div>
            </div>
        </div>
    </section>
    <div id="back-to-top" data-toggle="tooltip" data-placement="top" title="Return to top">
        <i class="la la-arrow-up"></i>
    </div>

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/selectize.min.js"></script>
    <script src="../js/jquery.multi-file.min.js"></script>
    <script src="../js/main.js"></script>

    </body>

    </html>