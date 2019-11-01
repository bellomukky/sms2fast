<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMS2FAST - Homepage</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <header class="fixed-top">
         <div class="topnav  pr-3 pl-3 pr-md-5 pl-md-5">
            <div>
                <div class="row align-items-center">
                    <div class="col-6 col-md-3">
                        <a href="https://facebook.com/" target="_blank" class="text-white px-2 pl-0"><span class="fa fa-facebook"></span></a>
                        <a href="https://instagram.com/" target="_blank" class="text-white px-2"><span class="fa fa-instagram"></span></a>
                        <a href="https://twitter.com/" target="_blank" class="text-white px-2"><span class="fa fa-twitter"></span></a>
                        <a href="https://linkedin.com/" target="_blank" class="text-white px-2"><span class="fa fa-linkedin"></span></a>
                    </div>
                    <div class="col-6 col-md-9 text-right">
                        <div class="d-inline-block"><a href="mailto:irosportupdate@gmail.com" target="_blank" class="text-white p-2 d-flex align-items-center">
                            <span class="fa fa-envelope mr-3"></span> <span class="d-md-block">Contact Us</span></a></div>
                    </div>
                </div>
            </div>
           
        </div>

        <nav class="navbar navbar-inverse navbar-expand-md navcolor scrolling-navbar pr-3 pl-3 pr-md-5 pl-md-5">
            <a class="navbar-brand" href="index.html"> 
               <img src="{{asset('images/logo1.png')}}" width="150px" 
                           class="img img-responsive" alt="SMS2Fast Logo">
             </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
             data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About Us</a>
                       
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('pricing')}}">Pricing</a>
                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                
                </ul>
            </div>
        </nav>

       
  
    </header>
 


@yield('main-content')

<!--Footer-->
<footer class="page-footer font-small pt-0 mt-5">

    <div class="footer">
        <div class="container">
            <div class="row p-4  align-items-center">
                <div class="col-12">
<h1 class="text-center">SMS2FAST</h1>
                </div>
               
                <div class=" col-12 text-center">
                    <!--Facebook-->
                    <a  href="{{route('home')}}" class=" ml-0">
                       Home |
                    </a>
                    <a href="{{route('about')}}" class="">
                         About Us |
                    </a>
                    <a href="{{route('pricing')}}" class="">
                        Pricing |
                    </a>
                    @guest
                    <!--Twitter-->
                    <a href="{{route('login')}}" class="">
                       Login |
                    </a>
                    <!--Google +-->
                    <a href="{{route('register')}}">
                        Register 
                    </a>
                    @endguest
                
                </div>
            </div>
            <hr>
            <div class="row">

            </div>
            <!--Grid row-->
            <div class="row p-4 align-items-center">

                <!--Grid column-->
                <div class="col-12 col-md-6 col-lg-6 text-center text-md-right mb-4 mb-md-0">
                    <h6 class="mb-0 white-text">Connect with us on social networks!</h6>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class=" col-12 col-md-6 col-lg-6 text-center text-md-left">
                    <!--Facebook-->
                    <a href="https://facebook.com/" target="_blank" class="fb-ic ml-0">
                        <i class="fa fa-facebook white-text mr-3 mr-lg-4 "> </i>
                    </a>
                    <!--Twitter-->
                    <a href="https://twitter.com/" target="_blank" class="tw-ic">
                        <i class="fa fa-twitter white-text mr-3 mr-lg-4"> </i>
                    </a>
              
                   
                    <!--Linkedin-->
                    <a href="https://linkedin.com/" target="_blank" class="li-ic">
                        <i class="fa fa-linkedin white-text mr-3 mr-lg-4"> </i>
                    </a>
                    <!--Instagram-->
                    <a  href="https://linkedin.com/" target="_blank" class="ins-ic">
                        <i class="fa fa-instagram white-text mr-3 mr-lg-4"> </i>
                    </a>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->
        </div>
    </div>

  

    <!-- Copyright-->
    <div class="footer-copyright py-3 text-center">
        © {{date("Y")}} Designed By:
        <a href="#">
            <strong>SMS2FAST</strong>
        </a>
    </div>
    <!--/.Copyright -->

</footer>
<!--/.Footer-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
@yield("scripts")

</body>
</html>