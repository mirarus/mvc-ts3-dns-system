function Login() {
	$("#LoginBtn").attr("disabled","disabled");
	var username	= $("#username").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "../operation/admin/login",
		data: {"username":username,"password":password},
		success: function(reply){
			$("#LoginBtn").removeAttr("disabled");
			$("#LoginAlert").show();
			$("#LoginAlert").html(reply);
		}
	});
}

function UserCreate() {
	$("#UserCreateBtn").attr("disabled","disabled");
	var mail		= $("#mail").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "../../operation/admin/user_create",
		data: {"mail":mail,"password":password},
		success: function(reply){
			$("#UserCreateBtn").removeAttr("disabled");
			$("#UserCreateAlert").show();
			$("#UserCreateAlert").html(reply);
		}
	});
}

function UserAlertHide() {
	$("#UserCreateAlert").hide(200);
	$("#UserEditAlert").hide(200);
}

function UserEdit(id) {
	$("#UserEditBtn").attr("disabled","disabled");
	var mail		= $("#mail").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "../../operation/admin/user_edit",
		data: {"id":id,"mail":mail,"password":password},
		success: function(reply){
			$("#UserEditBtn").removeAttr("disabled");
			$("#UserEditAlert").show();
			$("#UserEditAlert").html(reply);
		}
	});
}

function UserDelete(surl, id) {
	swal({
		title: 'Üye Silinecek Eminmisiniz?',
		text: "Üye Silinecek, Bu İşlemin Geri Dönüşü Yoktur!",
		icon: 'info',
		showCancelButton: true,
		buttons: {
			confirm: {
				text: "Sil",
				value: true,
				visible: true,
				className: "btn btn-success",
				closeModal: true
			},
			cancel: {
				text: "İptal",
				value: null,
				visible: true,
				className: "btn btn-danger",
				closeModal: true,
			}
		}
	}).then(function(isConfirm) {
		if (isConfirm) {
			$.ajax({
				type: "POST",
				url: "../operation/admin/user_delete",
				data: {"id":id},
				success: function(reply){
					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
					if (reply == '	Üye Başarıyla Silindi, Lütfen Bekleyiniz!') {
						setTimeout(function(){   
							window.location = surl + "/admin/users";
						}, 2000);
					}
				}
			});
		}
	})
}