@extends('layouts.app')
@section('styles')
<style>


  body{
      background-color: #f2f2f2;
  }

.form-control:focus
{
    box-shadow:none !important;
    background-color:#fff !important;
}
  .form-control-lg{
    border-top-right-radius: 2px !important;
    border-bottom-right-radius: 2px !important;
    line-height: 1.5;
    padding: 0.5rem 1rem;
    font-size: 1.09375rem;
    }

    #pricing .title-heading:after {
        content: '';
        display: block;
        border-bottom: 4px solid #fff;
        width: 40%;
        margin: 10px auto;

    }

    .service-icon {
        color: #26a960 !important;
        font-size: 70px;
    }

    .services h5 {
        color: #26a960 !important;
        font-weight: 700;
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
                    <div class="col-12 text-center">
        
                        <div style="display:inline-block; width:350px;" class="text-white">
                           
                            
                            <h2 style="color:#03396a;">User's Login</h2>
                            <form action="{{route('login')}}" method="post">
                           @foreach($errors->all() as $error)
                            <p class="text-danger">{{$error}}</p>
                           @endforeach
                            @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white"
                                            id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" 
                                        placeholder="Email Address"
                                        value="{{old('email')}}" name="email" aria-label="Username"
                                            aria-describedby="basic-addon1" required="">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon1"><i
                                                class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg"
                                    name="password" placeholder="Password"
                                        aria-label="Username" aria-describedby="basic-addon1" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block ">SIGN IN
                                        <span class="fa fa-sign-in"></span>
                                    </button>
                                </div>
                            </form>
                          

                        
                            <hr style="height:1.5px;">
                            <a href="" class=" pull-left text-warning">Forgotten Password?</a>
                            <a href="{{route('register')}}" class="text-success pull-right">Not Registered?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection