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
    $('#vpn-server-add').submit(function(event){
        event.preventDefault();
        var data = $('#vpn-server-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/server/add',
            data: data,
            beforeSend: function(){
                $('#vpn-server-add :input').prop('disabled', true);
                $('#btn-add-vpn-server').text('Please Wait.....');
            },
            success: function(data){
                if(data.status == 'exists')
                {
                    $('#vpn-server-add :input').prop('disabled', false);
                    $('#vpn-server-add :input').val('');
                    $('#btn-add-vpn-server').text('Add!');
                    return swal('Whoops!', 'Server with that\'s ip address is exists!', 'error');
                }

                $('#vpn-server-add :input').prop('disabled', false);
                $('#vpn-server-add :input').val('');
                $('#btn-add-vpn-server').text('Add!');
                return swal('Success!', 'Server successfully added!', 'success');
            },
            error: function(data){
                $('#vpn-server-add :input').prop('disabled', false);
                $('#vpn-server-add :input').val('');
                $('#btn-add-vpn-server').text('Add!');
                return swal('Whoops!', 'Something went wrong!', 'error');
            }
        });
    });
});

$(document).ready(function(){
    $('#ssh-server-add').submit(function(event){
        event.preventDefault();
        var data = $('#ssh-server-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/server/add',
            data: data,
            beforeSend: function(){
                $('#ssh-server-add :input').prop('disabled', true);
                $('#btn-add-ssh-server').text('Please Wait.....');
            },
            success: function(data){
                if(data.status == 'exists')
                {
                    $('#ssh-server-add :input').prop('disabled', false);
                    $('#ssh-server-add :input').val('');
                    $('#btn-add-ssh-server').text('Add!');
                    return swal('Whoops!', 'Server with that\'s ip address is exists!', 'error');
                }

                $('#ssh-server-add :input').prop('disabled', false);
                $('#ssh-server-add :input').val('');
                $('#btn-add-ssh-server').text('Add!');
                return swal('Success!', 'Server successfully added!', 'success');
            },
            error: function(data){
                $('#vpn-server-add :input').prop('disabled', false);
                $('#vpn-server-add :input').val('');
                $('#btn-add-vpn-server').text('Add!');
                return swal('Whoops!', 'Something went wrong!', 'error');
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

$(document).ready(function(){
    if($('#config').length){
        $('#both').hide();
        $(document).on('change', '#vpn-protocol', function(){
            if($('#vpn-protocol').val() == 'TCP&UDP'){
                $('#config,#config-label').hide();
                $('#both').fadeIn('slow', function(){
                    //complete
                });
            } else 
            {
                $('#both').hide();
                $('#config,#config-label').fadeIn('slow', function(){
                    //complete
                });
            }
        });
    }
});

$(document).ready(function(){
    $('#group-add').submit(function(event){
        event.preventDefault();
        var data = $('#group-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/server/group/add',
            data: data,
            beforeSend: function(){
                $('#group-add :input').prop('disabled', true);
                $('#btn-add-group').text('Please Wait.......');
            },
            success: function(data){
                $('#group-add :input').prop('disabled', false);
                $('#group-add :input').val('');
                $('#btn-add-group').text('Create!');
                return swal('Success!', data.messages, 'success');
            },
            error: function(data){
                $('#group-add :input').prop('disabled', false);
                $('#group-add :input').val('');
                $('#btn-add-group').text('Create!');
                return swal('Whoops!', 'Something went wrong!', 'error');
            },
        });
    });
});

function deleteGroup(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This Server Group will be deleted permanently!",
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
            url: '/manage/admin/server/group/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your Server Group has been deleted!", "success");
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

function deleteSSH(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This SSH Account will be deleted permanently!",
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
            url: '/manage/admin/ssh/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your SSHSSH Account has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                swal("Error!!", "Undefined error detected!", "error");
            },
        });
        

      } else {
        swal("Cancelled!", "Your SSH Account is safe :)", "success");
      }
    });
}

function deleteConfig(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This Config will be deleted permanently!",
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
            url: '/manage/admin/config/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your Config has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                swal("Error!!", "Undefined error detected!", "error");
            },
        });
        

      } else {
        swal("Cancelled!", "Your Config is safe :)", "success");
      }
    });
}

$(document).ready(function(){
    $('#site-setting').submit(function(event){
        event.preventDefault();
        var data = $('#site-setting').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/site/setting',
            data: data,
            beforeSend: function(){
                $('#site-setting :input').prop('disabled', true);
                $('#btn-site-setting').text('Please Wait......');
            },
            success: function(data){
                $('#site-setting :input').prop('disabled', false);
                $('#site-setting :input').val('');
                $('#btn-site-setting').text('Save!');
                return swal('Success!', 'Site setting successfully saved!', 'success');
            },
            error: function(data){
                $('#site-setting :input').prop('disabled', false);
                $('#site-setting :input').val('');
                $('#btn-site-setting').text('Save!');
                return swal('Whoops!', 'Something went wrong!', 'error');
            
            }
        })
    });
});

$(document).ready(function(){
    $('#create-ssh').submit(function(event){
        event.preventDefault();
        var id = $('#server_id').val();
        var data = $('#create-ssh').serialize();
        //alert(id);
        $.ajax({
            type: 'POST',
            url: '/ssh/create/' + id,
            data: data,
            beforeSend: function(){
                $('#create-ssh :input').prop('disabled', true);
                $('#btn-create-ssh').text('Creating......');
            },
            success: function(data){
                $('#create-ssh :input').prop('disabled', false);
                $('#create-ssh :input').val('');
                $('#btn-create-ssh').text('Create!');
                if(data.status == 'captcha_error'){
                    return swal('Whoops!', 'Captcha Validation Error!', 'error');
                }
                if(data.status == 'success'){
                    $('#ssh-result').append('<div class="alert alert-success">Congratulations! Your SSH Account successfully created!<br /> Username : <code>' + data.result.username + '</code> <br /> Password : <code>' + data.result.password + '</code> <br /> Create date : <code>' + data.result.created + '</code> <br /> Expired date : <code>' + data.result.expired + '</code> <br /> IP Address : <code>' + data.result.ip + '</code><br /> Host : <code>' + data.result.host + '</code> </div>');
                    return swal('Success!', 'Your SSH Account Created Successfully!', 'success');
                }
                if(data.status == 'exists') {
                    return swal('Whoops!', 'SSH Account With that\'s username already exists', 'error');
                }
            },
            error: function(data){
                $('#create-ssh :input').prop('disabled', false);
                $('#create-ssh :input').val('');
                $('#btn-create-ssh').text('Create!');
                return swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});
$(document).ready(function(){
    $('#create-vpn').submit(function(event){
        event.preventDefault();
        var id = $('#server_id').val();
        var data = $('#create-vpn').serialize();
        //alert(id);
        $.ajax({
            type: 'POST',
            url: '/vpn/create/' + id,
            data: data,
            beforeSend: function(){
                $('#create-vpn :input').prop('disabled', true);
                $('#btn-create-vpn').text('Creating......');
            },
            success: function(data){
                $('#create-vpn :input').prop('disabled', false);
                $('#create-vpn :input').val('');
                $('#btn-create-vpn').text('Create!');
                if(data.status == 'captcha_error'){
                    return swal('Whoops!', 'Captcha Validation Error!', 'error');
                }
                if(data.status == 'success'){
                    $('#vpn-result').append('<div class="alert alert-success">Congratulations! Your VPN Account successfully created!<br /> Username : <code>' + data.result.username + '</code> <br /> Password : <code>' + data.result.password + '</code> <br /> Create date : <code>' + data.result.created + '</code> <br /> Expired date : <code>' + data.result.expired + '</code> <br /> IP Address : <code>' + data.result.ip + '</code><br /> Host : <code>' + data.result.host + '</code> </div>');
                    return swal('Success!', 'Your VPN Account Created Successfully!', 'success');
                }
                if(data.status == 'exists') {
                    return swal('Whoops!', 'VPN Account With that\'s username already exists', 'error');
                }
            },
            error: function(data){
                $('#create-vpn :input').prop('disabled', false);
                $('#create-vpn :input').val('');
                $('#btn-create-vpn').text('Create!');
                return swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});

$(document).ready(function(){
    if($('#server-panel-list').length){
        $(document).on('change', '#server-panel-list',function(){
            if($('#server-panel-list').val() != 'Select Server'){
                var data = '_token=' + document.getElementsByTagName('meta')[3].content + '&server_host=' + $('#server-panel-list').val();
                $.ajax({
                    type: 'POST',
                    url: '/server/panel/checkservice',
                    data: data,
                    beforeSend: function(){
                        $('#panel-setting').html('');
                        $('#loading').fadeIn(1500);
                    },
                    success: function(data){
                        $('#loading').fadeOut(500);
                        var vpn = data.status.vpn.status;
                        var dropbear = data.status.dropbear.status;
                        var badvpn = data.status.badvpn.status;
                        var squid = data.status.squid.status;
                        var openssh = data.status.openssh.status;
                        
                        if(vpn == true)
                        {
                            var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-success'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(vpnpanel);
                        }
                        else if(vpn == false)
                        {
                           var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartvpn' onclick='restartvpn(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checkvpn' class='btn btn-success'>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(vpnpanel); 
                        }
                        else
                        {
                            var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(vpnpanel);
                        }

                        if(dropbear == true)
                        {
                            var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-success'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(dropbearpanel);   
                        }
                        else if(dropbear == false)
                        {
                            var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-danger'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartdropbear' onclick='restartdropbear(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning'>Fix/Restart</button> &nbsp; <button id='checkdropbear' class='btn btn-success'>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(dropbearpanel);  
                        }
                        else
                        {
                            var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-danger'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(dropbearpanel);
                        }

                        if(badvpn == true)
                        {
                            var badvpnpanel = $("<div class='col-md-6' id='badvpnpanel'> <div class='panel panel-success'> <div class='panel-heading'>BADVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(badvpnpanel); 
                        }
                        else if(badvpn == false)
                        {
                            var badvpnpanel = $("<div class='col-md-6' id='badvpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>BADVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartbadvpn' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checkbadvpn' class='btn btn-success'>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(badvpnpanel);
                        }
                        else
                        {
                            var badvpnpanel = $("<div class='col-md-6' id='badvpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>BADVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(badvpnpanel);
                        }

                        if(openssh == true)
                        {
                            var opensshpanel = $("<div class='col-md-6' id='opensshpanel'> <div class='panel panel-success'> <div class='panel-heading'>OPENSSH</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(opensshpanel); 
                        }
                        else if(openssh == false)
                        {
                            var opensshpanel = $("<div class='col-md-6' id='opensshpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENSSH</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartopenssh' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checkopenssh' class='btn btn-success' >Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(opensshpanel);
                        }
                        else
                        {
                            var opensshpanel = $("<div class='col-md-6' id='opensshpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENSSH</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(opensshpanel);
                        }

                        if(squid == true)
                        {
                            var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-success'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(squidpanel); 
                        }
                        else if(squid == false)
                        {
                            var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-danger'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartsquid' onclick='restartsquid(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checksquid' class='btn btn-success' >Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(squidpanel);
                        }
                        else
                        {
                            var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-danger'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                            $('#panel-setting').append(squidpanel);
                        }

                    },
                    error: function(data){
                        $('#loading').fadeOut(500);
                        return swal('Whoops!', 'Server Error Detected!', 'error');   
                    }
                })
            }
        })
    }
});

/*
 Server panel services.
*/

function restartdropbear(server,token)
{
    var data = '_token=' + token + '&server_host=' + server;
    $.ajax({
        type: 'POST',
        url: '/server/panel/restart/dropbear',
        data: data,
        beforeSend: function(){
            $('#dropbearpanel :input').prop('disabled', true);
            $('#restartdropbear').text('Restarting....');
        },
        success: function(data){
            $('#dropbearpanel :input').prop('disabled', true);
            $('#restartdropbear').text('Restarting....');
            var dropbear = data.status.dropbear.status;
            if(dropbear == false)
            {
                $('#dropbearpanel').fadeOut(1000,function(){
                    $('#dropbearpanel').remove();
                });
                var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-danger'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartdropbear' onclick='restartdropbear(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning'>Fix/Restart</button> &nbsp; <button id='checkdropbear' class='btn btn-success'>Check</button> </div>  </div> </div>").hide().fadeIn(3000);
                return $('#panel-setting').append(dropbearpanel);
            } 
            else if(dropbear == true)
            {
                $('#dropbearpanel').fadeOut(1000,function(){
                    $('#dropbearpanel').remove();
                });
                var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-success'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(dropbearpanel);

            }
            else
            {
                $('#dropbearpanel').fadeOut(1000, function(){
                    $('#dropbearpanel').remove();
                });
                var dropbearpanel = $("<div class='col-md-6' id='dropbearpanel'> <div class='panel panel-danger'> <div class='panel-heading'>DROPBEAR</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(dropbearpanel);
            }
        },
        error: function(data){
            $('#dropbearpanel :input').prop('disabled', false);
            $('#restartdropbear').text('Fix/Restart');
            return swal('Whoops!', 'Server Error Detected!', 'error');
        }
    });
}

function restartvpn(server,token)
{
    var data = '_token=' + token + '&server_host=' + server;
    $.ajax({
        type: 'POST',
        url: '/server/panel/restart/openvpn',
        data: data,
        beforeSend: function(){
            $('#vpnpanel :input').prop('disabled', true);
            $('#restartvpn').text('Restarting....');
        },
        success: function(data){
            $('#vpnpanel :input').prop('disabled', true);
            $('#restartvpn').text('Restarting....');
            var vpn = data.status.vpn.status;
            if(vpn == false)
            {
                $('#vpnpanel').fadeOut(1000,function(){
                    $('#vpnpanel').remove();
                });
                var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartvpn' onclick='restartvpn(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checkvpn' class='btn btn-success'>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(vpnpanel); 
            } 
            else if(vpn == true)
            {
                $('#vpnpanel').fadeOut(1000,function(){
                    $('#vpnpanel').remove();
                });
                var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-success'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(vpnpanel);

            }
            else
            {
                $('#vpnpanel').fadeOut(1000, function(){
                    $('#vpnpanel').remove();
                });
                var vpnpanel = $("<div class='col-md-6' id='vpnpanel'> <div class='panel panel-danger'> <div class='panel-heading'>OPENVPN</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(vpnpanel);
            }
        },
        error: function(data){
            $('#vpnpanel :input').prop('disabled', false);
            $('#restartvpn').text('Fix/Restart');
            return swal('Whoops!', 'Server Error Detected!', 'error');
        }
    });
}

function restartsquid(server,token)
{
    var data = '_token=' + token + '&server_host=' + server;
    $.ajax({
        type: 'POST',
        url: '/server/panel/restart/squid',
        data: data,
        beforeSend: function(){
            $('#squidpanel :input').prop('disabled', true);
            $('#restartsquid').text('Restarting....');
        },
        success: function(data){
            $('#squidpanel :input').prop('disabled', true);
            $('#restartsquid').text('Restarting....');
            var squid = data.status.squid.status;
            if(squid == false)
            {
                $('#squidpanel').fadeOut(1000,function(){
                    $('#squidpanel').remove();
                });
                var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-danger'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> OFFLINE </h2> <hr /> <button id='restartsquid' onclick='restartsquid(\"" + data.status.dropbear.host + "\",\"" + document.getElementsByTagName('meta')[3].content + "\")' class='btn btn-warning' >Fix/Restart</button> &nbsp; <button id='checksquid' class='btn btn-success' >Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(squidpanel); 
            } 
            else if(squid == true)
            {
                $('#squidpanel').fadeOut(1000,function(){
                    $('#squidpanel').remove();
                });
                var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-success'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> ONLINE </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(squidpanel);

            }
            else
            {
                $('#squidpanel').fadeOut(1000,function(){
                    $('#squidpanel').remove();
                });
                var squidpanel = $("<div class='col-md-6' id='squidpanel'> <div class='panel panel-danger'> <div class='panel-heading'>SQUID</div> <div class='panel-body'> <h2 style='text-align:center;'> NOT INSTALLED </h2> <hr /> <button id='' class='btn btn-warning' disabled>Fix/Restart</button> &nbsp; <button id='' class='btn btn-success' disabled>Check</button> </div>  </div> </div>").hide().fadeIn(2000);
                $('#panel-setting').append(squidpanel);
            }
        },
        error: function(data){
            $('#squidpanel :input').prop('disabled', false);
            $('#restartsquid').text('Fix/Restart');
            return swal('Whoops!', 'Server Error Detected!', 'error');
        }
    });
}

$(document).ready(function(){
    $('#dns-add').submit(function(event){
        event.preventDefault();
        var data = $('#dns-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/dns/add',
            data: data,
            beforeSend: function(){
                $('#dns-add :input').prop('disabled', true);
                $('#btn-add-dns').text('Please Wait......');
            },
            success: function(data){
                $('#dns-add :input').prop('disabled', true);
                $('#dns-add :input').val('');
                $('#btn-add-dns').text('Create!');

                if(data.status == 'exists')
                {
                    return swal('Whoops!', 'DNS With that\'s domain already exists', 'error');
                }

                return swal('Success!', 'DNS Added successfully!', 'success');
            },
            error: function(data){
                $('#dns-add :input').prop('disabled', true);
                $('#dns-add :input').val('');
                $('#btn-add-dns').text('Create!');

                return swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});
$(document).ready(function(){
    $('#host-to-ip').submit(function(event){
        event.preventDefault();

        var data = $('#host-to-ip').serialize();
        $.ajax({
            type: 'GET',
            url: '/tools/host-to-ip/check',
            data: data,
            beforeSend: function(){
                $('#result').html('');
                $('#host-to-ip :input').prop('disabled', true);
                $('#btn-host-to-ip').text('Checking.......');
            },
            success: function(data){
                console.log(data);
                $('#host-to-ip :input').prop('disabled', false);
                $('#host-to-ip :input').val('');
                $('#btn-host-to-ip').text('Check!');

                $('#result').append('<hr /><div class="alert alert-warning"> IP address of <code><strong>' + data.result.host + '</strong></code> is <code><strong>' + data.result.ip + '</strong></code></div>');

                return swal('Success!', 'We\'ve got your IP!', 'success');
            },
            error: function(){
                return swal('Whoops', 'Undefined error detected!', 'error');
            }
        });
    })
});

$(document).ready(function(){
    $('#port-check').submit(function(e){
        e.preventDefault();
        var data = $('#port-check').serialize();
        $.ajax({
            type: 'GET',
            url: '/tools/port-check/check',
            data: data,
            beforeSend: function(){
                $('#result').html('');
                $('#port-check :input').prop('disabled', true);
                $('#btn-port-check').text('Checking........');
            },
            success: function(data)
            {
                if(data.status == 'error')
                {
                    $('#port-check :input').prop('disabled', false);
                    $('#port-check :input').val('');
                    $('#btn-port-check').text('Check!');
                    
                    var result = $('<hr /><div class="alert alert-danger"><strong>Result: <code>' + data.result.ip + ':' + data.result.port + '</code> <label class="label label-danger">Closed!</label></strong></div>').hide().fadeIn(1000);

                    return $('#result').append(result);
                }

                $('#port-check :input').prop('disabled', false);
                $('#port-check :input').val('');
                $('#btn-port-check').text('Check!');
                
                var result = $('<hr /><div class="alert alert-success"><strong>Result: <code>' + data.result.ip + ':' + data.result.port + '</code> <label class="label label-success">Opened!</label></strong></div>').hide().fadeIn(1000);

                return $('#result').append(result);
                   
            },
            error: function(){
                $('#port-check :input').prop('disabled', false);
                $('#port-check :input').val('');
                $('#btn-port-check').text('Check!');

                return swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});

$(document).ready(function(){
    $('#dns-creator').submit(function(e){
        e.preventDefault();
        var data = $('#dns-creator').serialize();
        $.ajax({
            type: 'POST',
            url: '/tools/dns-creator',
            data: data,
            beforeSend: function(){
                $('#result').html();
                $('#dns-creator :input').prop('disabled', true);
                $('#btn-create-dns').text('Creating......');
            },
            success: function(data){
                $('#dns-creator :input').prop('disabled', false);
                $('#dns-creator :input').val('');
                $('#btn-create-dns').text('Create!');
                if(data.status == 'error'){
                    var result = $('<hr /><div class="alert alert-danger"><strong>' + data.message + '</strong></div>').hide().fadeIn(1000);
                    return $('#result').append(result);
                }

                var result = $('<hr /><div class="alert alert-success"><strong>' + data.message + '</strong><br /> Now <code>' + data.data.hostname + '.' + data.data.domain + '</code> is pointed to <strong><code>' + data.data.ip + '</code></div>' ).hide().fadeIn(1000);
                return $('#result').append(result);
            },
            error: function(data){
                $('#dns-creator :input').prop('disabled', false);
                $('#dns-creator :input').val('');
                $('#btn-create-dns').text('Create!');

                return swal('Whoops!', 'Undefined error detected!', 'error');
            }
        });
    });
});

$(document).ready(function(){
    $('#ssh-checker').submit(function(event){
        event.preventDefault();
        var data = $('#ssh-checker').serialize();
        $.ajax({
            type: 'POST',
            url: '/pages/ssh-checker',
            data: data,
            beforeSend: function(){
                $('#result').html('');
                $('#ssh-checker :input').prop('disabled', true);
                $('#btn-check-ssh').text('Checking.......');
            },
            success: function(data){
                $('#ssh-checker :input').prop('disabled', false);
                $('#ssh-checker :input').val('');
                $('#btn-check-ssh').text('Check!');

                if(data.status != 'exists')
                {
                    var result = $('<hr /><div class="alert alert-danger">Whoops! SSH With Username <code>' + data.data.username + '</code> on server <code>' + data.data.server + '</code> not exists! </div>').hide().fadeIn(1000);
                    return $('#result').append(result);
                }

                var result = $('<hr /><div class="alert alert-success">Success! SSH With Username <code>' + data.data.username + '</code> on server <code>' + data.data.server + '</code> exists!</div>').hide().fadeIn(1000);
                return $('#result').append(result);
            },
            error: function(data){
                $('#ssh-checker :input').prop('disabled', false);
                $('#ssh-checker :input').val('');
                $('#btn-check-ssh').text('Check!');

                return swal('Whoops!', 'Something went wrong!', 'error');
            }
        });
    });
});
$(document).ready(function(){
    $('#squid-add').submit(function(e){
        e.preventDefault();
        var data = $('#squid-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/squid/add',
            data: data,
            beforeSend: function(){
                $('#squid-add :input').prop('disabled', true);
                $('#btn-add-squid').text('Adding.......');
            },
            success: function(data){
                $('#squid-add :input').prop('disabled', false);
                $('#squid-add :input').val('');
                $('#btn-add-squid').text('Add!');

                return swal('Success!', 'Squid successfully added!', 'success');
            },
            error: function(data){
                $('#squid-add :input').prop('disabled', false);
                $('#squid-add :input').val('');
                $('#btn-add-squid').text('Add!');

                return swal('Whoops!', 'Something went wrong', 'error');
            }
        });
    });
});

function deleteSquid(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This squid will be deleted permanently!",
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
            url: '/manage/admin/squid/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                swal("Deleted!", "Your SQUID has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                swal("Error!!", "Undefined error detected!", "error");
            }
        });
      } else {
        swal("Cancelled!", "Your SQUID is safe :)", "success");
      }
    });
}

function deleteDNS(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This DNS will be deleted permanently!",
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
            url: '/manage/admin/dns/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                console.log(data);
                swal("Deleted!", "Your DNS has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                console.log(data);
                swal("Error!!", "Undefined error detected!", "error");
            }
        });
      } else {
        swal("Cancelled!", "Your DNS is safe :)", "success");
      }
    });
}

$(document).ready(function(){
    $('#ads-add').submit(function(event){
        event.preventDefault();
        var data = $('#ads-add').serialize();
        $.ajax({
            type: 'POST',
            url: '/manage/admin/ads/add',
            data: data,
            beforeSend: function(){
                $('#ads-add :input').prop('disabled', true);
                $('#btn-add-ads').text('Adding.......');
            },
            success: function(data){
                $('#ads-add :input').prop('disabled', false);
                $('#ads-add :input').val('');
                $('#btn-add-ads').text('Add!');

                return swal('Success!', 'Ads successfully saved!', 'success');
            },
            error: function(data){
                $('#ads-add :input').prop('disabled', false);
                $('#ads-add :input').val('');
                $('#btn-add-ads').text('Add!');

                return swal('Whoops!', 'Something went wrong!', 'error');
            }
        });
    });
});

function deleteADS(id,csrf)
{
    swal({
      title: "Are you sure?",
      text: "This ADS will be deleted permanently!",
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
            url: '/manage/admin/ads/delete/' + id,
            data: '_token=' + csrf,
            success: function(data){
                console.log(data);
                swal("Deleted!", "Your ADS has been deleted!", "success");
                $('table tr#row-' + id).remove();
            },
            error: function(data){
                console.log(data);
                swal("Error!!", "Undefined error detected!", "error");
            }
        });
      } else {
        swal("Cancelled!", "Your ADS is safe :)", "success");
      }
    });
}