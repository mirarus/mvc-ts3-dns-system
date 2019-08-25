function SiteSettingsEdit() {
	$("#SiteSettingsEditBtn").attr("disabled","disabled");
	var title		= $("#title").val();
	var description	= $("#description").val();
	var keywords	= $("#keywords").val();
	var footer		= $("#footer").val();

	$.ajax({
		type: "POST",
		url: "../operation/admin/site_settings",
		data: {"title":title,"description":description,"keywords":keywords,"footer":footer},
		success: function(reply){
			$("#SiteSettingsEditBtn").removeAttr("disabled");
			$("#SiteSettingsEditAlert").show();
			$("#SiteSettingsEditAlert").html(reply);
		}
	});
}

function SiteSettingsAlertHide() {
	$("#SiteSettingsEditAlert").hide(200);
}