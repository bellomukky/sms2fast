@extends('layouts.app')
@section('styles')
<style>


  body{
      background-color: #f2f2f2;
  }

  @media (max-width: 576px){
.card-header {
    padding: 0,5px;
    margin-left: 0px !important;
    }
  }


    #banner hr {
        background-color: #03396a !important;
       
    }
</style>
@endsection
@section('main-content')
     <div id="main-container" class="">

        <div id="banner">
            <div class="container">
                <div class="row align-items-center" style="height:500px;">
                    <div class="col-12 col-md-8 offset-md-2 text-center">
        
                        <div style="">
                           
                            <div class="card">
                                <div class="card-header" style="background-color:#03396a;">
                                    <img src="{{asset('images/logo1.png')}}"
                                     class="mx-auto d-block img img-responsive" width="200px;" alt="">
                                </div>
                                <div class="card-body">

                                    <h2 style="color:#03396a; font-weight:700">Hello {{Auth::user()->last_name}},</h2>
                                    <p style="color:#444; font-weight:600;">Thanks so much for joining SMS2fast, To start sending bulk sms, you need to confirm that 
                                        we got your email address right.
                                    </p>
                                   
                                </div>
                                <div class="card-footer" style="background:#eee;">
                                     <a href="{{route('verification.resend')}}" class="btn btn-featured">
                                        Resend Verification Token</a>
                                </div>
                            </div>
                            
                           
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection