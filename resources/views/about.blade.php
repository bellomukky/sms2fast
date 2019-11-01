@extends('layouts.app')
@section('styles')
<style>
  

    #pricing {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)),
            url("images/banner.jpg") no-repeat center center !important;
        background-size: 100% 100% !important;
        height: 600px !important;
    }

    #pricing .title-heading:after {
        content: '';
        display: block;
        border-bottom: 4px solid #fff;
        width: 40%;
        margin: 10px auto;

    }


    .testimony-name {
        color: #26a960 !important;
    }

    ul.list-style-none{
        margin:0px;
        padding:0px;
    }
    .list-style-none li{
        list-style: none;
        font-size:16px;
        font-weight: bold;
        color:#26a960;
    }

    #how-to-use .card{
      
        box-shadow: 0px  0px 1px 1px rgba(0, 0, 0, 0.3);

    }
</style>
@endsection
@section('main-content')
  <div id="main-container" class="">

        

        <div id="about-us" class="pt-2" style="background-color: white;">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 mb-2 mt-2 text-center">
                        <h2 class=" title-heading h3-responsive" style="color: #03396a">Who we Are</h2>
                    </div>
                    <div class="col-sm-5">
                        <img src="images/banner.jpg" 
                        class="img rounded-corner" height="200px" alt="">
                    </div>
                    <div class="col-sm-7">
                        <p class="text-left"> We are the leading mobile messaging provider. Our Bulk SMS gateway is finely tuned to deliver the fastest and most
                        reliable SMS messaging compared with other Bulk SMS Gateway Providers.
                        Messaging can transform the way organisations communicate with members, customers and suppliers. Also Religious bodies
                        can communicate more personally with its members and share spiritual thoughts daily through SMS.
                        When sending messages with our service you can be confident that your messages will be delivered instantly.
                            </p>
                    </div>

                </div>


            </div>
        </div>
        <div id="how-to-use" class="mt-4" style="background-color: white;">
            <div class="container">
                <div class="row text-center">
                    
                    <div class="col-md-6 mt-2">
                        <div class="card pr-2 pl-2 pt-1" >
                            <div class="p-0 m-0">
                                    <h4 class="m-0 p-0 title-heading" style="color: #03396a">
                                        Application Areas</h4>
                                    <ul class="list-style-none text-left">
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-users mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">Message delivery to business partners, customers,
                                                             staff as well as your friends.</span>
                                                       
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                    
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-envelope mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Invitation to traditional marriages, wedding, birthday & funeral ceremonies. </span>
                                                       
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-building mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">Invitation to special programs such as Crusades, Church harvest, child dedications, as well as book/product launch. </span>
                                        
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-envelope mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Message delivery during campaigns elections. </span>
                                        
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-phone mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">Parents and Teachers communication through SMS.</span>
                                        
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-check-circle mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Vital in the delivery of goodwill messages during festive seasons and other occasions. </span>
                                        
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                    </ul>    
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card pr-2 pl-2 pt-1">
                            <div class="m-0 p-0">
                                <h4 class="m-0 p-0 title-heading" style="color: #03396a">
                                    Our Qualities</h4>
                                    <ul class="list-style-none text-left">
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-clock-o mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">Fast delivery of messages within seconds.</span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                    
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-money mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Low cost and easy communication.. </span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-user mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">Sender ID branding.</span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                    
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-envelope mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Schedule SMS for future delivery. </span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-check mr-2"></i>
                                                    <div>
                                                        <span class="font-bold ">SMS credits do not expire.</span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                    
                                        <li class="border-top">
                                            <p class="m-b-0 p-0">
                                                <div class="d-flex no-block">
                                                    <i class="fa fa-users mr-2"></i>
                                                    <div>
                                                        <span class="font-bold">Transfer SMS credits to other users. </span>
                    
                                                    </div>
                                                </div>
                                            </p>
                                        </li>
                                    </ul>
                            </div>
                    
                        </div>
                    </div>
        
                </div>
        
        
            </div>
        </div>

       
        <!-- <div id="testimonies" style="background-color: white;">
            <div class="container">
                <div class="row text-center pt-5 mb-5">
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