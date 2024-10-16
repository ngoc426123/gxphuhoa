$(document).ready(function(){
	$("#slideHome").slick({
		fade:true,
		autoplay:true,
		autoplaySpeed:7000,
		speed:1000,
		arrows:false,
	});
	$("#slideNews").slick({
		autoplay:true,
		autoplaySpeed:6000,
		speed:1000,
		arrows:false,
	});
	$("#slideNewsL").slick({
		slidesToShow:6,
		autoplaySpeed:3000,
		speed:1000,
		arrows:false,
		vertical:true,
		autoplay:true,
	});
	$("#slideVideo").slick({
		slidesToShow:4,
		autoplaySpeed:3500,
		speed:1000,
		arrows:false,
		autoplay:true,
		responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 420,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});
	$(".viewMap").fancybox({
		padding:0,
		width:"100%",
		height:"100%"
	});
	$(window).on("load",function(){
        $('.gridMansory').masonry({
            itemSelector: '.gridMansory .col',
            columnWidth: '.gridMansory .colC',
            percentPosition: true
        });
    });
    // AJAX READMORE
	$("#category-readmore").click(function(){
		var offset=parseInt($(this).attr("data-page"));
		var cate=parseInt($(this).attr("data-cate"));
		$.ajax({
			url:ajax_url.url,
			type:'POST',
			data:{
				action:"category_readmore",
				offset:offset,
				cate:cate,
			},
			async:true,
			beforeSend:function(){
				$(".loading-bg").addClass("active");
				$("html").addClass("openmenu");
			},
			success:function(result){
				$(".listNewsCategory").append(result);
				$(".loading-bg").removeClass("active");
				$("html").removeClass("openmenu");
				offset_news = offset + 10;
				$("#category-readmore").attr("data-page",offset_news);
			}
		});
	});
	// SHARE
	$(".share-facebook").click(function(){
		FB.ui({
	  		method: 'share',
	  		href: ajax_url.url_share,
		}, function(response){});
	});
	$("html").on("click", "#autum-readmore", function(){
		var offset=parseInt($(this).attr("data-page"));
		$.ajax({
			url:ajax_url.url,
			type:'POST',
			data:{
				action:"autum_readmore",
				offset:offset,
			},
			async:true,
			beforeSend:function(){
				$(".loading-bg").addClass("active");
				$("html").addClass("openmenu");
			},
			success:function(result){
				$(".loading-bg").removeClass("active");
				$("html").removeClass("openmenu");
				var s = $(result);
				$(".gridMansory").append(s).masonry('appended', s);
				offset_news = offset + 8;
				$("#autum-readmore").attr("data-page",offset_news);
			}
		});
	});
	$(".desc img").each(function(){
		$(this).attr({
			"width":"",
			"height":"",
			"style":"",
		});
	});
	$(".iAbout").fancybox({
		width:"100%",
		maxWidth:"100%",
		height:"100%",
		maxHeight:"100%",
		autoSize: false,
		fitToView : false,
		padding:0,
		margin:0,
		wrapCSS:"introAbout",
	});
	// function popAdsHome(){
	// 	$.fancybox({
	// 		href:"http://gxphuhoa.org/wp-content/uploads/upload_giaoxu/sinh_nhat_cha_huy.jpg",
	// 		padding:0,
	// 	});
	// }
	// $(window).on("load",function(){
	// 	popAdsHome();
	// });
});