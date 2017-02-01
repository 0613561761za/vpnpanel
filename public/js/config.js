$(document).ready(function(){
            $('#create').submit(function(event){
                event.preventDefault();
                var id = '{{@$server_id}}';
                var data = $('#create').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/create/' + id,
                    data: data,
                    beforeSend: function() {
                        $('#create :input').prop('disabled', true);
                        $('#btn-create').text('Please Wait.....');
                        $('#btn-create').attr('disabled', true);
                    },
                    success: function(data) {
                        console.log(data);
                        $('#create :input').prop('disabled', false);
                        $('#btn-create').text('Create!');
                        $('#btn-create').attr('disabled', false);

                        if(data.status == 'limited')
                        {
                            $('#username').val('');
                            $('#password').val('');
                            return swal("Whoops!", "Server has reached daily limit! Try again tomorrow!", "error");
                        }

                        swal("Success!", "Your account has been created!", "success")
                        document.getElementById('result').innerHTML = "<div class='alert alert-" + data.status + "' style='text-align: center;'>" 

                            + "USERNAME : " + data.username + "<br />"
                            + "PASSWORD : " + data.password + "<br />"
                            + "CREATED  : " + data.created  + "<br />"
                            + "EXPIRED  : " + data.expired  + "<br />"
                            + "<hr />"
                            + "<a href='" + data.config + "' class='btn btn-success' style='width: 100%'>Download VPN Config.</a>" +

                            "</div>";

                        $('#username').val('');
                        $('#password').val('');
                    },
                    error: function(data) {
                        $('#create :input').prop('disabled', false);
                        $('#username').val('');
                        $('#password').val('');
                        return swal("Whoops!", "Something error while processing your requests!", "error");
                    }

                });
            });
        }); 

$(document).ready(function(){
    $('#server-add').submit(function(event){
        event.preventDefault();
        var data = $('#server-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/server/add',
            data: data,
            beforeSend: function(){
                $('#server-add :input').prop('disabled', true);
                $('#btn-add-server').text('Please Wait......');
            },
            success: function(data){
                if(data.status == 'exists')
                {
                    $('#server-add :input').prop('disabled', false);
                    $('#server-add :input').val('');
                    $('#btn-add-server').text('Add!');
                    return swal("Whoops!", data.message, "error");
                }
               
                $('#server-add :input').prop('disabled', false);
                $('#server-add :input').val('');
                $('#btn-add-server').text('Add!');
                return swal("Success!", data.message, "success");

            },
            error: function(){
                return swal("Whoops!", "Something error while proccessing your request!", "error");
            }
        });
    });
});

$(document).ready(function(){
    $('#change-email').submit(function(event){
        event.preventDefault();
        var data = $('#change-email').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/account/setting',
            data: data,
            beforeSend: function(){
                $('#change-email :input').prop('disabled', true);
                $('#btn-change-email').text('Please Wait....');
            },
            success: function(data){
                if(data.status == 'error')
                {
                    $('#change-email :input').prop('disabled', false).val('');
                    $('#btn-change-email').text('Change!');
                    return swal('Whoops!', data.message, 'error');
                }
                $('#change-email :input').prop('disabled', false).val('');
                $('#btn-change-email').text('Change!');
                return swal('Success!', data.message, 'success');
            },
            error: function(data){
                console.log(data);
                swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});

$(document).ready(function(){
    $('#change-password').submit(function(event){
        event.preventDefault();
        var data = $('#change-password').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/account/setting',
            data: data,
            beforeSend: function(){
                $('#change-password :input').prop('disabled', true);
                $('#btn-change-password').text('Please Wait....');
            },
            success: function(data){
                if(data.status == 'error')
                {
                    $('#change-password :input').prop('disabled', false).val('');
                    $('#btn-change-password').text('Change!');
                    return swal('Whoops!', data.message, 'error');
                }
                $('#change-password :input').prop('disabled', false).val('');
                $('#btn-change-password').text('Change!');
                return swal('Success!', data.message, 'success');
            },
            error: function(data){
                console.log(data);
                swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});

function deleteServer(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This server will be deleted permanently!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true,
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({
            type: 'POST',
            url: '/manage/admin/server/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your server has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                swal("Error!!", "Undefined error detected!", "error");
            }
        });
      } else {
        swal("Cancelled!", "Your server is safe :)", "success");
      }
    });
}

function deleteVPN(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This VPN Account will be deleted permanently!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true,
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({
            type: 'POST',
            url: '/manage/admin/vpn/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your VPN Account has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                swal("Error!!", "Undefined error detected!", "error");
            },
        });
        

      } else {
        swal("Cancelled!", "Your VPN Account is safe :)", "success");
      }
    });
}
