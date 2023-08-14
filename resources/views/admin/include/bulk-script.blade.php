<script defer>
    var bulk_ids = [];
    $(document).on('change','.delete_Checkbox',function () {
        var id = $(this).val();
        if($(this).prop("checked") == true){
            var index = bulk_ids.indexOf(id);
            if (index === -1) {
                    bulk_ids.push(id);
                    $('#bulk_ids').val(bulk_ids);   
                }
        }
        else if($(this).prop("checked") == false){
            bulk_ids = bulk_ids.filter(function(e) { return e !== id });
            $('#bulk_ids').val(bulk_ids);

            if($('.allChecked').is(":checked")){
                var oldChecked = $('#bulk_ids').val();
                $('.allChecked').prop('checked', false);
                $('#bulk_ids').val(oldChecked);
            }
        }
    });

    $(document).on('click', '.bulk-action', function (e) {
        
        e.preventDefault();
        var ids = $('#bulk_ids').val();
        var ids = ids.split(',');
        ids = ids.filter(function(id){
            return id != '';
        });

        let form = $(this).closest('form');
        var formData = new FormData();
        
        var value = $(this).data('value');
        var column = $(this).data('column');
        var action = $(this).data('action');
        let message = $(this).data('message');
        let title = $(this).data('title');
        let callback = $(this).data('callback');

        $(ids).each((index, element) => {
            formData.append('ids[]',element)
        });
        formData.append('action',action)
        formData.append('value',value)
        formData.append('column',column)


        $.confirm({
            draggable: true,
            title: title ?? 'Are You Sure!',
            content: message ?? "You won't be able to revert back!",
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Confirm',
                    btnClass: 'btn-red',
                    action: function(){
                        var response =  postData(form.attr('method'),form.attr('action'),'json',formData,callback,null,null);
                    }
                },
                    close: function () {
                }
            }
        });
    });

    String.prototype.rtrim = function() {
        return this.replace(/\s+$/,"");
    }

    $(document).on('click','.allChecked',function(){
        if($(this).prop("checked") == true){
            $('.delete_Checkbox').prop('checked',true);
            $('.delete_Checkbox').each(function(){
                var rec = $(this).val();
                if(jQuery.inArray(rec, bulk_ids) === -1){
                    bulk_ids.push(rec);
                }
            });
            $('#bulk_ids').val(bulk_ids);
        }else{
            $('.delete_Checkbox').prop('checked',false);
            bulk_ids = [];
            $('#bulk_ids').val(bulk_ids);
        }
    });

    function bulkDeleteCallback(response){
        if(typeof(response) != "undefined" && response !== null && response !== undefined && response.status == "success"){
            if(response.action == 'delete'){
                $(response.data).each(function( index,element ) {
                    if(element != '' || element != null){
                        $('#'+element).remove();
                        if($('.table >tbody >tr').length == 0){
                            $('.no-data').append('<tr><td class="text-center" colspan="8">No Data Found...</td></tr>');
                            $('.allChecked').prop('checked',false);
                        };
                    }
                });
                pushNotification(response.status,response.title,'success');
                bulk_ids = [];
            }           
        }else{
            pushNotification("Hands Up!","Atleast one row should be selected",'error');
            return false;
        }
    }

    function bulkColumnUpdateCallback(response){
        if(typeof(response) != "undefined" && response !== null && response !== undefined && response.status == "success"){
            $('.allChecked').prop('checked',false).change();
            $('.delete_Checkbox').prop('checked',false).change();
            for(var i = 0; i < response.data.length; i++) {
                $('.'+response.column+'-'+response.data[i]).html('<span class="badge badge-'+response.html.badge_color+'">'+response.html.badge_label+'</span>');
            }
            pushNotification(response.status,response.title,'success');
        }else{
            pushNotification("Hands Up!","Atleast one row should be selected",'error');
        }    
    }

</script>