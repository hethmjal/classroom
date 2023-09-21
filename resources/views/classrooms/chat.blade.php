@extends('layout.master',['title' => $classroom->name.' - Classroom'])
@section('content')

@push('css')
<style>
    .bg-img{
      background-image: 
        url("{{$classroom->cover_image_url}}");
        font-family: 'Changa', sans-serif;
        /*  height: 500px; */ /* You must set a specified height */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;x
    }
  </style>
@endpush
    <div class="container  ">
        <div class="row">
         <div class="rounded col-md-12 bg-img " style="height: 240px; width: 100%">
     
      <div class="d-flex align-items-start flex-column " style="height: 240px;">
         <div class="mt-auto ">
            <h1 class="text-white">{{$classroom->name}}  - # Chat Room</h1>
         </div>
      </div>
     
         </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        <div class="border rounded text-center my-2">
           
            //users

        </div>

        

        <div  class="my-2">
           <p> <a href="{{route('classrooms.classworks.index',$classroom->id)}}" class="btn btn-outline-dark" target="_blank">Classworks</a> </p>

        </div>

        <div  class="my-2">
            <p> <a href="{{route('classrooms.people',$classroom->id)}}" class="btn btn-outline-dark" target="_blank">Memebers</a> </p>
 
         </div>


        </div>

        <div class="col-md-9">
            <div id="messages" class="border rounded bg-light p-3 mb-2 mt-3"  style="overflow-y: scroll; height:400px;"></div>
            
            <form id="message-form" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-12">
                  <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-text"></div>
                    <textarea type="text" class="form-control" name="body" id="body" placeholder="message.."></textarea>
                  </div>
                </div>
              
                
              
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </form>

        </div>

   
    </div>
</div>


@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
function timeSince(date) {

var seconds = Math.floor((new Date() - date) / 1000);

var interval = seconds / 31536000;

if (interval > 1) {
  return Math.floor(interval) + " years";
}
interval = seconds / 2592000;
if (interval > 1) {
  return Math.floor(interval) + " months";
}
interval = seconds / 86400;
if (interval > 1) {
  return Math.floor(interval) + " days";
}
interval = seconds / 3600;
if (interval > 1) {
  return Math.floor(interval) + " hours";
}
interval = seconds / 60;
if (interval > 1) {
  return Math.floor(interval) + " minutes";
}
return Math.floor(seconds) + " seconds";
}
 classroomId = "{{$classroom->id }}";
        (function($){
            function getMessages(page = 1){
                $.ajax({
                    method: "get",
                    url: "{{route('classrooms.messages.index',[$classroom->id,'page=1'])}}",
                    success: function (response) {
                        for (let i in response.data) {
                            let message = response.data[i];
                            addMessage(message,true)
                        } 
                    },
                    
                });
            }

            function addMessage(message,prepend = false){
                let html = `
                    <div class="bg-info rounded p-2 mt-2 ">
                        <div>
                            <b>${message.sender.name}</b> - <span class="text-muted">${message.sent_at}</span> 
                        </div>

                        <div>
                            ${message.body}    
                        </div>
                    </div>`;
                    if(prepend){
                        return $('#messages').prepend(html);
                    }
                    $('#messages').append(html);
                    const element = document.getElementById("messages");
                    element.scrollTop = element.scrollHeight;
            }


            function send(message) { 
                console.log(message);
                $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('classrooms.messages.store',[$classroom->id]) }}",
                processData: false,
                contentType: false,
                type: 'post',
                data: JSON.stringify({
                             body: message,
                         }),              
                 contentType: 'application/json',
                
                
                success: function (data){
                    addMessage({
                        'sender': {name:"{{Auth::user()->name}}"},
                        'body':message,
                        'sent_at':"{{now()->diffForHumans()}}"
                },
                
                )
                }
            });

          /*       $.post("{{ route('classrooms.messages.store',$classroom->id) }}", {
                    _token : "{{csrf_token()}}",
                    body: message
                },
                function (data, textStatus, jqXHR) {
                    addMessage({
                        'sender': "{{Auth::user()->name}}",
                        'body':message,
                        'sent_at':(new Date)
                },
                )
                 // location.reload();      
                },
                ); */
             }

             $("#message-form").on('submit',function(e){
                e.preventDefault();
                let message = $("#body").val();
                send(message);
                $("#body").val('');
             });

             $(document).ready(function(){
                getMessages()
                setTimeout(() => {
                    console.log("asd");
                    const element = document.getElementById("messages");
                    element.scrollTop = element.scrollHeight;
                }, 1000);
              
 
                //$("#messages").scrollTop($("#messages")[0].scrollTop);

              //  $("#messages").scrollTop(30);
             })
        })(jQuery);

      
</script>


@endpush