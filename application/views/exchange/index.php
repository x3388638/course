<!DOCTYPE html>
<html>
    <head>
    	<title>換課媒合平台-NCNU</title>
        <meta name="description" content="國立暨南國際大學-換課媒合平台" />
        <meta name="keywords" content="暨大,暨南大學,國立暨南國際大學,ncnu,課表,換課" />
        <meta charset= "utf-8">
        <link href="<?php echo base_url();?>application/views/exchange/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/css/bootstrap-theme.min.css">
    	<link rel= "stylesheet" href= "<?php echo base_url();?>application/views/exchange/style.css">
    	<link href='http://fonts.googleapis.com/css?family=Coming+Soon' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
    	<script src="<?PHP echo base_url()?>application/views/jquery-2.1.1.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery.cookie.min.js"></script>
        <script src="<?PHP echo base_url()?>application/views/jquery-ui.min.js"></script>
    	<script src= "<?php echo base_url();?>application/views/html2canvas.js"></script>
        <script src= "<?php echo base_url();?>application/views/canvas2png.js"></script>
        <script src= "<?php echo base_url();?>application/views/bootstrap-3.2.0/dist/js/bootstrap.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/jquery.scrollTo.min.js"></script>
        <script src= "<?php echo base_url();?>application/views/exchange/script.js"></script>
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
        <div id= "main" class= "container">
            <div id= "tool" class= "row">
                <div class= "col-md-12">
                    <div class= "btn-group btn-group-lg pull-left">
                        <button id= "supplyB" class= "btn btn-myDanger">供給</button>
                        <button id= "demandB" class= "btn btn-myPrimary">需求</button>
                    </div>
                    <div class= "btn-group btn-group-lg pull-right">
                        <button id= "leaveDemand" class= "btn btn-myDefault">找不到你要的課嗎? 留下你的需求吧</button>
                    </div>
                    <div id= "showall" class= "btn-group btn-group-lg pull-right">
                    </div>
                </div>
            </div>
            <div class= "row">
                <div id= "detailWrap" class= "col-md-3">
                    <div style= "height: 15px">
                        <div id= "dId" class= "pull-right"></div>
                    </div>
                    <table>
                        <tr>
                            <td style= "vertical-align: top">
                                <img id= "dImg" src= ''>
                            </td>
                            <td style= "vertical-align: top; padding-left: 15px">
                                <a id= "dA" href= "#" class= "b" target= "_blank"></a><br>
                                <span id= "dTime" style= "color: #b2b2b2; font-size: 12px"></span>
                            </td>
                    </table>
                    <div class= "labelWrap">
                        <span class="label label-default">想要的課</span>
                    </div>
                    <div id= "dWant" class= "dContent">
                    </div>
                    <div class= "labelWrap">
                        <span class="label label-default">擁有的課</span>
                    </div>
                    <div id= "dHave" class= "dContent">
                    </div>
                    <div class= "labelWrap">
                        <span class="label label-default">補充說明</span>
                    </div>
                    <div id= "dDesc" class= "dContent">
                    </div>
                    <div id= "bWrap" style= "height: 40px">
                        <div id= "dDel" class= "btn-group btn-group-sm pull-right">
                        </div>
                        <div id= "dEdit" class= "btn-group btn-group-sm pull-right">
                        </div>
                    </div>
                </div>
                <div id= "listWrap" class= "col-md-9 table-responsive">
                    <table id= "list" class= "table table-hover table-striped">
                        <thead>
                            <tr><th>No.</th><th><!-- name --></th><th>想要的課</th><th>擁有的課</th><th>說明</th></tr>
                        </thead>
                        <tbody>
                            <?PHP
                                foreach($result as $row){
                                    $want= str_replace('&jonilars;', "'", $row['want']);
                                    $have= str_replace('&jonilars;', "'", $row['have']);
                                    $desc= str_replace('&jonilars;', "'", $row['desc']);
                                    echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$want."</td><td>".$have."</td><td>".$desc."</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id= "alert" class= "row">
                <div class= "col-md-12">
                    <div class= "alert alert-myDanger text-center" role= "alert">注意事項 : 換課成功後，請記得編輯/ 刪除換課資訊</div>
                </div>
            </div>
            <div id= "modal1">
            </div>
            <div id= "closeModal1">
                ×
            </div>
            <div id= "cWrap">
                <div id= "supply">
                    <span class= "h1">供給</span>
                    <p class= "p">
                        選到太多課<br>讓您感到困擾嗎?<br><br>來送給需要的人吧!
                    </p>
                </div>
                <div id= "demand">
                    <span class= "h1">需求</span>
                    <p class= "p">
                        志願序沒中<br>搶課又搶輸人家<br><br>來找尋您的貴人吧!
                    </p>
                </div>
            </div>
        </div>
        <div id= "foot" class= "container">
            <hr style= "width: 500px">
            <div class= "row">
                <div class= "text-center" id= "footer">
                    <span style= "color: #b2b2b2;">適用學期 1031 　　</span>&copy; 2014 <a href= "http://fb.com/chang1994" target= "_blank">ChaNg YY</a>
                </div>
            </div>
            <div id= "toTop"><img src= "<?PHP echo base_url()?>application/views/top.png" width= "50px"></div>
            <div id= "bug">
                問題回報
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
                            <img class= "loading" src= "<?PHP echo base_url()?>application/views/loading.gif" width= "25px">
                            <button id= "reportSubmit" type="button" class="btn btn-primary">送出</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="supplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class= "form-horizontal" role= "form" onsubmit= "return false">
                                <div class= "form-group">
                                    <label for= "sCname" class= "col-sm-3 control-label">課程名稱</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "sCname" class= "form-control sCname" placeholder= "ex:5efgh船艇"><span id= "addSCname" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                                <div class= "form-group">
                                    <label for= "supplyDesc" class= "col-sm-3 control-label">補充說明</label>
                                    <div class= "col-sm-8">
                                        <textarea id= "supplyDesc" class= "form-control" rows= "4" placeholder= "好課大放送，走過路過千萬不要錯過"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <img class= "loading" src= "<?PHP echo base_url()?>application/views/loading.gif" width= "25px">
                            <button id= "supplySubmit" type="button" class="btn btn-primary">留言</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="demandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class= "form-horizontal" role= "form" onsubmit= "return false">
                                <div class= "form-group">
                                    <label for= "want" class= "col-sm-3 control-label">想要的課</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "want" class= "form-control want" placeholder= "ex:大學夢"><span id= "addWant" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id= "demandSubmit" type="button" class="btn btn-primary">搜尋</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ldModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class= "form-horizontal" role= "form" onsubmit= "return false">
                                <div class= "form-group">
                                    <label for= "ldWant" class= "col-sm-3 control-label">想要的課</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "ldWant" class= "form-control ldWant" placeholder= "ex:1efgh船艇"><span id= "addldWant" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                                <div class= "form-group">
                                    <label for= "ldHave" class= "col-sm-3 control-label">擁有的課</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "ldHave" class= "form-control ldHave" placeholder= "ex:網路安全概論"><span id= "addldHave" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                                <div class= "form-group">
                                    <label for= "ldDesc" class= "col-sm-3 control-label">補充說明</label>
                                    <div class= "col-sm-8">
                                        <textarea id= "ldDesc" class= "form-control" rows= "4" placeholder= "跪求船艇，附贈品田套餐任選><"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <img class= "loading" src= "<?PHP echo base_url()?>application/views/loading.gif" width= "25px">
                            <button id= "ldSubmit" type="button" class="btn btn-primary">留言</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class= "form-horizontal" role= "form" onsubmit= "return false">
                                <div class= "form-group">
                                    <label for= "eWant" class= "col-sm-3 control-label">想要的課</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "eWant" class= "form-control eWant" placeholder= "ex:1efgh船艇"><span id= "addeWant" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                                <div class= "form-group">
                                    <label for= "eHave" class= "col-sm-3 control-label">擁有的課</label>
                                    <div class= "col-sm-8">
                                        <input type= "text" id= "eHave" class= "form-control eHave" placeholder= "ex:網路安全概論"><span id= "addeHave" class="glyphicon glyphicon-plus-sign"></span>
                                    </div>
                                </div>
                                <div class= "form-group">
                                    <label for= "eDesc" class= "col-sm-3 control-label">補充說明</label>
                                    <div class= "col-sm-8">
                                        <textarea id= "eDesc" class= "form-control" rows= "4" placeholder= "跪求船艇，附贈品田套餐任選><"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            ( 刪除課程留白即可 ) <img class= "loading" src= "<?PHP echo base_url()?>application/views/loading.gif" width= "25px">
                            <button id= "eSubmit" type="button" class="btn btn-primary">更新</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>