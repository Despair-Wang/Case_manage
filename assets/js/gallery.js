// JavaScript Document
$(function(){   
		  
	var interval;
	$(".containermk2 img").click(function cover(){
			$(this).addClass("zoom").fadeOut(700,append);		
			function append(){
			$(this).removeClass("zoom").appendTo(".containermk2").show();
			var name = $(".containermk2").children("img").first().attr("alt");
			 $(".name p").text(name);
			}	
	  
	})
	
	function auto(){
			var play = $(".containermk2").children("img").first();
			play.addClass("zoom").fadeOut(700,append);		
			function append(){
			$(this).removeClass("zoom").appendTo(".containermk2").show();
			var name = $(this).parent().children("img").first().attr("alt");
			 $(".name p").text(name);
			}
			interval = setTimeout(auto,5000);
	}
	
	$(".containermk2 img").hover(function(){
			stopPlay();
	},function(){
			interval = setTimeout(auto,5000);
	})
	
	function stopPlay(){
		clearTimeout(interval)
	}
	auto();
					
})