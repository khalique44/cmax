
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
    var msgIcon = (msgType == 'error' || msgType == 'danger') ? 'error' : 'success';

    if(jQuery('.custom-msg-area').length > 0){

        jQuery('.custom-msg-area').remove();

    }

    if(msgArea.length > 0){

        msgArea.html('<div class="alert alert-'+msgType+'" role="alert">'+msg+'</div>').show();
        $('html, body').animate({ scrollTop: msgArea.offset().top}, 100);

        

    }

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: msgIcon,
        title: msg,
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });

}

function ajaxPostRequest(url,data,successCallback,ajaxErrorCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="admin_url"]').attr('content')+url,
        data: data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: successCallback,
        error: ajaxErrorCallback,
        
        beforeSend: function() {
            showAjaxLoader();
        }
    }
    var extraParams  = {
           datatype: "json"

        }

    /*if(!isJson){
     
     var extraParams  = {
            contentType: false,
            cache: false,
            processData: false,
        } 
    }

    ajaxParams = Object.assign(extraParams,ajaxParams);

    var moreParams = {
                        success: successCallback,
                        error: ajaxErrorCallback
                    }
    ajaxParams = Object.assign(moreParams,ajaxParams);*/
    $.ajax(ajaxParams)
    .always(function(){     
        hideAjaxLoader();
    });
}

function ajaxPostRequest2(url,data,successCallback,ajaxErrorCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="admin_url"]').attr('content')+url,
        data: data,    
        
        success: successCallback,
        error: ajaxErrorCallback,
        
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

    var moreParams = {
                        success: successCallback,
                        error: ajaxErrorCallback
                    }
    ajaxParams = Object.assign(moreParams,ajaxParams);
    $.ajax(ajaxParams)
    .always(function(){     
        hideAjaxLoader();
    });
}




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






/*-----CMAX----*/

$(document).on("submit","form#builder-form",function(e){
    e.preventDefault();    
    var frm = $('form#builder-form');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/builders",formData,builderSuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#builder-form-update",function(e){
    e.preventDefault();    
    var builder_id = $('input[name="builder_id"]').val();
    //var formData = $(this).serializeArray();
    var frm = $('form#builder-form-update');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/builders/"+builder_id,formData,builderSuccessCallback,ajaxErrorCallback,true);    

});

function builderSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#builder-form")[0].reset();
            FilePond.find(document.querySelector('#filepond')).removeFiles();
            $("#uploaded-preview").html('');

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}


$(document).on("submit","form#cmspages",function(e){
    e.preventDefault();   
    var pg_name = $(".pg_name").val();
    var frm = $('form#cmspages');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/cms-pages/"+pg_name,formData,cmsSuccessCallback,ajaxErrorCallback,true);    

});

function cmsSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){     

            displayMsg(msgArea,response.message,msgType);           

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}

$(document).on("submit","form#property-form",function(e){
    e.preventDefault();    
   
    var formData = $(this).serializeArray();
    ajaxPostRequest("/properties",formData,propertySuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#property-form-update",function(e){
    e.preventDefault();    
    var id = $('input[name="property_id"]').val();
    var formData = $(this).serializeArray();
    ajaxPostRequest("/properties/"+id,formData,propertySuccessCallback,ajaxErrorCallback,true);    

});

function propertySuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#property-form")[0].reset();
            FilePond.find(document.querySelector('#filepond')).removeFiles();
            $("#uploaded-preview").html('');

            if(response.project_id){
                location.reload();
            }

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}




$(document).on("submit","form#project-form",function(e){
    e.preventDefault(); 

    var frm = $('form#project-form');
    var formData = new FormData(frm[0]);   

    ajaxPostRequest("/projects",formData,projectSuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#project-form-update",function(e){
    e.preventDefault();    
    var id = $('input[name="project_id"]').val();
    var frm = $('form#project-form-update');
    var formData = new FormData(frm[0]); 
    ajaxPostRequest("/projects/"+id,formData,projectSuccessCallback,ajaxErrorCallback,true);    

});

function projectSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#project-form")[0].reset();
            FilePond.find(document.querySelector('.filepond')).removeFiles();
            $(".uploaded-images").html('');
            if(response.project.id){
                document.location=window.cmax.adminUrl+"/projects/"+response.project.id+"/edit";
            }

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}


function ajaxErrorCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if (response.responseJSON && response.responseJSON.errors){
        let errors = response.responseJSON.errors;       
        let html = '<ul >';
        $.each(errors, function (key, value) {
            html += `<li>${value[0]}</li>`;
        });
        html += '</ul>';
        displayMsg(msgArea,html,msgType);         
        
    }else{

        displayMsg(msgArea,'Server Error!',msgType);
    }
}

$(document).on("change","select#area_id",function(e){
    e.preventDefault();    
    var area_id = $(this).val();

    //var formData = new FormData(frm[0]); 
    ajaxPostRequest("/get-sub-area/"+area_id,[],subAreaSuccessCallback,ajaxErrorCallback,true);    

});

function subAreaSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 

        $('select#sub_area_id').empty();

        // Add placeholder again if needed
        $('select#sub_area_id').append('<option value=""></option>');
        
   
        response.subAreas.forEach(function(item){
           
             $('select#sub_area_id').append(new Option(item.name, item.id, false, false));
        });

        $('select#sub_area_id').trigger('change');

        //$('select#sub_area_id').html(options).show();

    }else{

         displayMsg(msgArea,response.message,msgType);
    }
}


FilePond.registerPlugin(
    //FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType
);

// Create pond instance
FilePond.setOptions({
        allowMultiple: false,
        maxFileSize: '10MB',
        acceptedFileTypes: ['image/*'],
        server: {
            process: {
                url: '/admin/media/upload',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                onload: function (res) { 
                    console.log(res)
                    const data = JSON.parse(res);
                    var preview_id = 'uploaded-preview';
                    if(data.mediaKey == 'project_gallery'){
                        preview_id = 'gallery-preview';
                    } else if(data.mediaKey == 'payment_plan'){
                        preview_id = 'payment-preview';
                    } else if(data.mediaKey == 'project_progress'){
                        preview_id = 'project-progress-preview';
                    }

                    const inputElement = document.getElementById(preview_id); // Works now

                    if (!inputElement) return; // Just in case

                    const collection = inputElement.dataset.collection || 'default';

                    // Hidden input
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = `media_ids[${collection}][]`;
                    hidden.value = data.id;
                    inputElement.closest('form').appendChild(hidden);

                    // Preview container
                    const previewContainerId = inputElement.dataset.preview;
                    if (previewContainerId) {
                        const container = document.getElementById(previewContainerId);
                        if (container) {
                            const wrapper = document.createElement('div');
                            wrapper.classList.add('preview-box');
                            wrapper.dataset.mediaId = data.id;

                            const img = document.createElement('img');
                            img.src = data.url.replace("storage", "storage/app/public");

                            const removeBtn = document.createElement('span');
                            removeBtn.classList.add('remove-media');
                            removeBtn.innerText = 'Remove';

                            /*removeBtn.onclick = function () {
                                wrapper.remove();
                                const hiddenInputs = document.querySelectorAll(`input[name="media_ids[${collection}][]"][value="${data.id}"]`);
                                hiddenInputs.forEach(i => i.remove());
                            };*/

                            const thumb = document.createElement('div');
                            thumb.classList.add('media-thumb');
                            thumb.appendChild(img);

                            const actions = document.createElement('div');
                            actions.classList.add('media-remove');
                            actions.appendChild(removeBtn);

                            wrapper.appendChild(thumb);
                            wrapper.appendChild(actions);
                            container.appendChild(wrapper);
                        }
                    }

                    return data.id;
                }
            },
            revert: {
                url: '/admin/upload-temp-revert',
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }
        },

        onremovefile: (file,file2, file3) => {
            /*var mediaId = file2.source;
            if(typeof mediaId === 'number' && !isNaN(mediaId) && mediaId !== null){
                console.log(mediaId);
                document.querySelector(`.remove-media[data-media-id="${mediaId}"]`)?.remove();
                addDeletedFile(mediaId);
            }*/
                       
        }

        
});

FilePond.parse(document.body);


function addUploadedFile(filePath) {
        const field = document.getElementById('uploaded-files');
        let val = field.value ? JSON.parse(field.value) : [];
        val.push(filePath);
        field.value = JSON.stringify(val);
}

function addDeletedFile(mediaId) {
    const field = document.getElementById('deleted-files');
    let val = field.value ? JSON.parse(field.value) : [];
    val.push(mediaId);
    field.value = JSON.stringify(val);
}


function deleteUploadedFile(mediaId){

        // Send request to delete the media file
        fetch(`/admin/media/${mediaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            //console.log('Media deleted:', data);
        })
        .catch(err => {
            console.error('Error deleting media:', err);
        });
    

}

$(document).on('click', 'span.remove-media', function(){
    var mediaId = $(this).parents('.preview-box').data('media-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "The media will be deleted after you save the record.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            if(typeof mediaId === 'number' && !isNaN(mediaId) && mediaId !== null){
                
                addDeletedFile(mediaId);
                $(this).parents('.preview-box').remove();
            }
        }
    });
    
});


$(document).on("change", "select#property_type", function(){

    if($(this).val() == 'home'){

        $(".category-home").show();
        $(".amenity-home").show();
        $(".amenity-plot").hide();
        $(".amenity-commercial").hide();
        $(".category-commercial").hide();

    }else if($(this).val() == 'plot'){

        $(".amenity-plot").show();
        $(".category-plot").show();
        $(".amenity-home").hide();
        $(".category-home").hide();
        $(".amenity-commercial").hide();
        $(".category-commercial").hide();


    }else if($(this).val() == 'commercial'){

        $(".amenity-commercial").show();
        $(".category-commercial").show();
        $(".amenity-plot").hide();
        $(".amenity-home").hide();
        $(".category-plot").hide();
        $(".category-home").hide();
        
    }

});

function renderStatusBadge(is_active) {
    if (is_active === 1) {
        return '<span class="badge bg-success">Active</span>';
    } else {
        return '<span class="badge bg-danger">Inactive</span>';
    }
}


$(document).on("click",".updateStatus",function(e){
    e.preventDefault();
    var project_id = $(this).data("id");
    var status = $(this).data("status");
    var status_type = $(this).data("status-type");
    var status_label = $(this).data("status-label");
    
    let $badge = $(this).children('.badge');
    var msgArea = '';
    showAjaxLoader();
    $.ajax({
        url: "/admin/project/update-status",
        type: "GET",
        data: {project_id:project_id,status:status,status_type:status_type},
        success: function(response) {
            //console.log(response.status);
            if(response.status == 'success'){
                console.log($(this).children('.badge'));
                

                if ($badge.hasClass('bg-danger')) {
                    if(status_type == 'is_active' ){
                        status_label = 'Active';
                        
                    }else{
                        status_label = 'Yes';
                        
                    }
                    status = 1;
                    $badge.removeClass('bg-danger').addClass('bg-success').text(status_label);
                   
                } else {
                    if(status_type == 'is_active' ){
                        status_label = 'Deactive';
                        
                    }else{
                        status_label = 'No';
                       
                    }
                    status = 0;
                    $badge.removeClass('bg-success').addClass('bg-danger').text(status_label);
                }

                $(this).attr("data-status",status);
                $(this).attr("data-status-label",status_label);
                $(this).attr("title","Click to"+status_label);
                
                displayMsg(msgArea,response.message,'success');
                
            }
            hideAjaxLoader();
            
        },
        error: function(){
            displayMsg(msgArea,'Error occurred while updating status!','success');
        },
        always:function(){
            hideAjaxLoader();
        }
    });
});