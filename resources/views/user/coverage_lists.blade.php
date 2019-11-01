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
               <h5 class="card-title">Search for Coverages</h5>
               <hr>
                <form action="{{route('coverage.lists')}}" method="get">
              
                    <div class="form-group">
                        <label for="">Select Country</label>
                        <select name="country" id="" class="form-control">
                                <option value="">--Select Country--</option>
                                @foreach($countries as $country)
                                    <option {{session('country')== $country->country?'selected':''}} value="{{$country->country}}">{{$country->country}}</option>
                                @endforeach
                        </select>
                        <span class="text-danger">{{$errors->first('country')}}</span>
                    </div>
                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-lg btn-success"> Search Coverage</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
     <div class="col-12 ">
       <div class="card">
           <div class="card-body">
               <h5 class="card-title">Search results for coverages</h5>
               <hr>
               <div class="table-responsive">
                                    <table id="zero_config" class="table table-sm-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/No</th>
                                                <th>Country</th>
                                                <th>Company</th>
                                                <th>Code</th>
                                                <th>Charge</th>
                                              
                                            </tr>
                                        </thead>
                                       @if($country_codes)
                                             <tbody>
                                            @foreach($country_codes as $country_code)
                                            <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$country_code->country}}</td>
                                            <td>{{$country_code->company}}</td>
                                            <td>{{$country_code->code}}</td>
                                             <td>{{$country_code->charge}}</td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                       @endif
                                        
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