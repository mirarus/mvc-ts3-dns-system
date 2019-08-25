function Login() {
	$("#LoginBtn").attr("disabled","disabled");
	var mail		= $("#mail").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "operation/login",
		data: {"mail":mail,"password":password},
		success: function(reply){
			$("#LoginBtn").removeAttr("disabled");
			$("#LoginAlert").show();
			$("#LoginAlert").html(reply);
		}
	});
}

function SignUp() {
	$("#SignUpBtn").attr("disabled","disabled");
	var mail		= $("#mail").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "operation/signup",
		data: {"mail":mail,"password":password},
		success: function(reply){
			$("#SignUpBtn").removeAttr("disabled");
			$("#SignUpAlert").show();
			$("#SignUpAlert").html(reply);
		}
	});
}