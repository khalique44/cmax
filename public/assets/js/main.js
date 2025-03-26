
function formatDate(date,format)
    {
        format = (typeof format !== 'undefined') ? format : 'dd/mm/yyyy';
        //date = new Date(d)
        var dd = date.getDate(); 
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear(); 
        if(dd<10){dd='0'+dd} 
        if(mm<10){mm='0'+mm};
        if(format == 'dd/mm/yyyy'){
            return d = dd+'/'+mm+'/'+yyyy;
        } else if(format == 'yyyy/mm/dd'){
            return d = yyyy+'/'+mm+'/'+dd;
        }
    }

function showAjaxLoader(){
    $("#loader").show();
    $("#loader").removeClass('hidden');
}

function hideAjaxLoader(){
    $("#loader").hide();
    $("#loader").addClass('hidden');
}

var datePicker = '';
function loadDatePicker(available_dates){
 // available_dates = (JSON.parse((available_dates)));
  $("div#datepicker2").datepicker({

    todayHighlight:true,
    startDate:'now',
    format: "dd/mm/yyyy",
    default: 'dd/mm/yyyy',
    autoclose: true,
    weekStart: 1,
    language : 'sw'
    /*beforeShowDay: function(date){                           
      var formattedDate = formatDate(date);     
             
      if ($.inArray(formattedDate.toString(), (available_dates)) == -1){
        return {
            enabled : false
        };
      }
      return;      
    }*/
  });
}

$(document).on('changeDate',"div#datepicker2", function(e) {
    var selectedDate = e.format(0,"dd/mm/yyyy");
    $("input.booking_date").val(selectedDate);
    var laundry_number = $("select.laundry_number").val();
    //var selectedDateHidden = e.format(0,"yyyy/mm/dd");
    //$("input.hidden_booking_date").val(selectedDateHidden);
    ajaxPostRequest("/laundry_booking/get_timeslots",{ 'selectedDate':selectedDate,laundry_number:laundry_number },successCallback,true);
    
});

//Är du säker på att du vill ta bort din bild?
function ajaxPostRequest(url,data,successCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="home_url"]').attr('content')+url,
        data: data,
        
        beforeSend: function() {
            showAjaxLoader();
        }
    }
    var extraParams  = {
           datatype: "json"

        }

    if(!isJson){
     
     var extraParams  = {
            contentType: false,
            cache: false,
            processData: false,
        }

    

    }

    ajaxParams = Object.assign(extraParams,ajaxParams);

    $.ajax(ajaxParams)
    .done(successCallback)
    .fail( function( reason ) {
          // Handles errors only
    })
    .always(function(){
     
      hideAjaxLoader();
    });
}


function successCallback(response) {     
    $('select.booking_time').html(response.html); 
}



$(document).on('click','button.book_new_time',function(e){
    e.preventDefault();
    var booking_time = $('select.booking_time').val();
    var booking_date = $('input.booking_date').val();
    var laundry_number = $('select.laundry_number').val();
    var data = {booking_time:booking_time,booking_date:booking_date,laundry_number:laundry_number};
    ajaxPostRequest("/laundry_booking",data,bookingCallback,true);
});

$(document).on("change","select.laundry_number",function(){
    var laundry_number = $(this).val();
    if(laundry_number !== ''){
       $("#datepicker2 td.active.day").trigger("click");
    }
});

function bookingCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';
    if(response.success){
        msgType = 'success'; 
        setTimeout(function(){ 
            $(".close_booking_form").trigger('click');
            location.reload();
        },3000);
    }

    if(typeof response.errors !== 'undefined'){
        $(response.errors).each(function(i,o){
             displayMsg(msgArea,o,msgType);
        })
    }else{
        displayMsg(msgArea,response.msg,msgType);
    }

   
}

$(document).on('click','button.remove_booking',function(e){
    e.preventDefault();
    var booking_id = $(this).data('id'); 
    $(".data-delete-form").attr('action', $('meta[name="home_url"]').attr('content')+"/laundry_booking/"+booking_id);      
});

$(document).on('click','a.remove_issue',function(e){
    e.preventDefault();
    var issue_id = $(this).data('id'); 
    $(".data-delete-form").attr('action', $('meta[name="home_url"]').attr('content')+"/report-issue/"+issue_id);      
});

$(document).on('click','button.btn_delete_attachment',function(e){
    e.preventDefault();
    var attachment_id = $(this).data('delete-id'); 
    $(".data-delete-form").attr('action', $('meta[name="home_url"]').attr('content')+"/report-issue/remove_attachment/"+attachment_id);      
});

function displayMsg(msgArea, msg, msgType){


    if(typeof msgType == 'undefined'){

        msgType = 'danger';
    }

    msgType = (msgType == 'error') ? 'danger' : msgType;

    if(jQuery('.custom-msg-area').length > 0){

        jQuery('.custom-msg-area').remove();

    }

    if(msgArea.length > 0){

        msgArea.html('<div class="alert alert-'+msgType+'" role="alert">'+msg+'</div>').show();
        $('html, body').animate({ scrollTop: msgArea.offset().top}, 100);

    }

}


$(document).on("submit","form#report-issue-form",function(e){
    e.preventDefault();
    var issue_id = $(this).data("id");
    issue_id = (typeof issue_id !== 'undefined') ? '/'+issue_id : '';
    var formData = new FormData(this);   
    ajaxPostRequest("/report-issue"+issue_id,formData,reportIssueCallback);    

});



function reportIssueCallback(response){
    var  msgArea = $('.ajax-msg');
    var msgType = 'error';
    if(response.success){
        msgType = 'success'; 
        $("form#report-issue-form")[0].reset();
        setTimeout(function(){            
            location.reload();
        },3000);
    }

    if(typeof response.errors !== 'undefined'){
        $(response.errors).each(function(i,o){
             displayMsg(msgArea,o,msgType);
        })
    }else{
        displayMsg(msgArea,response.msg,msgType);
    }
}



$(document).on('click', 'a.display-messages',function(e){   
    e.preventDefault();
    ajaxPostRequest("/users/get-messages",[],messagesCallback);
});

function messagesCallback(response){
    var  msgArea = $('.ajax-msg');
    if(response.success){

        $("ul.display-messages-area").html(response.html);
        $("#messagelighting").modal('show');

    }else{

        displayMsg(msgArea,response.msg);
    }
}

$(document).on('submit', 'form#add-comments',function(e){  
    e.preventDefault(); 
    var issue_id = $(this).data("id");
    var is_done = $(this).find("input.is_done:checked").val();
    is_done = typeof is_done !== 'undefined' ? is_done : 0;
    var comments = $(this).find("textarea.comments").val();
    var data = {is_done:is_done,comments:comments};

    ajaxPostRequest("/report-issue/add-comment/"+issue_id,data,addCommentCallback,true);
});

function addCommentCallback(response){
    var  msgArea = $('.ajax-msg');
    var msgType = 'error';
    if(response.success){
        msgType = 'success'; 
        $("form#add-comments")[0].reset();
        setTimeout(function(){            
            location.reload();
        },3000);
    }

    if(typeof response.errors !== 'undefined'){
        $(response.errors).each(function(i,o){
             displayMsg(msgArea,o,msgType);
        });
    }else{
        displayMsg(msgArea,response.msg,msgType);
    }
}



$(document).on('submit', 'form#edit-comments',function(e){  
    e.preventDefault(); 
    var issue_id = $(this).data("id");
    var comment_id = $(this).data("comment-id");   
        var comments = $(this).find("textarea.edit_comments").val();
    var data = {comments:comments,comment_id:comment_id};

    ajaxPostRequest("/report-issue/edit-comment/"+issue_id,data,editCommentCallback,true);
});

function editCommentCallback(response){
    var  msgArea = $('.edit-ajax-msg');
    var msgType = 'error';
    if(response.success){
        msgType = 'success'; 
        //$("form#edit-comments")[0].reset();
        setTimeout(function(){            
            location.reload();
        },2000);
    }

    if(typeof response.errors !== 'undefined'){
        $(response.errors).each(function(i,o){
             displayMsg(msgArea,o,msgType);
        });
    }else{
        displayMsg(msgArea,response.msg,msgType);
    }
}

$(document).on("change","select[name=full_name]",function(){
 var email = ($(this).find(':selected').data('email'));  
    var phone = ($(this).find(':selected').data('phone'));
    $("input[name='phone']").val(phone);
    $("input[name='email']").val(email);
});

jQuery(function(){
    $('#laundry-booking-table').DataTable({
        language : {
            "zeroRecords": " "             
        },
        "order":  [],
        "pageLength": 100,
        bFilter: false, 
        bInfo: false,
        "bLengthChange": false,
        "bPaginate": false,
        "ordering": false
        //"rowReorder": true
    });


    $(document).on('click','.choose-file-area',function(){
        $("#attachment").trigger('click');
    })
})
$(document).ready(function(){
    $("#attachment").change(function(ths) {
       // try{
             filename = this.files[0].name;

             if(typeof filename !== 'undefined' && filename !== ''){
                $(".show-fake-file-name").text(filename)
            }else{
                $(".show-fake-file-name").text('Ingen bild vald')
            }
        
             
        //}catch(e){
             //
        //}
        
    });
});