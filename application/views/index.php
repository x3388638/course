<!DOCTYPE html>
<html>
    <head>
    	<title>自己的課表自己排</title>
        <meta name="description" content="國立暨南國際大學資訊管理學系專屬-課表生成系統" />
        <meta name="keywords" content="暨大資管系,暨南大學資管系,國立暨南國際大學資訊管理學系,資管系,ncnu,ncnuim,im,暨大,資管,課表,資管系課表" />
        <meta charset= "utf-8">
        <link href="<?php echo base_url();?>application/views/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap-theme.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/style.css">
    	<link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
    	<script src="<?PHP echo base_url()?>application/views/jquery-2.1.1.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery.cookie.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery-ui.min.js"></script>
    	<script src= "<?php echo base_url();?>application/views/html2canvas.js"></script>
        <script src= "<?php echo base_url();?>application/views/canvas2png.js"></script>
        <script src= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/js/bootstrap.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/jquery.scrollTo.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/script.js"></script>
        <script>
            /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-53695782-1', 'auto');
            ga('send', 'pageview');*/
        </script>
    </head>
    <body onSelectStart="event.returnValue=false">
        <!-- new -->
        <div id= "fb-root"></div>
        <div id= "nav" class= "container">
            <div class= "row">
                <div class= "col-md-12">

                    <div id= "fbWrap" class= "pull-right">
                        <!-- <a href= "javascript:login();">facebook 登入</a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- new -->
        <div class= "container">
            <div class= "row">
                <div id= "topWrap" class= "col-md-12">
                    <span style= "color: #b2b2b2; font-size: 8px" class= "pull-left">*不建議以 IE 瀏覽器操作</span>
                    <!-- new -->
                    <div id= "save" class= "btn-group btn-group-sm pull-right" data-toggle= "tooltip" data-placement= "right" title= "記住我"></div>
                    <!-- new -->
                    <div id= "exc" class= "btn-group btn-group-sm pull-right"><button class= "btn btn-myDefault">匯出Excel</button></div>
                    <div id= "ss" class= "btn-group btn-group-sm pull-right" data-toggle="tooltip" data-placement="left" title= ".PNG"><button class= "btn btn-myDefault">下載課表</button></div>
                </div>
                <div id= "stWrap" class= "col-md-12 table-responsive">
                    <table id= "sT" class= "table table-bordered" align= "center">
                		<thead>
                			<tr><th>\</th><th>Mon.</th><th>Tue.</th><th>Wed.</th><th>Thu.</th><th>Fri.</th></tr>
                		</thead>
                		<tbody>
	                		<tr time= "a"><th>a/08</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "b"><th>b/09</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "c"><th>c/10</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "d"><th>d/11</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "z"><th>z/12</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "e"><th>e/13</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "f"><th>f/14</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "g"><th>g/15</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "h"><th>h/16</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "i"><th>i/17</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "j"><th>j/18</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "k"><th>k/19</th><td></td><td></td><td></td><td></td><td></td></tr>
	                		<tr time= "l"><th>l/20</th><td></td><td></td><td></td><td></td><td></td></tr>
	                	</tbody>
                	</table>
                </div>
                <div id= "colorWrap" class= "pull-left">
                        <span style= "color: #b2b2b2; vertical-align: middle">自行配色</span><div id= "color" data-toggle="tooltip" data-placement="bottom" title= "拖曳至表格"></div><input id= "colorC" type= "color" value= "#FFFFFF" data-toggle="tooltip" data-placement="bottom" title= "選取顏色, 拖曳左方圓圈"><div id= "resetC" class= "btn-group btn-group-sm" data-toggle="tooltip" data-placement="bottom" title= "重新上色"><button class= "btn btn-myDefault">重設</button></div>
                </div> 
                <span class= "pull-right" style= "color: #b2b2b2">*雙擊課程表格可修改</span>
            </div>
            <hr style= "padding: 40px 0px 0px; margin: 50px 0px 0px">
            <div class= "row">
                <div class= "col-md-11 col-md-offset-1" style= "margin-bottom: 10px">
                    <div class= "pull-left"><span style= "color: #b2b2b2">課程地圖:</span><span class= "label label-default" style= "padding: 0px 5px; margin: 0px 5px"><a href= "<?php echo base_url();?>IMcoursemap.pdf" target= "_blank" style= "color: #FFF; text-decoration: none">100</a></span><span class= "label label-default" style= "padding: 0px 5px; margin: 0px 5px"><a href= "<?php echo base_url();?>coursemap.pdf" target= "_blank" style= "color: #FFF; text-decoration: none">103</a></span></div>
                    <span class= "pull-right" style= "color: #b2b2b2; display: none">*善用 <kbd>ctrl</kbd>+<kbd>f</kbd> 搜尋課程</span>
                    <div class= "input-group input-group-sm pull-right"><input type= "text" id= "search" class= "form-control text-center" placeholder= "隨便搜" ></div>
                </div>
            	<div id= "downWrap" class= "col-md-11 col-md-offset-1 table-responsive">
                    <table id= "cT" class= "table table-hover table-striped" align= "center">
                		<thead>
                			<tr><th>開課單位</th><th>課號</th><th>課程名稱</th><th>時段</th><th>授課地點</th><th>老師</th><th>年級</th><th></th><th></th></tr>
                		</thead>
                		<tbody>
	                		<?php
	                			foreach($result as $row){
	                				echo "<tr><td>".$row['dept']."</td><td>".$row['cid']."</td><td>".$row['cname']."</td><td>".$row['time']."</td><td>".$row['location']."</td><td>".$row['teacher']."</td><td>".$row['grade']."</td><td><div class= 'btn-group btn-group-sm summary'><button class= 'btn btn-myDefault'>大綱</button></div></td><td><div class= 'btn-group btn-group-sm addC'><button class= 'btn btn-myDefault'>加入</button></div></td></tr>";                                                              
	                			}
                                foreach($result2 as $row){
                                    echo "<tr><td>".$row['dept']."</td><td>".$row['cid']."</td><td>".$row['cname']."</td><td>".$row['time']."</td><td>".$row['location']."</td><td>".$row['teacher']."</td><td>".$row['grade']."</td><td><div class= 'btn-group btn-group-sm summary'><button class= 'btn btn-myDefault'>大綱</button></div></td><td><div class= 'btn-group btn-group-sm addC'><button class= 'btn btn-myDefault'>加入</button></div></td></tr>";                                                              
                                }
                                foreach($result3 as $row){
                                    echo "<tr><td>".$row['dept']."</td><td>".$row['cid']."</td><td>".$row['cname']."</td><td>".$row['time']."</td><td>".$row['location']."</td><td>".$row['teacher']."</td><td>".$row['grade']."</td><td><div class= 'btn-group btn-group-sm summary'><button class= 'btn btn-myDefault'>大綱</button></div></td><td><div class= 'btn-group btn-group-sm addC'><button class= 'btn btn-myDefault'>加入</button></div></td></tr>";                                                              
                                }
	                		?>
	                	</tbody>
                	</table>
            	</div>
            </div>
            <hr style= "width: 500px; margin-top: 50px">
            <div class= "row">
            	<div class= "text-center" id= "footer">
            		&copy; 2014 <a href= "http://fb.com/chang1994" target= "_blank">ChaNg YY</a> <span style= "color: #b2b2b2; font-size: 10px">with jQuery, Bootstrap, CodeIgniter.</span>
            	</div>
            </div>
            <div id= "toTop"><img src= "<?PHP echo base_url()?>application/views/top.png" width= "50px"></div>
            <div id= "back">
                <div class= "row">
                    <button id= "sclose" type="button" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div id= "scontent" class= "row">
                </div>
            </div>
            <div id= "bug">
                問題回報
            </div>
            <div id= "edit">
                <textarea id= "editText" cols= "30" rows= "3"></textarea>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button id= "modalClose" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">錯誤回報<h5>(任何功能異常, 課程資訊有誤, 建議...等)</h5></h4>
                        </div>
                        <div class="modal-body">
                            <div class= "input-group col-md-12 col-xs-12">
                                <textarea id= "reportContent" class= "form-control" rows= "15"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <img id= "loading" src= "<?PHP echo base_url()?>application/views/loading.gif" width= "25px">
                            <button id= "reportSubmit" type="button" class="btn btn-primary">送出</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>