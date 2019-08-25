function SupportAlertHide() {
	$("#SupportMessageSendAlert").hide(200);
}

function SupportClose(surl, id) {
	swal({
		title: 'Destek Talebi Kapatılacak Eminmisiniz?',
		text: "Destek Talebine Cevap Yazarak Tekrar Açabilirsiniz",
		icon: 'info',
		showCancelButton: true,
		buttons: {
			confirm: {
				text: "Kapat",
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
				url: "../operation/admin/support_close",
				data: {"id":id},
				success: function(reply){
					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
					if (reply == '	Destek Talebi Başarıyla Kapatıldı') {
						setTimeout(function(){   
							window.location = surl + "/admin/support";
						}, 2000);
					}
				}
			});
		}
	})
}

function SupportMessageSend(id) {
	$("#SupportMessageSendBtn").attr("disabled","disabled");
	var content	= $("#content").val();
	$.ajax({
		type: "POST",
		url: "../../operation/admin/support_replies",
		data: {"id":id,"content":content},
		success: function(reply){
			$("#SupportMessageSendBtn").removeAttr("disabled");
			$("#SupportMessageSendAlert").show();
			$("#SupportMessageSendAlert").html(reply + '<hr>');
		}
	});
}