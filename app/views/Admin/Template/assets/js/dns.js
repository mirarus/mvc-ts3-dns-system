function DNSDelete(surl, id) {
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
				url: "../operation/admin/dns_delete",
				data: {"id":id},
				success: function(reply){
					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
					if (reply == '	DNS Başarıyla Silindi, Lütfen Bekleyiniz!') {
						setTimeout(function(){   
							window.location = surl + "/admin/dns";
						}, 2000);
					}
				}
			});
		}
	})
}
