@extends('layouts.user_app')
@section('styles')
<style>
label{
    font-size:16px;
    font-weight:700;
}
</style>
@endsection
@section('main-content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2">
       <div class="card">
           <div class="card-body">
           <h5 class="card-title">Buy SMS Credit Unit</h5>
               <hr>
               @if(session('message'))
               <p class="text-center text-success">{!!session('message')!!}</p>
               @endif
                @if(session('error'))
               <p class="text-center text-danger">{!!session('error')!!}</p>
               @endif
                <form action="{{route('buy.sms')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="">Pin Digits/Token</label>
                        <input type="text" class="form-control"
                         name="card_number" value="{{old('card_number')}}" required id="">
                         <span class="text-danger">{{$errors->first('card_number')}}</span>
                    </div>
                   

                    
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-block btn-success">Buy SMS Credits</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection