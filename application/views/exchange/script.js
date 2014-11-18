function scroll(){
	if($(window).scrollTop()> 100){
		$("#toTop").stop(true, false).fadeIn(250);
	}
	else{
		$("#toTop").stop(true, false).fadeOut(250);
	}
}
function login(){
	location.href= 'https://www.facebook.com/dialog/oauth? client_id=692848007448707 &redirect_uri=http://localhost/CodeIgniter/course/ncnu/exchange.htm';
}
function logout(){
	FB.logout(function(response) {
		location.href= "http://localhost/CodeIgniter/course/ncnu.htm";
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
			});
		}
		else{
			$("body").html("");
			login();
		}
	});
}
function bug(){
	$('#myModal').modal();
}
function rSubmit(){
	var btn= $(this);
	if($("#reportContent").val()!= ""){
		$(".loading").show();
		btn.attr('disabled', true);
		FB.api('/me', function(user){
			$.post("http://localhost/CodeIgniter/course/cont/report", 
				{
					uid: user.id, 
					content: $("#reportContent").val()
				}, 
				function(data){
					$(".loading").hide();
					btn.attr('disabled', false);
					$("#modalClose").click();
					$("#reportContent").val("");
				}
			);
		});
	}
}
function setModal(){
	var w= $(document).width();
	if(w> 1180){
		var ml= (w-1180)/2+170+"px";
	}
	else if(w> 970){
		var ml= (w-970)/2+75+"px";
	}
	else if(w> 750){
		var ml= (w-750)/2+175+"px";
	}
	else{
		var ml= "10%";
	}
	$("#cWrap").css("left", ml);
}
function hideModal1(){
	$("#cWrap").animate({"top":"-=1500px"}, 700);
	$("#modal1, #closeModal1").fadeOut(500);
}
function supply(){
	$("#cWrap").animate({"top":"-=1500px"}, 700);
	$("#modal1, #closeModal1").fadeOut(500);
	$("#supplyModal").modal();
}
function demand(){
	$("#cWrap").animate({"top":"-=1500px"}, 700);
	$("#modal1, #closeModal1").fadeOut(500);
	$("#demandModal").modal();
}
function addSCname(){
	$(this).before("<input type= \"text\" class= \"form-control sCname\" placeholder= \"*留白等同無視\">");
}
function supplySubmit(){
	var btn= $(this);
	var count= 0;
	var cname= [];
	var desc= "";
	var want= ["無"];
	$(".sCname").each(function(){
		if($(this).val()!= ""){
			cname[count]= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, '&jonilars;');
			count++;
		}
	});
	if($("#supplyDesc").val()!= ""){
		desc= $("#supplyDesc").val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>").replace(/'/g, '&jonilars;');
	}
	else{
		desc= "無";
	}
	if(count> 0){
		FB.api("/me", function(user){
			$(".loading").show();
			btn.attr('disabled', true);
			var postData= {
				uid: user.id,
				name: user.name, 
				want: JSON.stringify(want),
				have: JSON.stringify(cname), 
				desc: desc
			};
			$.post("http://localhost/CodeIgniter/course/cont/addList", 
				postData, 
				function(){
					// $.get("http://localhost/CodeIgniter/course/cont/getList", function(data){
					// 	$("#list tbody").html(data);
					// 	$("#list tbody tr:eq(0)").click();
					// 	$("#showall").click();
					// 	$(".loading").hide();
					// 	btn.attr('disabled', false);
					// 	$("#supplyModal").click();
					// });

					//start-- ws
					var wantStr= '';
					var haveStr= '';
					$.each(want, function(i, val){
						if(i!= 0){
							wantStr+= '<br>';
						}
						wantStr+= want[i];
					});
					$.each(cname, function(i ,val){
						if(i!= 0){
							haveStr+= '<br>';
						}
						haveStr+= cname[i];
					});
					var msg= {
						'action': 'add', 
						'order': +$('#list tbody tr:eq(0) td:eq(0)').text()+1, 
						'name': postData.name, 
						'want': wantStr, 
						'have': haveStr, 
						'desc': postData.desc
					}
					wsUpdate(msg);
					Server.conn.send(JSON.stringify(msg));
					console.log('wsSend');
					$("#list tbody tr:eq(0)").click();
					$("#showall").click();
					$(".loading").hide();
					btn.attr('disabled', false);
					$("#supplyModal").click();
					//end-- ws
				}
			);
		});
	}
}
function addWant(){
	$(this).before("<input type= \"text\" class= \"form-control want\" placeholder= \"*留白等同無視\">");
}
function demandSubmit(){
	var count= 0;
	var cname= [];
	$(".want").each(function(){
		if($(this).val()!= ""){
			cname[count]= $(this).val();
			count++;
		}
	});
	if(count> 0){
		$("#showall").click();
		$("#list tbody tr").hide();
		for(var i= 0; i< cname.length; i++){
			var select= "#list tbody tr td:nth-child(4):contains('"+cname[i]+"')";
			$(select).parent("tr").show();
		}
		$("#demandModal").click();
		$("#list tbody tr[style= 'display: table-row;']:eq(0)").click();
		$("#showall").append("<button id= \"showallB\" class= \"btn btn-myDefault\">取消過濾</button>");
	}
}
function detail(){
	var id= $(this).children("td:eq(0)").text();
	$("#dDel").html("");
	$("#dEdit").html("");
	$.getJSON("http://localhost/CodeIgniter/course/cont/getDetail", 
		{
			id: id
		}, 
		function(data){
			$("#dId").text("#"+data.id);
			var src= 'http://graph.facebook.com/'+data.uid+'/picture';
			$("#dImg").attr("src", src);
			var href= 'http://fb.com/'+data.uid;
			$("#dA").attr("href", href).text(data.name);
			$("#dTime").text(data.time);
			$("#dWant").html(data.want.replace(/&jonilars;/g, "'"));
			$("#dHave").html(data.have.replace(/&jonilars;/g, "'"));
			$("#dDesc").html(data.desc.replace(/&jonilars;/g, "'"));
			href= 'http://fb.com/messages/'+data.uid;
			$("#message").attr("href", href);
			FB.api('/me', function(user){
				if(data.uid== user.id){
					$("#dDel").html("<button id= \"delB\" class= \"btn btn-myDefault\">刪除</button>");
					$("#dEdit").html("<button id= \"editB\" class= \"btn btn-myDefault\">編輯</button>");
				}
			});
		}
	);
}
function leaveDemand(){
	$("#ldModal").modal();
}
function addldWant(){
	$(this).before("<input type= \"text\" class= \"form-control ldWant\" placeholder= \"*留白等同無視\">");
}
function addldHave(){
	$(this).before("<input type= \"text\" class= \"form-control ldHave\" placeholder= \"*留白等同無視\">");
}
function addeWant(){
	$(this).before("<input type= \"text\" class= \"form-control eWant\" placeholder= \"*留白等同無視\">");
}
function addeHave(){
	$(this).before("<input type= \"text\" class= \"form-control eHave\" placeholder= \"*留白等同無視\">");
}
function ldSubmit(){
	var btn= $(this);
	var count= 0;
	var want= [];
	var count2= 0;
	var have= [];
	var desc= "";
	$(".ldWant").each(function(){
		if($(this).val()!= ""){
			want[count]= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, '&jonilars;');
			count++;
		}
	});
	$(".ldHave").each(function(){
		if($(this).val()!= ""){
			have[count2]= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, '&jonilars;');
			count2++;
		}
	});
	if(count2== 0){
		have[0]= "無";
	}
	if($("#ldDesc").val()== ""){
		desc= "無";
	}
	else{
		desc= $("#ldDesc").val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>").replace(/'/g, '&jonilars;');
	}
	if(count> 0){
		FB.api('/me', function(user){
			$(".loading").show();
			btn.attr('disabled', true);
			var postData= {
				uid: user.id,
				name: user.name, 
				want: JSON.stringify(want),
				have: JSON.stringify(have), 
				desc: desc
			};
			$.post("http://localhost/CodeIgniter/course/cont/addList", 
				postData, 
				function(data){
					// $.get("http://localhost/CodeIgniter/course/cont/getList", function(data){
					// 	$("#list tbody").html(data);
					// 	$("#list tbody tr:eq(0)").click();
					// 	$(".loading").hide();
					// 	btn.attr('disabled', false);
					// 	$("#showall").click();
					// 	$("#ldModal").click();
					// });
					/*start-- ws*/
					var wantStr= '';
					var haveStr= '';
					$.each(want, function(i, val){
						if(i!= 0){
							wantStr+= '<br>';
						}
						wantStr+= want[i];
					});
					$.each(have, function(i ,val){
						if(i!= 0){
							haveStr+= '<br>';
						}
						haveStr+= have[i];
					});
					var msg= {
						'action': 'add', 
						'order': +$('#list tbody tr:eq(0) td:eq(0)').text()+1, 
						'name': postData.name, 
						'want': wantStr, 
						'have': haveStr, 
						'desc': postData.desc
					}
					wsUpdate(msg);
					Server.conn.send(JSON.stringify(msg));
					console.log('wsSend');
					$("#list tbody tr:eq(0)").click();
					$(".loading").hide();
					btn.attr('disabled', false);
					$("#showall").click();
					$("#ldModal").click();
					/*end-- ws*/
				}
			);
		});
	}
}
function delB(){
	if(confirm("確定刪除?")){
		var id= $("#dId").text().replace("#", "");
		FB.api('/me', function(user){
			$.getJSON("http://localhost/CodeIgniter/course/cont/getDetail", 
				{
					id: id
				},
				function(data){
					if(data.uid== user.id){
						$.post("http://localhost/CodeIgniter/course/cont/delList", 
							{
								id: id
							}, 
							function(data){
								// $.get("http://localhost/CodeIgniter/course/cont/getList", function(data){
								// 	$("#list tbody").html(data);
								// 	$("#list tbody tr:eq(0)").click();
								// });
								/* start-- ws */
								var msg= {
									'action': 'del', 
									'id': id
								};
								wsUpdate(msg); 
								Server.conn.send(JSON.stringify(msg));
								console.log('wsSend');
								$("#list tbody tr:eq(0)").click();
								/* end-- ws */
							}
						);
					}
				}
			);
		});
	}
}
function editB(){
	var id= $("#dId").text().replace("#", "");
	$("#editModal").modal();
	var want= $("#dWant").html().split("<br>");
	var have= $("#dHave").html().split("<br>");
	var desc= $("#dDesc").html().replace(/<br>/g, "\n").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
	var count= 0;
	var countW= 0;
	var countH= 0;
	$(".eWant").each(function(){
		countW++;
	});
	$(".eHave").each(function(){
		countH++;
	});
	if(want.length>= countW){
		for(var i= 0; i< want.length-countW; i++){
			$("#addeWant").click();
		}
	}
	if(have.length>= countH){
		for(var i= 0; i< have.length-countH; i++){
			$("#addeHave").click();
		}
	}
	$(".eWant").each(function(index){
		if(index>= want.length){
			$(this).remove();
		}
		else{
			var value= want[count].replace(/&lt;/g, "<").replace(/&gt;/g, ">");
			$(this).val(value);
			count++;
		}
	});
	count= 0;
	$(".eHave").each(function(index){
		if(index>= have.length){
			$(this).remove();
		}
		else{
			var value= have[count].replace(/&lt;/g, "<").replace(/&gt;/g, ">");
			$(this).val(value);
			count++;
		}
	});
	$("#eDesc").val(desc);
}
function eSubmit(){
	var btn= $(this);
	var id= $("#dId").text().replace("#", "");
	FB.api('/me', function(user){
		$.getJSON("http://localhost/CodeIgniter/course/cont/getDetail", 
			{
				id: id
			},function(data){
				if(data.uid== user.id){
					var count= 0;
					var want= [];
					var count2= 0;
					var have= [];
					var desc= "";
					$(".eWant").each(function(){
						if($(this).val()!= ""){
							want[count]= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, '&jonilars;');
							count++;
						}
					});
					$(".eHave").each(function(){
						if($(this).val()!= ""){
							have[count2]= $(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, '&jonilars;');
							count2++;
						}
					});
					if(count2== 0){
						have[0]= "無";
					}
					if($("#eDesc").val()== ""){
						desc= "無";
					}
					else{
						desc= $("#eDesc").val().replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>").replace(/'/g, '&jonilars;');
					}
					if(count> 0){
						$(".loading").show();
						btn.attr('disabled', true);
						var postData= {
							id: id, 
							want: JSON.stringify(want),
							have: JSON.stringify(have), 
							desc: desc
						};
						$.post("http://localhost/CodeIgniter/course/cont/updateList", 
							postData, 
							function(data){
								// $.get("http://localhost/CodeIgniter/course/cont/getList", function(data){
								// 	$("#list tbody").html(data);
								// 	$("#list tbody tr").each(function(){
								// 		if($(this).children("td:eq(0)").text()== id){
								// 			$(this).click();
								// 		}
								// 	});
								// 	$(".loading").hide();
								// 	btn.attr('disabled', false);
								// 	$("#editModal").click();
								// });
								/* start-- ws */
								var wantStr= '';
								$.each(want, function(i, val){
									if(i!= 0){
										wantStr+= '<br>';
									}
									wantStr+= want[i];
								});
								var haveStr= '';
								$.each(have, function(i, val){
									if(i!= 0){
										haveStr+= '<br>';
									}
									haveStr+= have[i];
								})
								var msg= {
									'action': 'edit',
									'id': postData.id, 
									'want': wantStr, 
									'have': haveStr, 
									'desc': postData.desc
								};
								wsUpdate(msg);
								Server.conn.send(JSON.stringify(msg));
								console.log('wsSend');
								$("#list tbody tr").each(function(){
									if($(this).children("td:eq(0)").text()== id){
										$(this).click();
									}
								});
								$(".loading").hide();
								btn.attr('disabled', false);
								$("#editModal").click();
								/* end-- ws */
							}
						);
					}
				}
			}
		);
	});
}
function wsUpdate(msg){
	if(msg.action=== 'add'){
		$('#list tbody').prepend('<tr><td>'+msg.order+'</td><td>'+msg.name+'</td><td>'+msg.want+'</td><td>'+msg.have+'</td><td>'+msg.desc+'</td></tr>');
	}
	else if(msg.action=== 'del'){
		$('#list tbody tr td:first-child:contains('+msg.id+')').each(function(i){
			if($(this).text()=== msg.id){
				$(this).parent().fadeOut(500).remove();
			}
		});
	}
	else if(msg.action=== 'edit'){
		$('#list tbody tr td:first-child:contains('+msg.id+')').each(function(i){
			if($(this).text()=== msg.id){
				$(this).next().next().html(msg.want).next().html(msg.have).next().html(msg.desc);
			}
		});
	}
	else{
		console.log('E');
	}
}
var Server;
$(document).ready(function(){
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
		js.src = "//connect.facebook.net/zh_TW/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
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
	$("#bug").hover(
		function(){
			$(this).stop(true, false).animate({"left":"0px"}, 250);
		}, 
		function(){
			$(this).stop(true, false).animate({"left":"-10px"}, 250);
		}
	);
	$("#reportSubmit").click(rSubmit);
	$("#bug").click(bug);
	setModal();
	$("#supply").click(supply);
	$("#demand").click(demand);
	$("#addSCname").click(addSCname);
	$("#supplySubmit").click(supplySubmit);
	$("#addWant").click(addWant);
	$("#demandSubmit").click(demandSubmit);
	$("#closeModal1").click(hideModal1);
	$("#supplyB").click(supply);
	$("#demandB").click(demand);
	$("#list tbody").on("click", "tr", detail);
	$("#list tbody tr:eq(0)").click();
	$("#leaveDemand").click(leaveDemand);
	$("#addldWant").click(addldWant);
	$("#addldHave").click(addldHave);
	$("#addeWant").click(addeWant);
	$("#addeHave").click(addeHave);
	$("#ldSubmit").click(ldSubmit);
	$("#showall").click(function(){
		$("#list tbody tr").show();
		$("#list tbody tr:eq(0)").click();
		$("#showall").html("");
	});
	$("#dDel").on("click", "#delB", delB);
	$("#dEdit").on("click", "#editB", editB);
	$("#eSubmit").click(eSubmit);
	//ws
	Server= new FancyWebSocket('ws://localhost:9300');
	Server.bind('open', function(){
		console.log('wsConnected');
	});
	Server.bind('close', function(){
		console.log('wsDisconnected')
	});
	Server.bind('message', function(msg){
		try{
			wsUpdate(JSON.parse(msg));
			console.log('wsReceive');
		}
		catch(e){
			console.log('ERR_TYPE_OF_MSG');
		}
	});
	Server.connect();
});
