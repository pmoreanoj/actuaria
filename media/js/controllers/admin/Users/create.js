$(document).ready(function() {
    $(document).on("change", "#type", function() {
     get_selection();
    });  
});

function get_selection(){
    var option =$("#type").val();
     $.ajax({// ajax call starts
            url: document_root + 'admin/users/ajaxGetSelection',
            data: {opt: option},
            method: "POST",
            dataType: 'json', // Choosing a JSON datatype
            success: function(data) {
                //console.log(data.view); 
                $("#extra_type").html(data.view);
            }
        });
}