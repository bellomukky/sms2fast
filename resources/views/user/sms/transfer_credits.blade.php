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
           <h4>Transfer SMS Credit</h4>
           <hr>
           @if(session('error'))
           <p class="text-danger text-center">{!!session('error')!!}</p>
           @endif
            @if(session('message'))
           <p class="text-success text-center">{!!session('message')!!}</p>
           @endif

                <form action="{{route('transfer.credit')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="">Credit Unit</label>
                        <input type="number" class="form-control" value="{{old('credit_unit')}}"
                         name="credit_unit" id="">
                    </div>
                    
                    <div id="recipients">
                        <div class="form-group">
                        <label for="">Recipients</label>
                        <textarea name="recipients" 
                        class="form-control" rows="3">{{old('recipients')}}</textarea>
                        <span class="text-muted"><small>Email address of the Recipeints separated by comma 
                        if more than one e.g user@email.com</small></span>
                    </div>
                    </div>
                  

                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-block btn-success">Transfer Credit</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection