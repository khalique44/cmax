
$(function(){
	$("select.select2").select2();
});

function showAjaxLoader(){
    $("#loader").show();
    $("#loader").removeClass('hidden');
}

function hideAjaxLoader(){
    $("#loader").hide();
    $("#loader").addClass('hidden');
}

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

function ajaxPostRequest(url,data,successCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="admin_url"]').attr('content')+url,
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


$(document).on("change","select.time-slot-month",function(){
    var month = $(this).val();
    var data = {month:month};
    var url = "/available_time_slots/get-days";
    ajaxPostRequest(url,data,successCallback,true);
});

function successCallback(response){
    if(response.success){
    	var targetObj = $("select.time-slot-days-dropdown");
    	targetObj.html(response.html);
    	if(targetObj.hasClass("edit-page")){
    		var val = targetObj.data("default-val");
    		var month = parseInt(targetObj.data("default-month"));
    		
	    	if(response.selected_month == month){
	    		//console.log(response.selected_month , month);
	    		targetObj.val(val);
	    	}
	    	
	    }
    }
}

function loadLaundryBookingChart(dataCount,xValuesRDGR){ 
        
    new Chart("myChart", {
      type: "bar",

      data: {
        labels: xValuesRDGR,
        datasets: [
            {
            label: 'Number of Bookings',  
            data: dataCount,
            borderColor: "blue",
            backgroundColor: "blue",
            fill: false
            }
        ]
      },
      options: {
        legend: {
                position:'bottom',
                align:'end',
                
            },
            scales: {
		      y: {
		        beginAtZero: true
		      }
		    }
      }
    });
}


function loadReportedIssues(dataCount,labels,type,colorCodes){

    var chart_type = (typeof type !== 'undefined') ? type : 'pie';	
    var label = 'Number of Issues';
    var id = "reportedIssues";

    if(chart_type !== 'pie'){
        label = 'Total Expense Amount';
        id = 'reportedIssuesExp';
    }
console.log(chart_type,label,id);
	new Chart(id, {
      type: chart_type,
      data: {
        labels: labels,
        datasets: [
            {
            label:  label,  
            data: dataCount,
            backgroundColor: 		      
            colorCodes
		   
            }
        ]
      },
      options: {
        legend: {
                position:'bottom',
                align:'end',
                
            },
            scales: {
		      y: {
		        beginAtZero: true
		      }
		    }
      }
    });


}

$(document).on("change","select#laundry_number",function(){
    var laundry_number = $(this).val();
    if(laundry_number !== ''){
       document.location = $('meta[name="admin_url"]').attr('content')+"/available_time_slots/?laundry_number="+laundry_number;
    }
});

$(document).on("change","select#laundry_number_create, select#laundry_number_edit",function(){
    var laundry_number = $(this).val();
    if(laundry_number !== ''){
       $("#datepicker td.active.day").trigger("click");
    }
});

var counter = 0;
$(document).on("click",".add-more-slots",function(e){
    e.preventDefault();
    counter++;
    var addMoreHtml = $(".selected-slots:eq(0)").html();
    $(".more-slots-area").append('<div class="remove_me_'+counter+'"><div class="">'+addMoreHtml+'<div class="col-xs-2"><button type="button" class="btn-sm btn-danger mt-30 remove-slots" data-id='+counter+' style="margin-top:30px; ">- Remove</button></div></div></div>');
    setTimeout(function(){ loadTimePicker() },100)
});


jQuery(document).on("click",".remove-slots",function(e){
    e.preventDefault();
    var removeDivId = jQuery(this).data("id");
    if(confirm("Are you sure want to remove this record?")){
      jQuery('.remove_me_'+removeDivId).remove();
    }
});

function loadTimePicker(){
    $('.time_from').timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '01',
            maxTime: '23',
            defaultTime: $("input.time_from").val(),
            startTime: '01',
            dynamic: false,
            dropdown: true,
            scrollbar: false
        });

    $('.time_to').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '01',
        maxTime: '23',
        defaultTime: $("input.time_to").val(),
        startTime: '01',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });
}