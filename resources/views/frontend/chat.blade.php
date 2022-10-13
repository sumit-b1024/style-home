@extends('layouts.frontend')
@section('content')
<?php
use App\Models\QuizAnswer;
?>
<style>
.container {
max-width: 1170px;
margin: auto;
}

img {
max-width: 100%;
}

.inbox_people {
background: #f8f8f8 none repeat scroll 0 0;
float: left;
overflow: hidden;
width: 40%;
border-right: 1px solid #c4c4c4;
}

.inbox_msg {
border: 1px solid #c4c4c4;
clear: both;
overflow: hidden;
}

.top_spac {
margin: 20px 0 0;
}


.recent_heading {
float: left;
width: 40%;
}

.srch_bar {
display: inline-block;
text-align: right;
width: 60%;
padding:
}

.headind_srch {
padding: 10px 29px 10px 20px;
overflow: hidden;
border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
color: #05728f;
font-size: 21px;
margin: auto;
}

.srch_bar input {
border: 1px solid #cdcdcd;
border-width: 0 0 1px 0;
width: 80%;
padding: 2px 0 4px 6px;
background: none;
}

.srch_bar .input-group-addon button {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
padding: 0;
color: #707070;
font-size: 18px;
}

.srch_bar .input-group-addon {
margin: 0 0 0 -27px;
}

.chat_ib h5 {
font-size: 15px;
color: #464646;
margin: 0 0 8px 0;
}

.chat_ib h5 span {
font-size: 13px;
float: right;
}

.chat_ib p {
font-size: 14px;
color: #989898;
margin: auto
}

.chat_img {
float: left;
width: 11%;
}

.chat_ib {
float: left;
padding: 0 0 0 15px;
width: 88%;
}

.chat_people {
overflow: hidden;
clear: both;
}

.chat_list {
border-bottom: 1px solid #c4c4c4;
margin: 0;
padding: 18px 16px 10px;
}

.inbox_chat {
height: 550px;
overflow-y: scroll;
}

.active_chat {
background: #ebebeb;
}

.incoming_msg_img {
display: inline-block;
width: 70px;
padding-left: 10px;
padding-top: 10px;
}

.received_msg {
display: inline-block;
padding: 0 0 0 10px;
vertical-align: top;
width: 92%;
}

.received_withd_msg p {
background: #ebebeb none repeat scroll 0 0;
border-radius: 3px;
color: #646464;
font-size: 14px;
margin: 0;
padding: 20px 20px 20px 20px;
width: 100%;
}

.time_date {
color: #747474;
display: block;
font-size: 12px;
margin: 8px 0 0;
}

.received_withd_msg {
width: 57%;
}

.mesgs {
float: left;
padding: 0px 0px;
width: 100%;
}

h3.text-center {
padding: 20px;
color: #fff;
background: #0078E1;
margin: 0 0 30px;
text-align: left !important;
}

.sent_msg p {
background: #0078E1 none repeat scroll 0 0;
border-radius: 3px;
font-size: 14px;
margin: 0;
color: #fff;
padding: 20px;
width: 100%;
}

.outgoing_msg {
overflow: hidden;
margin: 26px 0 26px 0px;
display: inline-flex;
align-items: center;
justify-content: flex-end;
width: 100%;
}

.sent_msg {
float: right;
width: 46%;
}

.input_msg_write input {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
color: #4c4c4c;
font-size: 15px;
min-height: 48px;
width: 100%;
}

.type_msg {
border-top: 1px solid #c4c4c4;
position: relative;
width: 97%;
margin: 10px 10px;
}

.msg_send_btn {
background: #0078E1 none repeat scroll 0 0;
border: medium none;
border-radius: 50%;
color: #fff;
cursor: pointer;
font-size: 17px;
height: 46px;
position: absolute;
right: 6px;
top: 5px;
width: 8px;
padding-top: 0px;
padding-right: 35px;
padding-bottom: 0px;
padding-left: 20px;
}

.messaging {
background: #f6f6f6;
}

.msg_history {
height: 516px;
overflow-y: auto;
}

.input_msg_write textarea {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
color: #2a2a2a;
font-size: 15px;
width: 86%;
height: 60px;
line-height: 1.8;
margin-left: 60px;
}

.outgoing_msg img.avatar {
width: 50px;
margin-bottom: 20px;
margin-right: 10px;
}

button.attch {
position: absolute;
padding: 10px 10px;
margin-top: 5px;
cursor: pointer;
background: #0078E1;
}

</style>
<!--<section class="banner_inner">
<div class="bannerParallax_inner"></div>
</section>-->
<section class="designer_cont project_main tittle_no_banner">

@if(session()->has('success'))
<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
@endif
	<h4>{{@$page_title->title}}</h4>
	<div class="container">
    <div class="messaging">
        <div class="inbox_msg">
            <h3 class=" text-center">Customer Chat with Designer</h3>

            <div class="mesgs">
                <div class="msg_history">

                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <button onclick="$('#attachment').click()" class="attch" type="button"><img src="{{asset('/public/images/chat-uploaded.png')}}" alt="uploaded-icon" width="30" srcset=""></button>
                        <input style="display:none;" id="attachment" type="file" name="attachment"/>
                        <textarea id="w3mission" rows="4" cols="50" placeholder="{{__('Type a message')}}"></textarea>
                        <button class="msg_send_btn" id="send" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-danger">The attachment may not be greater than 10 MB.</p>
</div>
@extends('layouts.modal')
 </section>
 <?php
 $user=auth()->user();
 if(!empty($user)){
     $customer_name = $user->first_name." ".$user->last_name;
 }
 else{
     $customer_name="";
 }
 ?>
 <div class="flashBannerCont">
     <div class="container">
	 <div class="row">
         <div class="flashBanner">
             <h2>Learn more about our Design packages</h2>
             <button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>
             </div>
             </div>
             </div>
             </div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
(function($) {
  var upload_in_progress=false;
  $("#attachment").change(function(e){
    if(upload_in_progress)
    {
      alert('{{__("upload already in progress")}}');
      $(this).val("");
    }
    upload_in_progress=true;
    $('.mesgs').css("opacity", "0.5");
    let formData = new FormData($('#header_image_frm')[0]);
        let file = $(this)[0].files[0];

        formData.append('attachment', file, file.name);
        formData.append('user_id', {{$model->userId}});
        formData.append('project_id', {{$model->id}});
        $.ajax({
            url: '{{ route("frontend.chat.upload") }}',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function(data) {
              $("#attachment").val("");
              upload_in_progress=false;
                console.log(data);
                $('.mesgs').css("opacity", "");
                if(data.status=='NOK')
                {
                  $("#attachment").val("");
                  alert(data.message);
                }
            },
            error: function(data) {
              $("#attachment").val("");
              $('.mesgs').css("opacity", "");
              upload_in_progress=false;
                console.log(data);
            }
        });



  });
   })(jQuery);

    function appendChat(e) {
        var id = e.target.id;
        //variables for testing, you could have all of the
        //comparisons in the 'if' statement, just using these to
        //make the 'if' statement more clear
        var notEmpty = $(".usertext").val() != ""
            , isEnterKeypress = e.type == "keypress" && e.keyCode == 13
            , isSendClick = e.type == "click" && id == "send";
        //alert(isSendClick);
        var flag=false;
        $( "#send" ).click(function() {
          flag=true;
        });
        if (notEmpty && (isEnterKeypress || isSendClick || flag)) {

            var msg1 = $("#w3mission").val();
            //alert(msg1);
            sendMsg(msg1);
            $("#w3mission").val(" ");
            e.preventDefault();

        }
    }

    function sendMsg(msg) {
    //alert('send call');

        $.ajax({
            type: "post"
            , url: "{{route('frontend.sendMessage')}}"
            , data: {
                "_token": "{{ csrf_token() }}"
                , "message": msg,"user_id":{{$model->userId}},"project_id":{{$model->id}}
            }
            , success: function(data) {
                //do something with response data
            }
        });



    }

    (function($) {
    var last_msg_id = 0;
    setInterval(function() {
        $.ajax({
            type: "get"
            , url: "{{route('frontend.chat.get')}}"
            , data: {
                message_id: last_msg_id,
                "user_id":{{$model->userId}},
                "project_id":{{$model->id}}
            }
            , success: function(data) {
                var msgPopulated = false;
                $(data.data).each(function(i, d) {
                    if (d.msg_status == 'sent' && d.id > last_msg_id) {
                        msgPopulated = true;
                        last_msg_id = d.id;
                        var html = `<div class="outgoing_msg"><div class="outgoing_msg_img">
						 <div class="incoming_msg_img"><img src="{{asset('public/backend/images/admin_avatar.jpg')}}" alt="Avatar" class="avatar"><p>{{$customer_name}} </p>
						</div></div>

      <div class="sent_msg">
        <p>${d.message}</p>
        <span class="time_date"> ${d.timestamp} </span> </div>
    </div>`;

                        $(".msg_history").append(html);


                    } else
                    if (d.msg_status == 'recieved' && d.id > last_msg_id) {
                        msgPopulated = true;
                        last_msg_id = d.id;
                        var html = `<div class="incoming_msg">
      <div class="incoming_msg_img"> <img src="{{asset('public/backend/images/admin_avatar.jpg')}}" alt="Avatar" class="avatar"><p>{{$model->first_name}} {{$model->last_name}}</p> </div>
      <div class="received_msg">
        <div class="received_withd_msg">
          <p>${d.message}</p>
          <span class="time_date">${d.timestamp}</span></div>
      </div>
    </div>`;
                        $(".msg_history").append(html);


                    }
                });
                if (msgPopulated) {
                    $(".msg_history").animate({
                        scrollTop: 1000000
                    }, 1000);
                }
            }
        });
    }, 2000);

    })(jQuery);


    $("#send").click(appendChat);
    $("#w3mission").keypress(appendChat);

</script>

 @endsection
