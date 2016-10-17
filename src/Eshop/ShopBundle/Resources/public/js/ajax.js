$(document).ready(function () {
   $(document).on('click', '#ajax-delete', function() {
       var ajaxItem = $(this).parents('.ajax-item');
       $.ajax({
           url: $(this).attr('ajax-path'),
           type: 'POST',
           data: {
               id: $(this).attr('ajax-id')
           },
           success: function (data) {
               if (data.success) {
                   ajaxItem.remove();
                   console.log(data.success);
               }
           },
           error: function (data) {
               data = JSON.stringify(data);
               data = JSON.parse(data);
               console.log(data);
           }
       });

       return false;
   });
});