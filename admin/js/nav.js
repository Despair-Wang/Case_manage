$('document').ready(function(){
			$('.cfbtn,#logo,.navbar-nav li a').tooltip();
			$('#logo').click(function(){
				location.href="index.html";
			})
			$('#logo').hover(function(){
				$(this).css({'cursor':'pointer'});				
			})
		})