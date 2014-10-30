<!DOCTYPE html>
<html>
    <head>
    	<title>自己的課表自己排-NCNU</title>
        <meta name="description" content="國立暨南國際大學-課表生成系統" />
        <meta name="keywords" content="暨大,暨南大學,國立暨南國際大學,ncnu,課表" />
        <meta charset= "utf-8">
        <link href="<?php echo base_url();?>application/views/ncnu/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap-theme.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/ncnu/style.css">
    	<link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
    	<script src="<?PHP echo base_url()?>application/views/jquery-2.1.1.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery.cookie.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery-ui.min.js"></script>
    	<script src= "<?php echo base_url();?>application/views/html2canvas.js"></script>
        <script src= "<?php echo base_url();?>application/views/canvas2png.js"></script>
        <script src= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/js/bootstrap.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/jquery.scrollTo.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/ncnu/script.js"></script>
    </head>
    <body onSelectStart="event.returnValue=false">
        <div id= "fb-root"></div>
        <div id= "nav" class= "container">
            <div class= "row">
                <div class= "col-md-12">
                    <div id= "linkWrap" class= "pull-left">
                        <a href= "<?PHP echo base_url()?>ncnu.htm">我的課表</a><a href= "<?PHP echo base_url()?>ncnu/exchange.htm">換課平台</a>
                    </div>
                    <div id= "fbWrap" class= "pull-right">
                    </div>
                </div>
            </div>
        </div>
        <div class= "container">
            <div class= "row">
                <div id= "topWrap" class= "col-md-12">
                    <span style= "color: #b2b2b2; font-size: 8px" class= "pull-left">*不建議以 IE 瀏覽器操作</span>
                    <div id= "save" class= "btn-group btn-group-sm pull-right" data-toggle= "tooltip" data-placement= "right" title= "記住我"></div>
                    <div id= "exc" class= "btn-group btn-group-sm pull-right" data-toggle="tooltip" data-placement="left" title= ".PNG"><button class= "btn btn-myDefault">匯出Excel</button></div>
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
                <span class= "pull-right" style= "color: #b2b2b2">*雙擊課程表格可編輯</span>
            </div>
            <hr style= "padding: 40px 0px 0px; margin: 50px 0px 0px">
            <div class= "row">
                <div class= "col-md-12" style= "margin-bottom: 10px">
                    <span class= "pull-right" style= "color: #b2b2b2;">*善用 <kbd>ctrl</kbd>+<kbd>f</kbd> 搜尋課程</span>
                    <div class= "input-group input-group-lg pull-left">
                        <select id= "dept">
                            <?php
                                foreach($dept as $row){
                                    echo "<option value= '".$row['dept']."'>".$row['dept']."</option>";
                                }
                            ?>
                            <option value= "-1">全部</option>
                        </select>
                    </div>
                    <!-- <div class= "input-group input-group-sm pull-right"><input type= "text" id= "search" class= "form-control text-center" placeholder= "隨便搜" ></div> -->
                </div>
            	<div id= "downWrap" class= "col-md-12 table-responsive">
                    <table id= "cT" class= "table table-hover table-striped" align= "center">
                		<thead>
                			<tr><th>開課單位</th><th>課號</th><th>課程名稱</th><th>班別</th><th>時段</th><th>授課地點</th><th>老師</th><th>年級</th><th></th><th></th></tr>
                		</thead>
                		<tbody>
	                		<?php
	                			foreach($result as $row){
	                				echo "<tr><td>".$row['dept']."</td><td>".$row['cid']."</td><td>".$row['cname']."</td><td>".$row['classes']."</td><td>".$row['time']."</td><td>".$row['location']."</td><td>".$row['teacher']."</td><td>".$row['grade']."</td><td><div class= 'btn-group btn-group-sm summary'><button class= 'btn btn-myDefault'>大綱</button></div></td><td><div class= 'btn-group btn-group-sm addC'><button class= 'btn btn-myDefault'>加入</button></div></td></tr>";                                                              
	                			}
	                		?>
	                	</tbody>
                	</table>
            	</div>
            </div>
            <hr style= "width: 500px; margin-top: 50px">
            <div class= "row">
            	<div class= "text-center" id= "footer">
            		<span style= "color: #b2b2b2;">適用學期 1031 　　</span>&copy; 2014 <a href= "http://fb.com/chang1994" target= "_blank">ChaNg YY</a>
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
            <div id= "map">
                <a href= "http://ccweb.ncnu.edu.tw/student/DeptQuerylist.asp#tbl_DeptQuerylist" target= "_blank">各系課程地圖</a>
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