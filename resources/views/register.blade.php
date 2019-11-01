@extends('layouts.app')
@section('styles')
<style>
    body {
        background-color: #f2f2f2;
    }

    .form-control-lg {
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

    label{
        font-size:16px !important;
        font-weight:700; 
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
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-center mt-4 mb-5"  >

                        <div style="color:#03396a;">
                        
                        <br>
                            <h2 class="title-heading">User's Registration</h2>
                            @if($errors->all())
                                @foreach($errors->all() as $error)
                                
                                    <p>{{$error}}</p>
                                @endforeach
                            @endif
                            <form action="{{route('register')}}" method="post" class="text-left">
                            @csrf
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white" 
                                            id="basic-addon1"><i
                                                    class="fa fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control 
                                        form-control-lg" placeholder="Enter Your First Name" value="{{old('first_name')}}"
                                            aria-label="Username" aria-describedby="basic-addon1"
                                             required name="first_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                                    class="fa fa-address-book"></i></span>
                                        </div>
                                        <input type="text" class="form-control
                                            form-control-lg" placeholder="Enter Your Last Name" value="{{old('last_name')}}"
                                            aria-label="Username" aria-describedby="basic-addon1" 
                                            required name="last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i
                                                    class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control 
                                        form-control-lg" placeholder="Enter Your Email Address"
                                            aria-label="Username" value="{{old('email')}}" aria-describedby="basic-addon1"
                                             required name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white"  id="basic-addon1">
                                                <i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control 
                                        form-control-lg" placeholder="Enter Your Phone Number" value="{{old('phone_number')}}"
                                            aria-label="Username" aria-describedby="basic-addon1"
                                            name="phone_number" required>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label for="">City</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white" id="basic-addon1"><i
                                                    class="fa fa-map-marker"></i></span>
                                        </div>
                                        <input type="text" class="form-control 
                                        form-control-lg" placeholder="Enter Your City" value="{{old('city')}}" aria-label="Username"
                                            aria-describedby="basic-addon1" required name="city">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                                    class="fa fa-globe"></i></span>
                                        </div>
                                        <select name="state" class="form-control" id="" required>
                        
                                            <option value="">Select State</option>
                                            <option value="Abia">Abia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">How did you hear About Us</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i
                                                    class="fa fa-link"></i></span>
                                        </div>
                                        <select name="hau" required class="form-control" id="">
                        
                                            <option value="">Select Option</option>
                                            <option value="Social Media">Social Media</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="">Gender</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i
                                                    class="fa fa-link"></i></span>
                                        </div>
                                        <select name="sex" required class="form-control" id="">
                        
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger 
                                            text-white" id="basic-addon1"><i
                                                    class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control 
                                        form-control-lg" placeholder="Enter Your Password" aria-label="Password"
                                            aria-describedby="basic-addon1" required name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                                    class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control 
                                        form-control-lg" placeholder="Confirm Your Password" aria-label="Username"
                                            aria-describedby="basic-addon1" required name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block ">SIGN IN
                                        <span class="fa fa-sign-in"></span>
                                    </button>
                                </div>
                            </form>
                        
                        
                            <hr style="height:1.5px;">
                            
                            <a href="{{route('login')}}" class="text-primary pull-right">Already Registered?</a>
                        </div>
                          
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection