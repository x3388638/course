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
        <span style="font-family:aboutFont1;position:absolute;top:-99999px">preload font</span>
        <div id= "fb-root"></div>
        <div id= "nav" class= "container">
            <div class= "row">
                <div class= "col-md-12">
                    <div id= "linkWrap" class= "pull-left">
                        <a href= "<?PHP echo base_url()?>ncnu.htm">我的課表</a>
                        <a href= "<?PHP echo base_url()?>ncnu/exchange.htm">換課平台</a>
                        <a href="http://focaaby.github.io/NCNUCourse/" target="_blank">課程評價系統 <span style="font-size:9px" class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>
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
                        <span style= "color: #b2b2b2; vertical-align: middle">自行配色</span>
                        <div id= "color" data-toggle="tooltip" data-placement="bottom" title= "拖曳至表格"></div>
                        <input id= "colorC" type= "color" value= "#FFFFFF" data-toggle="tooltip" data-placement="bottom" title= "選取顏色, 拖曳左方圓圈">
                        <div id= "resetC" class= "btn-group btn-group-sm" data-toggle="tooltip" data-placement="bottom" title= "重新上色">
                            <button class= "btn btn-myDefault">重設</button>
                        </div>
                        <div id= "customC" class= "btn-group btn-group-sm" data-toggle="tooltip" data-placement="bottom" title= "自訂時間 &amp; 內容">
                            <button data-toggle="modal" data-target="#customClassModal" class= "btn btn-myDefault">自訂課程</button>
                        </div>
                </div> 
                <span class= "pull-right" style= "color: #b2b2b2">*雙擊課程表格可編輯</span>
            </div>
            <hr style= "padding: 40px 0px 0px; margin: 50px 0px 0px">
            <div class= "row">
                <div class= "col-md-12" style= "margin-bottom: 10px; height: 25px">
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
            		<a href="javascript:showAbout()" class="pull-right">關於本系統</a><span style= "color: #b2b2b2;">適用學期 1031 　　</span>&copy; 2014 <a href= "http://fb.com/chang1994" target= "_blank">ChaNg YY</a>
            	</div>
            </div>
            <div id= "toTop"><img src= "<?PHP echo base_url()?>application/views/top.png" width= "50px"></div>
            <!-- <div id= "back">
                <div class= "row">
                    <button id= "sclose" type="button" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div id= "scontent" class= "row">
                </div>
            </div> -->
            <div id= "map">
                <a href= "http://ccweb.ncnu.edu.tw/student/DeptQuerylist.asp#tbl_DeptQuerylist" target= "_blank">各系課程地圖</a>
            </div>
            <div id= "bug">
                問題回報
            </div>
            <div id= "edit">
                <textarea id= "editText" cols= "30" rows= "3"></textarea>
            </div>
            <!-- modal -->
            <div id="aboutModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body" style="font-family:aboutFont1,微軟正黑體,ubuntu;font-size:25px;padding:50px;background:rgba(255, 231, 131, 0.61)">
                            <p id = 'aboutTitle'>每到一個新學期的開始<br/>最令人煩惱的莫過於對於接下來這一整個學期的課程規劃</p><br/>
                            <p>
                                <sapn class="rotateItem">
                                    <span style="background:rgba(0, 255, 115, 0.38);padding:3px;border-radius:5px;display:inline-block;transform:rotate(5deg)">選課前 :</span> 這個好想修， 那個看起來也不錯， 可是會不會和必修衝堂阿？<br>
                                </sapn>
                                <span class="rotateItem">
                                    <span style="background:rgba(255, 238, 0, 0.38);padding:3px;border-radius:5px;display:inline-block;transform:rotate(-2deg)">選課中 :</span> 啊!!! 忘記要搶哪幾個通識了， 阿~~~ 想好的通識都被必修卡到了<br/>
                                </span>
                                <span class="rotateItem">
                                    <span style="background:rgba(255, 0, 0, 0.38);padding:3px;border-radius:5px;display:inline-block;transform:rotate(2deg)">選課後 :</span> 這個沒搶到， 那個衝堂， 課表又要重做一次了 QAQ
                                </span>
                            </p>
                            <p style="background:rgba(88, 204, 243, 0.27);margin-left:14px;margin-top:20px">
                                <span style="position:relative;right:14px;bottom:20px">
                                    <span style="font-size:30px">曾經， </span><br/>
                                    你是否也因為想上的課太多而懶的一堂一堂過濾衝堂<br/>
                                    又是否在過濾衝堂時為了 3ghi 到底是甚麼時間而歇斯底里<br/>
                                    最後則因沒有做足功課而在選課大戰敗北<br/>
                                    現實中的課表卻跟想像中天差地遠， 害的你做得再精美的課表都要重頭來過<br><br>
                                    <sapn id="aa" style="background-color:rgba(255, 255, 255, 0.71);padding:0px 25px;border:2px dashed;color:rgb(214, 24, 24);position:relative;right:37px;top:20px;font-weight:bold;transform:rotate(9deg);display:inline-block;">現在你再也不必為了這種事情煩惱。</sapn>
                                </span>
                            </p>
                            <hr style="border: 4px double;" />
                            <p>
                                首先， <br/>
                                打開你的<span class="underline">教務系統</span>，<br/>
                                確定有哪些必修要選， 有哪些通識想修， 並留意課程的<span class="highlight">開課單位</span><br/>
                                <div>
                                    <a href="<?php echo base_url();?>application/views/img/002.PNG" target="_blank" class="thumbnail">
                                        <img src="<?php echo base_url();?>application/views/img/002.PNG"/>
                                    </a>
                                </div>
                                再來，<br/>
                                利用<span class="underline">本系統</span>，把<span class="highlight">必修</span>課通通排進課表裡<br/>
                                先<span class="highlight">選擇對應的開課單位</span>， 再找到你要排進課表的課<br/>
                                <div>
                                    <a href="<?php echo base_url();?>application/views/img/003.PNG" target="_blank" class="thumbnail">
                                        <img src="<?php echo base_url();?>application/views/img/003.PNG"/>
                                    </a>
                                </div>
                                剩下的事就是把其他你想修的<span class="highlight">通識(選修)</span>課程通通加進去，<br/>
                                至於會不會衝堂就交給系統來煩惱吧~<br/>
                                如此一來，<br/>
                                <span class="underline">你不但輕鬆的解決了所有選課上的麻煩，</span><br/>
                                <span class="underline">更能對這整學期的時間安排有更加充分規劃。</span><br/>
                                <div>
                                    <a href="<?php echo base_url();?>application/views/img/004.PNG" target="_blank" class="thumbnail">
                                        <img src="<?php echo base_url();?>application/views/img/004.PNG"/>
                                    </a>
                                </div>
                            </p>
                            <hr style="border: 4px double;" />
                            <p>
                                除此之外，<br/>
                                本系統還提供<br/>
                                <span class="highlight">著色</span>、<span class="highlight">自訂課程時段</span>、<span class="highlight">儲存課表</span>、<span class="highlight">課表圖檔下載</span>、<span class="highlight">匯出 Excel</span> 等多項功能<br/>
                                讓你再也不用把美好的青春浪費在課表的製作上。<br>
                                <div class="row" style="margin:0px">
                                    <div class="col-md-6" style="padding:1px">
                                        <a href="<?php echo base_url();?>application/views/img/005.PNG" target="_blank" class="thumbnail">
                                            <img src="<?php echo base_url();?>application/views/img/005.PNG"/>
                                        </a>
                                    </div>
                                    <div class="col-md-6" style="padding:1px">
                                        <a href="<?php echo base_url();?>application/views/img/006.PNG" target="_blank" class="thumbnail">
                                            <img src="<?php echo base_url();?>application/views/img/006.PNG"/>
                                        </a>
                                    </div>
                                </div>
                            </p>
                            <hr style="border: 1px solid rgba(0, 0, 0, 0.1);" />
                            <span class="pull-right" style="font-family:'Coming Soon', cursive;font-size:12px;text-align:right">made by <a href="http://fb.com/chang1994" target="_blank">ChaNg YY</a><br/>08.2014</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="courseContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>大綱</h4>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="customClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">自訂課程</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="customClassTime" class="col-sm-2 control-label">*時間: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customClassTime" placeholder="Ex: 2abcdzefghijkl3abcdzefghijkl">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customClassName" class="col-sm-2 control-label">*課名: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customClassName" placeholder="放假">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customClassLocation" class="col-sm-2 control-label">地點: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customClassLocation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customClassTeacher" class="col-sm-2 control-label">教師: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customClassTeacher">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id = 'addCustomC' type="button" class="btn btn-myDefault">加入</button>
                        </div>
                    </div>
                </div>
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