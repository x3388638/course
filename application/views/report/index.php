<!DOCTYPE html>
<html>
    <head>
        <title>Administrator :: 自己的課表自己排-NCNU</title>
        <meta name="description" content="國立暨南國際大學-課表生成系統" />
        <meta name="keywords" content="暨大,暨南大學,國立暨南國際大學,ncnu,課表" />
        <meta charset= "utf-8">
        <link href="<?php echo base_url();?>application/views/report/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap.min.css">
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap-theme.min.css">
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/report/style.css">
        <!-- <link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'> -->
        <!-- <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'> -->
        <script src="<?PHP echo base_url()?>application/views/jquery-2.1.1.min.js"></script>
        <!-- <script src="<?PHP echo base_url()?>application/views/jquery.cookie.min.js"></script> -->
        <!-- <script src="<?PHP echo base_url()?>application/views/jquery-ui.min.js"></script> -->
        <!-- <script src= "<?php echo base_url();?>application/views/html2canvas.js"></script> -->
        <!-- <script src= "<?php echo base_url();?>application/views/canvas2png.js"></script> -->
        <script src= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/js/bootstrap.min.js"></script>
        <!-- <script src= "<?php echo base_url();?>application/views/jquery.scrollTo.min.js"></script> -->
        <script src= "<?php echo base_url();?>application/views/report/script.js"></script>
        <script>
            var u = prompt('user');
            var p = prompt('pass');
            $.ajax({
                url: './cont/admin', 
                type: 'post', 
                dataType: 'json', 
                async: 'false', 
                data: {
                    user: u, 
                    pass: p
                }, 
                success: function(data) {
                    if(!data.valid) {
                        location.href = './';
                    } else {
                        $.ajax({
                            url: './cont/getReport', 
                            type: 'post', 
                            dataType: 'json', 
                            data: {
                                user: u, 
                                pass: p
                            }, 
                            success: function(data) {
                                if(data.valid) {
                                    $('#reportTable tbody').html('');
                                    for(var i in data.list) {
                                        $('#reportTable tbody').append(
                                            '<tr>'+
                                                '<td>' + data.list[i].id + '</td>'+
                                                '<td>' + data.list[i].time + '</td>'+
                                                '<td><a href="http://fb.com/' + data.list[i].uid + '" target="_blank">' + data.list[i].uid + '</a></td>'+
                                                '<td>' + data.list[i].content + '</td>'+
                                            '</tr>'
                                        );
                                    }
                                }
                            }, 
                            error: function(jqXHR) {
                                console.log('error: ' + jqXHR.status + ' -- ' + jqXHR.statusText);
                            }
                        });
                    }
                }, 
                error: function(jqXHR) {
                    console.log('error: ' + jqXHR.status + ' -- ' + jqXHR.statusText);
                }
            });
        </script>
    </head>
    <body onSelectStart="event.returnValue=false">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="reportTable" class="table table-hover">
                        <thead>
                            <tr><th>#</th><th>Time</th><th>User</th><th>Content</th></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </body>
</html>