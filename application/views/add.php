<!DOCTYPE html>
<html>
    <head>
    	<title></title>
        <meta charset= "utf-8">
    	<script src="<?PHP echo base_url()?>application/views/jquery-2.1.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#b").click(function(){
                    var val= $("input[type= 'text']").val();
                    var text= $("textarea").val();
                    if(val== ""|| text== ""){
                        alert();
                    }
                    else{
                        val= val.replace("[學士班]", "").replace("(限已向語文中心登記選修者)", "");
                        var arr= val.split(" ");
                        var dept= arr[0];
                        var cid= arr[1];
                        var cname= arr[2];
                        var classes= arr[3];
                        var time= arr[6];
                        var location= arr[7];
                        var teacher= arr[8];
                        var grade= arr[9];
                        var content= text;
                        $.post("http://localhost/CodeIgniter/course/index.php/add/ajax", 
                            {
                                dept: dept,
                                cid: cid,
                                cname: cname,
                                classes: classes,
                                time: time,
                                location: location,
                                teacher: teacher,
                                grade: grade,
                                content: content
                            }, 
                            function(data){
                               alert("success");
                               $("input[type= 'text']").val("");
                               $("textarea").val("");
                            }
                        );
                    }
                });
            });
        </script>
    </head>
    <body>
        <input type= "text" size= "100"><textarea></textarea><input type= "button" id= "b" value= "OK">
    </body>
</html>