@extends('layouts.user_app')
@section('styles')
 <link rel="stylesheet"  type="text/css" href="{{asset('css/bootstrap-datetimepicker.css')}}">
<style>
label{
    font-size:16px;
    font-weight:700;
}
</style>
<!-- <script>
// function countRecipient()
// {
// 		var a = document.getElementById('dnr').value;
// 		if(a=="")
// 		{
// 				document.getElementById('rec').innerHTML= 0;
// 		}
// 		else
// 		{
// 		var arr = a.split(",");
// 		document.getElementById('rec').innerHTML= arr.length;
// 		}

// }
</script> -->
@endsection
@section('main-content')
<div class="row">
    <div class="col-12">
       <div class="card">
           <div class="card-body">
           <h5 class="card-title">Compose/Schedule SMS</h5>
               <hr>
               @if(session('error'))
               <p class="text-danger text-center">{!!session('error')!!}</p>
               @endif
               @if(session('message'))
               <p class="text-success text-center">{!!session('message')!!}</p>
               @endif
                <form action="{{route('send.sms')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="">Sender ID</label>
                        <input type="text" class="form-control"
                         name="sender_id" value="{{old('sender_id')}}" id="" placeholder="Enter Phone Number or Name">
                         <span class="text-danger">{{$errors->first('sender_id')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="">I want to choose my recipients</label><br>
                    <label for="notepad"><input type="radio" class="select_recipient" id="notepad" name="select_recipient"
                     value="notepad" checked {{old("select_recipient") =="notepad" ? 'checked':""}} /> 
                    By Pasting Fom Notepad</label>
                    <label for="group"><input type="radio" id="group" class="select_recipient" name="select_recipient" 
                    value="group" {{old("select_recipient") =="group" ? 'checked':""}} > From Contact Groups</label>
                    
                    </div>
                    <div id="">
                        <div class="form-group" id="contact-group" style="display:none;">
                            <label for="">Contact Group</label>
                           <select name="contact_group" class="form-control" id="contact_group">
                                <option value="">--Select Group--</option>
                                @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                                @endforeach
                           </select>
                        </div>
                        <div class="form-group" id="paste-notepad">
                            <label for="">Recipients</label>
                            <textarea name="recipients" id="recipients" required class="form-control" 
                            rows="3">{{old('recipients')}}</textarea>
                            <span class="text-muted"><span id="rec">0</span> recipients</span>
                            <span class="text-danger">{{$errors->first('recipients')}}</span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" id="message" required class="form-control" 
                        rows="5">{{old('message')}}</textarea>
                        <span class="text-muted">Page: <span id="pages">0</span>, 
                        Characters left: <span id="remaining">160</span>, Total Typed Characters: <span id="total-typed">0</span></span>
                        <span class="text-danger">{{$errors->first('message')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Message Type</label>
                       <select name="message_type" class="form-control" id="">
                           
                            <option value="1">Normal Message</option>
                            <option value="0">Flash Message</option>
                       </select>
                    </div>
                    <div class="form-group">
                         <label for="is_schedule">Do You want to schedule the Message? 
                         <input type="checkbox" id="is_schedule"
                         name="is_schedule" value="1"></label>
                        
                       <div id="schedule-div" style="display:none;">
                            <label for="">Schedule Date-Time</label>
                            <input type="text" class="form-control"
                             name="schedule_datetime" id="schedule_datetime">
                       </div>
                    </div>

                  
                    <div class="form-group">
                    
                        <button type="submit" class="btn btn-block btn-success">Send Message</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript">
recipientsCounter();
messageCounter();

      $('#schedule_datetime').datetimepicker({
        format: 'yyyy-MM-dd HH:mm P',
        fontAwesome: true,
        minDate:new Date()
      })
      $('#schedule_datetime').datetimepicker('update', new Date())
      
 $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
         }
})

function messageCounter()
{
      var chars = $('#message').val().length;
        var messages = Math.ceil(chars / 160);
        var remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

        $('#total-typed').html(chars);
        $('#remaining').html(remaining);
        $('#pages').html(messages);
}
function recipientsCounter()
{
    var a = $('#recipients').val();
    if(a=="")
    {
            $('#rec').html(0);
    }
    else
    {
        var arr = a.split(",");
    $('#rec').html(arr.length);
    }
}


$('#is_schedule').click(function(){
     if($('input[name="is_schedule"]:checked').length > 0)
     {
        $('#schedule-div').fadeIn();
        $('#schedule_datetime').attr("required","required")
     }else{
         $('#schedule-div').fadeOut();
         $('#schedule_datetime').removeAttr("required")
     }

})
$('.select_recipient').change(function(){
    if($(this).val() == 'notepad')
    {
        $('#contact-group').hide();
        $('#recipients').val("");
        $('#contact_group').removeAttr('required');
         $('#contact_group').val("");
    }else{
        $('#contact-group').fadeIn();
        $('#contact_group').attr('required','required');
        $('#recipients').val("");
    }
     recipientsCounter();
})

 $('#message').keyup(function(){
 
      messageCounter();
});
$('#recipients').keyup(function(){
    
   recipientsCounter();
})



$('#contact_group').change(function()
{
 recipientsCounter();
    if($('#contact_group').val() != "")
    {
        $('#recipients').prop("disabled",true);
        $('#recipients').val("Contact Loading...")
        var formData = new FormData();
        formData.append('id', $('#contact_group').val());

         $.ajax({
            url:"{{route('contacts.get')}}",
            data:formData,
            processData:false,
            contentType: false,
            cache: false,
            type:'POST',
        success:function(data){
            $('#recipients').prop("disabled",false);
             $('#recipients').val(data)
              recipientsCounter();
        },
        error:function(xhr,data){
             $('#recipients').prop("disabled",false);
              $('#recipients').val("")
              recipientsCounter();
        }
    });
    }else{
          $('#recipients').val("")
          recipientsCounter();
    }

   
})


</script>
@endsection