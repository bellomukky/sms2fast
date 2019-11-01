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
               <h5 class="card-title">Upload Contacts to Group</h5>
               <hr>
                <form action="{{route('contact.upload',$group->id)}}" method="post"  enctype="multipart/form-data">
                   @csrf

                   @if(count($errors->all()))
                   @foreach($errors->all() as $error)
                   <p>{{$error}}</p>
                   @endforeach
                   @endif
                    <div class="form-group">
                    <input type="hidden" name="group_id" value="{{$group->id}}">
                        <label for="">I want to choose my recipients</label><br>
                    <label for=""><input type="radio" checked 
                    {{old('choose_contact') == 'notepad'?'checked':''}} name="choose_contact" 
                    class="select-file" value="txt"> 
                    By Pasting From Notepad</label>
                     <label for=""><input type="radio" name="choose_contact" 
                      {{old('choose_contact') == 'excel'?'checked':''}} class="select-file" value="xls"> 
                    By Pasting From Excel (1997 -2003)</label>
                    <label for=""><input type="radio" name="choose_contact" class="select-file"
                     {{old('choose_contact') == 'csv'?'checked':''}} value="csv"> From CSV file</label>
                    
                    </div>
                    <div id="recipients">
                        
                         <div class="form-group" id="excel-contact" >
                            <label for="">Import Recipient from file</label>
                            <input type="file" class="form-control" accept=".txt"
                            value="{{old('contacts_file')}}" required name="contacts_file" id="import-file">
                            <span class="text-danger">{{$errors->first('contacts')}}</span>
                        </div>
                    </div>
                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-block btn-success">Upload Contact</button>
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