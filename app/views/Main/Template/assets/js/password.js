function PasswordChange(surl, surl2) {
	swal({
		title: 'Şifre Değişikliği',
        content: {
          element: "input",
          attributes: {
            placeholder: "Yeni Şifrenizi Giriniz.",
            type: "password",
            class: 'form-control'
          },
        },
		showCancelButton: true,
		buttons: {
			confirm: {
				text: "Değiştir",
				value: true,
				visible: true,
				className: "btn btn-success",
				closeModal: false
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
			var password	= $(".swal-content__input").val();
			$.ajax({
				type: "POST",
				url: surl2 + "/operation/user_password",
				data: {"password":password},
				success: function(reply){
					swal({
						title: "İşlem Detayları Aşağıda!",
						text: reply,
						icon: "info",
						button: "Tamam!",
					});
					if (reply == 'Şifreniz Değiştirildi, Lütfen Bekleyiniz!') {
						setTimeout(function(){   
							window.location = surl;
						}, 2000);
					}
				}
			});
		}
	})
}
