function onSingleBtnClick(){
	$.ajax({
		type: 'post',
		url: 'eventContent.php',
		data:{
			val:1
		}
	}).done(function(message){
		$('#content').html(message);
		console.log('Something 4 message1');
	});	 	
}

function onEventBtnClick(){
	$.ajax({
		type: 'post',
		url: 'eventContent.php',
		data:{
			val:2
		}
	}).done(function(message){
		$('#content').html(message);
		console.log('Something 4 message1');
	});	 	
}

$(document).ready(function(){
	$('#submit').click(function(e){
		e.preventDefault();
		var formData = $('#registration').serialize();
		var html_content = '<div class=transluscent style="background-color:rgba(242, 196, 49, 0.76);color:white;">Registering you...<br/>Please wait for a Second.</div>';
		var flag = check(formData); 
		if(flag == 0)
		{
			$(this).remove();
			$('#content').html(html_content);
			$.ajax({
				type: 'post',
				url: 'registration.php',
				data: formData
			}).done(function(message){
				console.log("test" + message);
				$('#content').html(message);
			});
		}
	});
});	

function check(formData){
	var flag = 0;
	for (var i = 0; i < formData.length-1; i++) {
		if ((formData.charAt(i) == '=' && formData.charAt(i+1) == '&')||(i == (formData.length-1)&& formData.charAt(i+1) == '=')) {
			console.log(formData);
			alert("Empty Fields , Please Recheck.");
			flag = 1;
			break;
		}
	}	
	return flag;
}

function fun(){
	var formData = $('#EventForm').serialize();
	if (formData.length == 0) {
		alert("You must select at least one event before proceeding");
	}else{
		$.ajax({
			type: 'post',
			url: 'eventContent.php',
			data:{ 
				formData: formData
			}
		}).done(function(msg){
			$('#content').html(msg);
		});
	}	
}	

function createTeam(){
	var teamData = $('#teamMember').serialize();
	var flag = check(teamData);
	if (flag == 0) {
		$.ajax({
			type:'post',
			url:'eventContent.php',
			data: teamData
		}).done(function(msg){
			$('#content').html(msg);
		});
	}else{
		alert("Enter valid details of your team members before proceeding");
	}
}