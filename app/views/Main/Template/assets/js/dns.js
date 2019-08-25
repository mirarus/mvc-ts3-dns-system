function DNSCreate() {
	$("#DNSCreateBtn").attr("disabled","disabled");
	var name	= $("#name").val();
	var domain	= $("#domain").val();
	var ip		= $("#ip").val();
	var port	= $("#port").val();
	$.ajax({
		type: "POST",
		url: "../operation/dns_create",
		data: {"name":name,"domain":domain,"ip":ip,"port":port},
		success: function(reply){
			$("#DNSCreateBtn").removeAttr("disabled");
			$("#DNSCreateAlert").show();
			$("#DNSCreateAlert").html(reply);
		}
	});
}

function DNSAlertHide() {
	$("#DNSCreateAlert").hide(200);
}

function DNSDelete(id) {
	swal({
		title: 'DNS Silinecek Eminmisiniz?',
		text: "DNS Silinecek, Bu İşlemin Geri Dönüşü Yoktur!",
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
				url: "operation/dns_delete",
				data: {"id":id},
				success: function(reply){
					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
				}
			});
		}
	})
}
