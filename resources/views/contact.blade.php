@extends('layouts.app')
@section('styles')
<style>
    #banner {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)),
            url("images/banner.jpg") no-repeat center center !important;
        background-size: 100% 100% !important;
    }

    #pricing {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)),
            url("images/banner.jpg") no-repeat center center !important;
        background-size: 100% 100% !important;
        height: auto !important;
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

    #pricing .prices p {
        margin: 3px;
        padding: 0;
    }

    .service-icon {
        color: #26a960 !important;
        font-size: 70px;
    }

    .contact-heading{
        color: #26a960 !important;
        font-weight: 600; 
    }

    .services h5 {
        color: #26a960 !important;
        font-weight: 700;
    }

    .testimony-name {
        color: #26a960 !important;
    }
</style>
@endsection
@section('main-content')
<div id="main-container" class="">

        <div id="contact-us" class="pt-5 pb-5" style="background-color: white;">
            <div class="container">
                <div class="row">
                   <div class="col-sm-7">
                       <div class="row">
                            <div class="col-md-12 mb-2 mt-2 text-center">
                                <h2 class=" title-heading h3-responsive" style="color: #03396a">Contact us.</h2>
                                <p>Send your comments, emails or questions to us and get instant response.</p>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your full name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="text" class="form-control" placeholder="Enter your email address">
                                </div>
                                <div class="form-group">
                                    <label for="">Comments/Message</label>
                                   <textarea name="" id="" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-featured"> Send Message <span class="fa fa-send"></span></button>
                                </div>
                            </div>
                       </div>
                   </div>
                   <div class="col-sm-5  mt-sm-5 mt-2">
                       <div class="row">
                           <div class="col-12 mt-sm-5 pt-sm-5" style="border-left:4px solid #26a960;">
                               <p><span class="contact-heading"> <span class="fa fa-phone"></span> Phone Numbers:</span> <br>
                                (+234) 0803-605-6777</p>
                                <p><span class="contact-heading"> <span class="fa fa-envelope"></span> Email Address:</span> <br>
                                    info@sms2fast.com</p>
                                <p><span class="contact-heading"> <span class="fa fa-map-marker"></span> Office Address:</span> <br>
                                        No 3 Nagogo Road, Cripsy Residence GRA, Katsina, Katsina State.</p>

                           </div>
                       </div>
                   </div>

                </div>


            </div>
        </div>

    </div>
@endsection