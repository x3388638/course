var option= {tolerance: "pointer", drop: dropped } ;
$(document).ready(function(){
	var rowArr= {a: "", b: "", c: "", d: "", e: "", f: "", g: "", h: "", i: "", j: "", k: "", l: "", z: "" }; 
	$.cookie("rowArr", JSON.stringify(rowArr));
	$.cookie("sat", "f");
	$.cookie("sun", "f");
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '692848007448707',
			xfbml      : true,
			version    : 'v2.0'
		});
		loginStatus();
	};
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh-TW/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	$("#cT tbody tr").hide();
	$("#cT tbody tr").each(function(){
		if($(this).children("td:first-child").text()== "中文系"){
			$(this).show();
		}
	});
	$("#stWrap").on("mouseenter", "table td", tdi);
	$("#stWrap").on("mouseleave", "table td", tdl);
	$("#cT").on("click", ".addC", addC);
	$("#cT").on("click", ".summary", summary);
	$("#stWrap").on("click", "tbody td .delC", delC);
	$("#stWrap").on("dblclick", "tbody td", edit);
	$("#colorC").change(colorC);
	$("#color").draggable(
		{
			revert: true
		}
	);
	$("#sT tbody td").droppable(option);
	$("#colorC, #resetC, #ss, #color, #save").tooltip();
	$("#resetC").click(reset);
	$(window).scroll(scroll);
	$("#toTop").hover(
		function(){
			$(this).stop(true, false).animate({"opacity":"1"}, 250);
		}, 
		function(){
			$(this).stop(true, false).animate({"opacity":"0.4"}, 250);
		}
	).click(function(){
		$("body").scrollTo({"top":"0px", "left":"0px"}, 500);
	});
	$("#sclose").click(function(){
		$("#back").slideUp(500);
	});
	$("#search").keyup(search);
	$("#ss").click(screenshot);
    $("#exc").click(excel);
    $("#map").hover(
    	function(){
    		$(this).stop(true, false).animate({"left":"0px"}, 250);
    	}, 
    	function(){
    		$(this).stop(true, false).animate({"left":"-10px"}, 250);
    	}
    );
    $("#bug").hover(
    	function(){
    		$(this).stop(true, false).animate({"left":"0px"}, 250);
    	}, 
    	function(){
    		$(this).stop(true, false).animate({"left":"-10px"}, 250);
    	}
    );
    $("#dept").change(dept);
    $("#editText").blur(function(){
    	var val= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/(?:\r\n|\r|\n)/g, "<br style=\"mso-data-placement:same-cell\";>");
		if(val== ""){
			editcell.prepend("<button type='button' class='close pull-right delC'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>");
			editcell.find(".delC").click().remove();
		}
		editcell.html(val);
		$("#edit").hide();
	});
    $("#save").click(save);
    $("#reportSubmit").click(rSubmit);
    $("#bug").click(bug);
});

function tdi(){
	$(this).addClass("active");
	if($(this).text()!= ""){
		var p= $(this).offset();
		var t= p.top+2+"px";
		var l= p.left+2+"px";
		$(this).prepend("<button type='button' class='close pull-right delC'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>");
	}
}
function tdl(){
	$(this).removeClass("active");
	$(this).children(".delC").remove();
}
function addC(){
	var t= $(this).parent("td").parent("tr").children("td:nth-child(5)").text();
	var location= $(this).parent("td").parent("tr").children("td:nth-child(6)").text();
	var cname= $(this).parent("td").parent("tr").children("td:nth-child(3)").text();
	var teacher= $(this).parent("td").parent("tr").children("td:nth-child(7)").text();
	var arr= [];
	for(var i= 0; i< t.length; i++){
		arr.push(t.charAt(i));
	}
	var wd= arr[0];
	if(wd>= 6){
		if($.cookie('sat')== "f"){
			$("#sT thead tr").append("<th>Sat.</th>");
			$("#sT tbody tr").append("<td></td>");
			$("#sT tbody tr td:last-child").droppable(option);
			$.cookie('sat', 't');
		}
		if(wd== 7){
			if($.cookie('sun')== "f"){
				$("#sT thead tr").append("<th>Sun.</th>");
				$("#sT tbody tr").append("<td></td>");
				$("#sT tbody tr td:last-child").droppable(option);
				$.cookie('sun', 't');
			}
		}
	}
	var err= 0;
	for(var i= 1; i< arr.length; i++){
		var row= arr[i];
		var count= 0;
		var num= $.parseJSON($.cookie("rowArr"))[row];
		for(var j= 0; j< num.length; j++){
			if(num.charAt(j)< wd)
				count++;
			if(num.charAt(j)== wd)
				err++;
		}
		if(err> 0)
			break;
		var new_wd=wd- count;
		var select= "#sT tbody tr[time="+row+"] td:eq("+(new_wd-1)+")";
		if($(select).text().length> 0)
			err++;
	}
	if(err== 0){
		for(var i= 1; i< arr.length; i++){
			var row= arr[i];
			var count= 0;
			var num= $.parseJSON($.cookie("rowArr"))[row];
			for(var j= 0; j< num.length; j++){
				if(num.charAt(j)< wd)
					count++;
			}
			var new_wd=wd- count;
			var select= "#sT tbody tr[time="+row+"] td:eq("+(new_wd-1)+")";
			if(i== 1){
				$(select).html(cname+"<br style='mso-data-placement:same-cell;'>"+location+" "+teacher).prop('rowspan', arr.length-1).css("vertical-align", "middle");
			}
			else{
				$(select).remove();
				var cook= $.parseJSON($.cookie("rowArr"));
				cook[row]+= wd;
				$.cookie("rowArr", JSON.stringify(cook));
			}
		}
	}
	else{
		alert("衝堂");
	}

	/*var t= data.time;
	var arr= [];
	var nth= "";
	var count= 0;
	for(var i= 0; i< t.length; i++){
		if(i== 0){
			var tmp= +t.charAt(i)+1;
			nth= "td:nth-child("+tmp+")";
		}
		else{
			arr.push(t.charAt(i));
		}
	}
	for(var i= 0; i< arr.length; i++){
		var select= "#sT tr[time='"+arr[i]+"']";
		if($(select).children(nth).text().length> 0|| $(select).children(nth).text().length== undefined){
			count++;
		}
	}*/
	// if(count== 0){
	// 	for(var i= 0; i< arr.length; i++){
	// 		var select= "#sT tr[time='"+arr[i]+"']";
	// 		$(select).children(nth).html(data.cid+" "+data.cname+"<br>"+data.location);
	// 	}
	// }
	/*if(1){
		for(var i= 0; i< arr.length; i++){
			var select= "#sT tr[time='"+arr[i]+"']";
			if(i== 0)
				$(select).children(nth).html(data.cid+" "+data.cname+"<br>"+data.location).attr('rowspan', arr.length).css("vertical-align", "middle");
			else
				$(select).children(nth).remove();
		}
	}
	else{
		alert("衝堂");
	}*/
}
function delC(){
    var cell= $(this).parent("td");
    var c= cell.text();
    if(c!= ""){
        cell.css({'background': '', 'color': '#000'});
    	var wd= getWD(cell)+1;
    	var rowspan= cell.prop("rowspan");
		cell.text("").prop("rowspan", 1);
    	if(rowspan>= 2){
    		var row= cell.parent("tr").next("tr").attr("time");
    		var num= $.parseJSON($.cookie("rowArr"))[row];
    		var count= 0;
    		for(var i= 0; i< num.length; i++){
    			if(num.charAt(i)< wd)
    				count++;
    		}
    		var new_wd= wd- count;
    		if((new_wd-2)== -1){
    			cell.parent("tr").next("tr").children("th").after("<td></td>");
    			cell.parent("tr").next("tr").children("th").next("td").droppable(option);
    		}
    		else{
	    		var eq= "td:eq("+(new_wd-2)+")"
	    		cell.parent("tr").next("tr").children(eq).after("<td></td>");
	    		cell.parent("tr").next("tr").children(eq).next("td").droppable(option);
	    	}
    		var cook= $.parseJSON($.cookie("rowArr"));
			cook[row]= cook[row].replace(wd, "");
			$.cookie("rowArr", JSON.stringify(cook));
    		if(rowspan>= 3){
    			row= cell.parent("tr").next("tr").next("tr").attr("time");
    			num= $.parseJSON($.cookie("rowArr"))[row];
    			count= 0;
    			for(var i= 0; i< num.length; i++){
	    			if(num.charAt(i)< wd)
	    				count++;
	    		}
	    		new_wd= wd- count;
	    		if((new_wd-2)== -1){
	    			cell.parent("tr").next("tr").next("tr").children("th").after("<td></td>");
	    			cell.parent("tr").next("tr").next("tr").children("th").next("td").droppable(option);
	    		}
	    		else{
		    		eq= "td:eq("+(new_wd-2)+")"
		    		cell.parent("tr").next("tr").next("tr").children(eq).after("<td></td>");
		    		cell.parent("tr").next("tr").next("tr").children(eq).next("td").droppable(option);
		    	}
		    	cook= $.parseJSON($.cookie("rowArr"));
				cook[row]= cook[row].replace(wd, "");
				$.cookie("rowArr", JSON.stringify(cook));
    		}
    		if(rowspan>= 4){
    			row= cell.parent("tr").next("tr").next("tr").next("tr").attr("time");
    			num= $.parseJSON($.cookie("rowArr"))[row];
    			count= 0;
    			for(var i= 0; i< num.length; i++){
	    			if(num.charAt(i)< wd)
	    				count++;
	    		}
	    		new_wd= wd- count;
	    		if((new_wd-2)== -1){
	    			cell.parent("tr").next("tr").next("tr").next("tr").children("th").after("<td></td>");
	    			cell.parent("tr").next("tr").next("tr").next("tr").children("th").next("td").droppable(option);
	    		}
	    		else{
		    		eq= "td:eq("+(new_wd-2)+")"
		    		cell.parent("tr").next("tr").next("tr").next("tr").children(eq).after("<td></td>");
		    		cell.parent("tr").next("tr").next("tr").next("tr").children(eq).next("td").droppable(option);
		    	}
		    	cook= $.parseJSON($.cookie("rowArr"));
				cook[row]= cook[row].replace(wd, "");
				$.cookie("rowArr", JSON.stringify(cook));
    		}
    		if(rowspan>= 5){
    			row= cell.parent("tr").next("tr").next("tr").next("tr").next("tr").attr("time");
    			num= $.parseJSON($.cookie("rowArr"))[row];
    			count= 0;
    			for(var i= 0; i< num.length; i++){
	    			if(num.charAt(i)< wd)
	    				count++;
	    		}
	    		new_wd= wd- count;
	    		if((new_wd-2)== -1){
	    			cell.parent("tr").next("tr").next("tr").next("tr").next("tr").children("th").after("<td></td>");
	    			cell.parent("tr").next("tr").next("tr").next("tr").next("tr").children("th").next("td").droppable(option);
	    		}
	    		else{
		    		eq= "td:eq("+(new_wd-2)+")"
		    		cell.parent("tr").next("tr").next("tr").next("tr").next("tr").children(eq).after("<td></td>");
		    		cell.parent("tr").next("tr").next("tr").next("tr").next("tr").children(eq).next("td").droppable(option);
		    	}
		    	cook= $.parseJSON($.cookie("rowArr"));
				cook[row]= cook[row].replace(wd, "");
				$.cookie("rowArr", JSON.stringify(cook));
    		}
    		if(rowspan>= 6){
    			row= cell.parent("tr").next("tr").next("tr").next("tr").next("tr").next("tr").attr("time");
    			num= $.parseJSON($.cookie("rowArr"))[row];
    			count= 0;
    			for(var i= 0; i< num.length; i++){
	    			if(num.charAt(i)< wd)
	    				count++;
	    		}
	    		new_wd= wd- count;
	    		if((new_wd-2)== -1){
	    			cell.parent("tr").next("tr").next("tr").next("tr").next("tr").next("tr").children("th").after("<td></td>");
	    			cell.parent("tr").next("tr").next("tr").next("tr").next("tr").next("tr").children("th").next("td").droppable(option);
	    		}
	    		else{
		    		eq= "td:eq("+(new_wd-2)+")"
		    		cell.parent("tr").next("tr").next("tr").next("tr").next("tr").next("tr").children(eq).after("<td></td>");
		    		cell.parent("tr").next("tr").next("tr").next("tr").next("tr").next("tr").children(eq).next("td").droppable(option);
		    	}
		    	cook= $.parseJSON($.cookie("rowArr"));
				cook[row]= cook[row].replace(wd, "");
				$.cookie("rowArr", JSON.stringify(cook));
    		}
    	}

    	
    	// var this_row= $(this).parent("tr").attr("time");
    	// var num= $.parseJSON($.cookie("rowArr"))[this_row];
    	// var order= $(this).index();
    	// var count= 0;
    	// for(var i= 0; i< num.length; i++){
    	// 	if(num.charAt(i)<= order)
    	// 		count++;
    	// }
    	// order+= count;
    	// alert("order: "+order+" num: "+num);
    	// var rowspan= $(this).text("").prop("rowspan");
    	// 
    	// $(this).text("").prop("rowspan", 1);
    	// if(rowspan>= 2){
    	// 	var row= $(this).parent("tr").next("tr").attr("time");
    	// 	$.parseJSON($.cookie("rowArr"));
    	// 	if(rowspan== 3){
    	// 		//
    	// 	}
    	// }
    	








    	/*var order= $(this).index();
    	var rowspan= $(this).prop("rowspan");
    	var nth= "td:nth-child("+order+")";
    	$(this).text("");
    	if(rowspan>= 2){
    		$(this).prop("rowspan", 1);
    		$(this).parent("tr").next("tr").children(nth).after("<td>123</td>");
    		if(rowspan== 3){
    			$(this).parent("tr").next("tr").next("tr").children(nth).after("<td>456</td>");
    		}
    	}*/
	    // var select= "#sT tbody td:contains('"+c+"')";
	    // $(select).text("");
	}
}
function colorC(){
	var col= $(this).val();
	$("#color").css("background", col);
}
function reset(){
	$("#sT tbody td").css({"background":"", "color":"#000"});
}
function scroll(){
	if($(window).scrollTop()> 100){
		$("#toTop").stop(true, false).fadeIn(250);
	}
	else{
		$("#toTop").stop(true, false).fadeOut(250);
	}
}
function summary(){
	var cid= $(this).parent("td").parent("tr").children("td:eq(1)").text();
	var classes= $(this).parent("td").parent("tr").children("td:eq(3)").text();
	$.getJSON("http://localhost/CodeIgniter/course/index.php/cont/ajax", 
		{
			cid: cid, 
			classes: classes
		}, 
		function(data){
			var content= data.content;
			content= content.replace(/(?:\r\n|\r|\n)/g, "<br><br>");
			$("#scontent").html(content);
			$("#back").slideDown(500);
		}
	);
}
function search(){
    var val= $(this).val().trim();
    if(val== ""){
    	$("#cT tbody tr").show();
    }
    else{
    	$("#cT tbody tr").hide();
    	var select= "#cT tbody td:contains('"+val+"')";
    	$(select).parent("tr").show();
    }
}
function screenshot(){
	html2canvas($("#sT"), {
	    onrendered: function(canvas) {
	        $("#sscanvas").html(canvas);
	    }
	});
	html2canvas($("#sT"), {
	    onrendered: function(canvas) {
	        Canvas2Image.saveAsPNG(canvas);
	    }
	});
}
function excel(e){
	var html= "<html><head><meta charset= 'utf-8'></head><body>"+$('#stWrap').html()+"</body></html>";
	window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    e.preventDefault();
}
function dept(){
	var dept= $(this).val();
	if(dept== -1){
		$("#cT tbody tr").show();
	}
	else{
		$("#cT tbody tr").hide();
		$("#cT tbody tr").each(function(){
			if($(this).children("td:first-child").text()== dept){
				$(this).show();
			}
		});
	}
}
function dropped(event, ui){
	var color= $(ui.draggable).css("background-color"); 
	$(this).css("background", color); 
	color= color.replace("rgb(", "").replace(")", "");
	var cArr= color.split(", "),
	    r= cArr[0], 
	    g= cArr[1], 
	    b= cArr[2];
	var bri= Math.sqrt(r* r* 0.241+ g* g* 0.691+ b* b* 0.068);
	if(bri> 125){
		$(this).css("color", "#000");
	}
	else{
		$(this).css("color", "#fff");
	}
}
function getWD(cell){
	var cols = cell.closest("tr").children("td").index(cell);
    var rows = cell.closest("tbody").children("tr").index(cell.closest("tr"));
    var coltemp = cols;
    var rowtemp = rows;

    cell.prevAll("td").each(function() {
        cols += ($(this).attr("colspan")) ? parseInt($(this).attr("colspan")) - 1 : 0;
    });

    cell.parent("tr").prevAll("tr").each(function() {
        //get row index for search cells
        var rowindex = cell.closest("tbody").children("tr").index($(this));
        // assign the row to a variable for later use
        var row = $(this);
        row.children("td").each(function() {
            // fetch all cells of this row
            var colindex = row.children("td").index($(this));
            //check if this cell comes before our cell
            if (cell.offset().left > $(this).offset().left) {
                // check if it has both rowspan and colspan, because the single ones are handled before
                var colspn = parseInt($(this).attr("colspan"));
                var rowspn = parseInt($(this).attr("rowspan"));
                if (colspn && rowspn) {
                    if(rowindex + rowspn > rows)
                    cols += colspn;                    
                }
                if(rowspn && rowindex + rowspn > rows) cols +=1;
            }

        });
    });
    return cols;
}
var editcell;
function edit(){
	if($(this).text()!= ""){
		editcell= $(this);
		var ori= $(this).html()
			.replace("<button type=\"button\" class=\"close pull-right delC\"><span aria-hidden=\"true\">×</span><span class=\"sr-only\">Close</span></button>", "")
			.replace(/<br style=\"mso-data-placement:same-cell;\">/g, "\n")
			.replace(/<br style=\"mso-data-placement:same-cell\" ;=\"\">/g, "\n")
			.replace(/&lt;/g, "<")
			.replace(/&gt;/g, ">");
		var p= $(this).offset();
		var t= p.top+10+"px",
		    l= p.left+5+"px";
		$("#edit").css({"top":t, "left":l}).show();
		$("#editText").val(ori).focus();
	}
}
// new
function login(){
	FB.login(function(response) {
		if (response.authResponse) {
			location.reload();
		}
	});
}
function logout(){
	FB.logout(function(response) {
		location.reload();
	});
}
function loginStatus(){
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			var identity = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			FB.api('/me', function(user){
				var str= "<span id= 'user'>Hi , <a href= 'http://fb.com/"+user.id+"' target= '_blank'>"+user.name+"</a></span><a href= \"javascript:logout();\"> 登出</a>";
				$("#fbWrap").html(str);
				$("#save").html("<button class= \"btn btn-myDefault\"><span class=\"glyphicon glyphicon-floppy-disk\"></span></button>");
				$("#bug").show();
				$.getJSON("http://localhost/CodeIgniter/course/cont/get", 
					{
						uid: user.id
					}, 
					function(data){
						if(data.status== "true"){
							$("#stWrap").html(data.html);
							$("#sT tbody td").droppable(option);
							$.cookie('sat', data.sat);
							$.cookie('sun', data.sun);
							$.cookie('rowArr', data.rowArr);
						}
					}
				);
			});
		}
		else{
			$("#fbWrap").html("<a href= \"javascript:login();\">facebook 登入</a>");
		}
	});
}
function save(){
	var html= $("#stWrap").html();
	var Sat= $.cookie('sat');
	var Sun= $.cookie('sun');
	var rowArr= $.cookie("rowArr");
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			FB.api('/me', function(user){
				$.post("http://localhost/CodeIgniter/course/cont/set", 
					{
						uid: user.id, 
						html: html, 
						rowArr: rowArr,
						Sat: Sat, 
						Sun: Sun
					}, 
					function(data){
						alert("記住你");
					}
				);
			});
		}
	});
}
function bug(){
	$('#myModal').modal();
}
function rSubmit(){
	if($("#reportContent").val()!= ""){
		$("#loading").show();
		FB.api('/me', function(user){
			$.post("http://localhost/CodeIgniter/course/cont/report", 
				{
					uid: user.id, 
					content: $("#reportContent").val()
				}, 
				function(data){
					$("#loading").hide();
					$("#modalClose").click();
					$("#reportContent").val("");
				}
			);
		});
	}
}