var deleteCampaign=false;
$(document).ready(function() {
   //Partial solution
    $(document).on("click", "#start_date", function() {
        $("#start_date").datepicker(
                {
                    dateFormat: "dd-mm-yy"
                });
    });
    
    $(document).on("click", "#end_date", function() {
        $("#end_date").datepicker(
                {
                    dateFormat: "dd-mm-yy"
                });
    });

    $(document).on("click", ".edit_campaign", function(event) {
        event.preventDefault();
        edit_campaign($(this));
    });
    $(document).on("click", ".update_campaign", function(event) {
        event.preventDefault();
        update_campaign();
    });
    
     $(document).on("click", ".delete_campaign", function(event) {
        event.preventDefault();
        delete_campaign($(this).attr('id'));
    });
    
    $(document).on("click", "button.btn.btn-primary", function () {
        deleteCampaign = true;
        console.log('OK clicked');
    });
    
   getModal();
});
function getModal(){
     $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        var campaign=button.data('campaignid');
        console.log(campaign);
        modal.find('#campaign-name').text(button.data('campaign'));
        $('button.btn.btn-primary').attr('campaign', campaign);
    });
    
    $('#myModal').on('hidden.bs.modal', function (event) {
        if (deleteCampaign) {
            var okButton = $('button.btn.btn-primary');
            delete_campaign(okButton.attr('campaign'));
            deleteCompany = false;
        }
    });
}
function delete_campaign(id) {
    $.ajax({// ajax call starts
        url: document_root + 'admin/campaigns/delete',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            notification("Se ha eliminado la campa&ntilde;a", "error", "top");
            $("#dyn_content").html(data.view);
            getModal();
        }
    });
}

function edit_campaign(element) {
    var id = element.attr("id");
    $.ajax({// ajax call starts
        url: document_root + 'admin/campaigns/edit',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            //console.log(data.view); 
            $("#dyn_content").html(data.view);
        }
    });
}

function update_campaign() {
    var data = get_from_data();

    $.ajax({// ajax call starts
        url: document_root + 'admin/campaigns/update',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            console.log(data.status);
            $("#dyn_content").html(data.view);
            getModal();
            notification("Se ha actualizado la campa&ntilde;a", "success", "top");
        }
    });
}


function get_from_data() {
    var id = $('#id').val();
    var company = $('#company').val();
    var name = $('#name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var description = $("#description").val();

    var data = {id: id, name: name, company: company, start_date: start_date, end_date: end_date, description: description};
    console.log(data);
    return data;

}


function notification(text, type, layout) {
    var n = noty({
        layout: layout,
        type: type,
        text: text,
        closeWith: ['backdrop'],
        timeout: true,
        animation: {
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOutUp', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });

    setTimeout(function () {
        $.noty.close(n.options.id);
    }, 3000);
}

