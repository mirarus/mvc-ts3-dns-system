function DNSSettingsEdit() {
	$("#DNSSettingsEditBtn").attr("disabled","disabled");
	var mail	= $("#mail").val();
	var apikey	= $("#apikey").val();
	var domain	= $("#domain").val();

	$.ajax({
		type: "POST",
		url: "../operation/admin/dns_settings",
		data: {"mail":mail,"apikey":apikey,"domain":domain},
		success: function(reply){
			$("#DNSSettingsEditBtn").removeAttr("disabled");
			$("#DNSSettingsEditAlert").show();
			$("#DNSSettingsEditAlert").html(reply);
		}
	});
}

function DNSSettingsAlertHide() {
	$("#DNSSettingsEditAlert").hide(200);
}