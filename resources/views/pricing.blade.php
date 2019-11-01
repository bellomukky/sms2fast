@extends('layouts.app')
@section('styles')
<style>
    #banner {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)),
            url("images/banner.jpg") no-repeat center center !important;
        background-size: 100% 100% !important;
    }

    #pricing{
    background: linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.7)),
    url("images/sm2f banner.jpg") no-repeat center center !important;
    background-size: 100% 100% !important;
    height:auto !important;
}

    #pricing .title-heading:after {
        content: '';
        display: block;
        border-bottom: 4px solid #fff;
        width: 40%;
        margin: 10px auto;

    }

    #pricing p.title-heading:after {
        content: '';
        display: block;
        border-bottom: 2px solid #fff;
        width: 100%;
    }

     #user-guide h2.title-heading:after {
        content: '';
        display: block;
        border-bottom: 4px solid #444;
        width: 40%;
        margin:10px auto;
    }

    #pricing .prices p {
        margin: 3px;
        padding: 0;
    }

    .service-icon {
        color: #26a960 !important;
        font-size: 70px;
    }

    .services h5 {
        color: #26a960 !important;
        font-weight: 700;
    }
    #user-guide p{
font-weight: 600;
    }

    #user-guide .guide{
border-left: 4px solid #26a960;
    }

    .testimony-name {
        color: #26a960 !important;
    }
</style>
@endsection
@section('main-content')
<div id="main-container" class="">

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
        <div id="user-guide" style="background-color:#ede9e9;">
            <div class="container">
                <div class="row text-center mt-4 pt-4 pb-5 mb-3">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading mb-0 pb-0" style="color: #444">User Guide</h2>
                        <h5 style="font-weight:600;color:#26a960;">Pay for SMS unit using the following details.</p>
                    </div>
                    <div class="col-sm-6 text-left guide">
                       <p>1. Company Name: SMS2FAST</p>
                        <p>Bank Name: Ecobank</p>
                        <p>Account Number: 4931129833</p>
                        <p>Account Name: Omorede Rawlings .U. Patrick</p>

                    </div>
                    <div class="col-sm-6 text-left guide">
                        <p>2. Company Name: SMS2FAST</p>
                        <p>Bank Name: Ecobank</p>
                        <p>Account Number: 4931129833</p>
                        <p>Account Name: Omorede Rawlings .U. Patrick</p>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="testimonies" style="background-color: white;">
            <div class="container">
                <div class="row text-center  pb-5 mb-5">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading h3-responsive" style="color: #03396a">Our Customers' Feedback</h2>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card"
                                    style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an
                                        organization where I will
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
                                        <p class=""><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO
                                            Leadway Insurance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card"
                                    style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an
                                        organization where I will
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
                                        <p><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO Leadway
                                            Insurance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card"
                                    style="background-color:#ede9e9; padding:5px 5px; border-radius: 2px;">
                                    <p class="text-grey-text" style="color: #444">I am seeking a position in an
                                        organization where I will
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
                                        <p class=""><span class="testimony-name"><b>BELLO MUKTAR</b></span> <br /> CEO
                                            Leadway Insurance</p>
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