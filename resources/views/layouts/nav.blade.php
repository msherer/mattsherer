<nav class="navbar navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#myNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="top-social-icons list-inline pull-right">
                    <li><a class="s-facebook" href="https://www.facebook.com/matt.sherer.33"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="s-twitter" href="https://twitter.com/sat_boodead"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="s-google-plus" href="https://plus.google.com/101192338504783742502?hl=en"><i class="fa fa-google-plus"></i></a></li>
                    <li><a class="s-linkedin" href="https://www.linkedin.com/in/sherer/"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="s-twitch" href="https://www.twitch.tv/boodead"><i class="fa fa-twitch"></i></a></li>
                    <li class="top-search">
                        <a href="#" class="sactive"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav text-uppercase pull-left">
                    <li><a class="navbar-brand" href="/">mSHERER</a></li>
                    <li><a href="/about">About me</a></li>
                    <li><a href="/contact">Contact</a></li>

                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li class="active"><a href="/profile/{{ Auth::user()->id }}">Profile</a></li>

                                @if (Auth::user()->email == 'msherer033@gmail.com')

                                    <li class="active"><a href="/posts/create">Create Post</a></li>
                                    <li class="active"><a href="/posts/list/{{ Auth::user()->id }}">View All Posts</a></li>

                                @endif

                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Registration</a></li>
                    @endif

                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>