jQuery(document).ready(function(){
	jQuery("#selectNam").on("change",function(){
		jQuery.ajax({
			url:pano_url.url,
			type:'POST',
			async:true,
			data : {
				"action" : 'ajax_pano',
				"nam" : jQuery(this).val(),
			},
			success:function(e){
				console.log(e);
				jQuery("#selectPano").html();
				jQuery("#selectPano").append(e);
			}
		});
	});
});