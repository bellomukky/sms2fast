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
    <div class="col-12  col-md-8 offset-md-2 col-lg-6 offset-lg-3">
       <div class="card">
           <div class="card-body">
               <h5 class="card-title">Update contact of {{$contact->group->group_name}}</h5>
               <hr>
                <form action="{{route('contact.edit',$contact->id)}}" method="post"  enctype="multipart/form-data">
                   @csrf

                 
                
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$contact->id}}">
                        <label for="">Contact Name</label>
                        <input type="text" name="name" required class="form-control"
                        value="{{$contact->name == null ? old('name'):$contact->name }}"/>
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>
 
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="tel" name="phone_number"  class="form-control"
                        value="{{$contact->phone_number == null ? old('phone_number'):$contact->phone_number }}"/>
                        <span class="text-danger">{{$errors->first('phone_number')}}</span>
                    </div>
                   
                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-block btn-success">Update Contact</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.select-file').change(function(){
            $('#import-file').attr("accept","."+$(this).val())
             $('#import-file').val("");
        })
    })
</script>
@endsection