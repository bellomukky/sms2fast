@extends('layouts.app')
@section('styles')
<style>
#banner{
    background: linear-gradient(rgba(0, 0, 0, 0.8),rgba(0, 0, 0, 0.7)),
    url("images/SM2 BANNER3.jpg") no-repeat center center !important;
    background-size: 100% 100% !important;
}

#pricing{
    background: linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.7)),
    url("images/sm2f banner.jpg") no-repeat center center !important;
    background-size: 100% 100% !important;
    height:auto !important;
}

#pricing .title-heading:after{
    content: '';
    display: block;
    border-bottom:4px solid #fff;
    width:40%;
    margin: 10px auto;

}

#pricing p.title-heading:after{
   content: '';
    display: block;
    border-bottom:2px solid #fff;
    width:100%;
}

#pricing .prices p{
    margin:3px;
    padding:0;
}

.service-icon{
    color:#26a960 !important;
    font-size: 70px;
}

.services h5{
     color:#26a960 !important;
     font-weight: 700;
}
.testimony-name{
  color:#26a960 !important;  
}
</style>
@endsection
@section('main-content')
<div id="main-container" class="">
   
        <div id="banner">
            <div class="container">
                <div class="row align-items-center" style="height:500px;">
                    <div class="col-12 ">
                        <div class="text-center">
                            <h1  style="color:white !important;">Nigeria's Leading Bulk SMS Service Provider.</h1>
                            <h6 class="h6-responsive" style="color:white !important;"><span class="fa fa-circle"></span> Send SMS <span class="fa fa-circle"></span> Transfer SMS
                                <span class="fa fa-circle"></span> SMS Log</h6>
                              
                                    <a href="{{route('register')}}" class="btn btn-main"   style="width: auto;  line-height:40px;"><b>Create New Account</b></a>
                                    <a href="{{route('login')}}" class="btn btn-featured"  style="width: auto; line-height:40px;"><b>Go to Dashboard</b></a>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="our-services" class="pt-5 pb-5" style="background-color: white;" >
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading h3-responsive" style="color: #03396a">Services we Offer</h2>
                    </div>
                    <div class="col-12 col-sm-4 services">
                        <h1 class="service-icon"> <b><span class="fa fa-american-sign-language-interpreting"></span></b>  </h2>
                        <h5>Credit Transfer</h5>
                        <p>You can share sms credit with your friends or other users
                            on SMSCare.</p>
                    </div>
                    <div class="col-12 col-sm-4 services">
                        <marquee><h2 class="service-icon"><span class="fa fa-envelope"></span></h2></marquee>
                        <h5>Bulk SMS</h5>
                        <p>You can send bulk sms to your audience from the
                             comfort of your house or offices to promote your brand
                           </p>
                    </div>
                    <div class="col-12 col-sm-4 services">
                        <h2 class="service-icon"><span class="fa fa-book"></span></h2>
                        <h5 >SMS Logs</h5>
                        <p>We provide you detailed records on how you have been using
                            your SMS units or credits.</p>
                    </div>
            
                </div>
            
            
            </div>
        </div>
        
        <div id="pricing" class="pb-4 pt-4">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading h3-responsive" style="color: white">Bulk SMS Pricing</h2>
                       
                    </div>
                   <div class="col-12">
                       <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 prices">
                                    <div class="row text-white">
                                        <div class="col-12 pricing-card pt-5 pb-5"
                                         >
                                            <h6><strong>Starter</strong></h6>
                                            <h1 class="pb-0 mb-0" style="font-size:70px;" >#2.00</h1>
                                            <p class="title-heading"><strong>/SMS</strong></p>
                                            <p>250 - 999 SMS/Unit</p>
                                            <p>Free SMS Account</p>
                                            <p>Excellent delivery rate</p>
                                            <p>Flat rate to all network</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 prices">
                                    <div class="row text-white">
                                        <div class="col-12 pricing-card pt-5 pb-5" >
                                            <h6><strong>Premium</strong></h6>
                                            <h1 class="pb-0 mb-0" style="font-size:70px;">#1.90</h1>
                                            <p class="title-heading"><strong>/SMS</strong></p>
                                            <p>1,000 - 1,999 SMS/Unit</p>
                                            <p>Free SMS Account</p>
                                            <p>Excellent delivery rate</p>
                                            <p>Flat rate to all network</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 ">
                                <div class="prices">
                                    <div class="row text-white">
                                        <div class="col-12 pricing-card pt-5 pb-5">
                                            <h6><strong>Enterprise</strong></h6>
                                            <h1 class="pb-0 mb-0" style="font-size:70px;">#1.80</h1>
                                            <p class="title-heading"><strong>/SMS</strong></p>
                                            <p>Above 2,000 SMS/Unit</p>
                                            <p>Free SMS Account</p>
                                            <p>Excellent delivery rate</p>
                                            <p>Flat rate to all network</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       
                   </div>
                   
                </div>
            </div>
        </div>
        <!-- <div id="testimonies" style="background-color: white;">
            <div class="container">
                <div class="row text-center pt-5 pb-5 mb-5">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading h3-responsive" style="color: #03396a">Our Customers' Feedback</h2>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an organization where I will
                                        use my knowledge and skills to drive their transition, benefit
                                        my society, impact</p>
                                </div>
                            </div>
                            <div class="image-text col-12 mt-2">
                               <div class="row">
                                    <div class="col-3">
                                        <img src="images/agent.jpg" class="img rounded-circle" width="60px" alt="">
                                    </div>
                                    <div class="col-9 text-justify">
                                        <p class=""><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO Leadway Insurance</p>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an organization where I will
                                        use my knowledge and skills to drive their transition, benefit
                                        my society, impact</p>
                                </div>
                            </div>
                            <div class="image-text col-12 mt-2">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="images/agent.jpg" class="img rounded-circle" width="60px" alt="">
                                    </div>
                                    <div class="col-9 text-justify">
                                        <p ><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO Leadway Insurance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an organization where I will
                                        use my knowledge and skills to drive their transition, benefit
                                        my society, impact</p>
                                </div>
                            </div>
                            <div class="image-text col-12 mt-2">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="images/agent.jpg" class="img rounded-circle" width="60px" alt="">
                                    </div>
                                    <div class="col-9 text-justify">
                                        <p class=""><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO Leadway Insurance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
   
</div>
@endsection