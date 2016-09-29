var text;
$(document).ready(function() {
    $(document).tooltip({
        items: "td.person_name",
        position: {
            at: "center top"
        },
        content: function(callback) {
            var element = $(this);
            var employee = element.attr('employee');
            $.ajax({
                url: document_root + 'admin/Assignations/ajaxBubble',
                data: {employee: employee},
                async:false,
                method: "POST",
                dataType: 'json', // Choosing a JSON datatype
                success: function(response) {
                    callback(response.view);
                }
            });
        }
    });
});
