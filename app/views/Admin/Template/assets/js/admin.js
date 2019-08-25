function AdminCreate() {
	$("#AdminCreateBtn").attr("disabled","disabled");
	var username	= $("#username").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "../../operation/admin/admin_create",
		data: {"username":username,"password":password},
		success: function(reply){
			$("#AdminCreateBtn").removeAttr("disabled");
			$("#AdminCreateAlert").show();
			$("#AdminCreateAlert").html(reply);
		}
	});
}

function AdminAlertHide() {
	$("#AdminCreateAlert").hide(200);
	$("#AdminEditAlert").hide(200);
}

function AdminEdit(id) {
	$("#AdminEditBtn").attr("disabled","disabled");
	var username	= $("#username").val();
	var password	= $("#password").val();
	$.ajax({
		type: "POST",
		url: "../../operation/admin/admin_edit",
		data: {"id":id,"username":username,"password":password},
		success: function(reply){
			$("#AdminEditBtn").removeAttr("disabled");
			$("#AdminEditAlert").show();
			$("#AdminEditAlert").html(reply);
		}
	});
}

function AdminDelete(surl, id) {
	swal({
		title: 'Admin Silinecek Eminmisiniz?',
		text: "Admin Silinecek, Bu İşlemin Geri Dönüşü Yoktur!",
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
				url: "../operation/admin/admin_delete",
				data: {"id":id},
				success: function(reply){

					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
					if (reply == '	Admin Başarıyla Silindi, Lütfen Bekleyiniz!') {
						setTimeout(function(){   
							window.location = surl + "/admin/admins";
						}, 2000);
					}
				}
			});
		}
	})
}
