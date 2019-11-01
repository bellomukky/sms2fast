@extends('layouts.user_app')
@section('styles')
 <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
   
<style>
label{
    font-size:16px;
    font-weight:700;
}
</style>
@endsection
@section('main-content')
<div class="row">
    <div class="col-12">
       <div class="card">
           <div class="card-body">
           @if(session('message'))
           <p class="text-success">{{session('message')}}</p>
           @endif
               <h5 class="card-title">Create Contact Group</h5>
               <hr>
                <form action="{{route('group.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" placeholder="Enter Group Name" 
                        name="group_name" required value="{{old('group_name')}}" id="">
                        <span class="text-danger">{{$errors->first('group_name')}}</span>
                    </div>
                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-lg btn-success"> Create Group</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
     <div class="col-12 ">
       <div class="card">
           <div class="card-body">
               <h5 class="card-title">My Contact Groups</h5>
               <div class="table-responsive">
                                    <table id="zero_config" class="table table-sm-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/No</th>
                                                <th>Group Name</th>
                                                <th>No of Contact</th>
                                                <th>Upload Contacts</th>
                                                <th>Manage Group</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($groups as $group)
                                            <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$group->group_name}}</td>
                                            <td>{{count($group->contacts)}}</td>
                                            <td><a href="{{route('contact.upload',$group->id)}}" class="btn btn-info">Upload contact</a></td>
                                             <td><a href="{{route('group.manage',$group->id)}}" class="btn btn-primary">Manage Contact</a></td>
                                             <td>
                                                <form id="delete-form-{{$group->id}}" action="{{route('group.delete',$group->id)}}" 
                                                style="display:none;" method="post">
                                                @csrf
                                                {{method_field("DELETE")}}
                                                </form>
                                                <a href="javascript:void(0)" 
                                                 onclick="event.preventDefault();
                                                if(confirm('Are you sure want to delete this?'))
                                                {document.getElementById('delete-form-{{$group->id}}').submit()}"
                                                class="btn btn-sm btn-danger">Trash</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
           </div>
       </div>
    </div>
</div>
@endsection
@section('scripts')
 <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
@endsection