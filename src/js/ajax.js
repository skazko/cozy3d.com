jQuery(document).ready(function($) {	
	$('.loadmore').click(function(){
		$(this).text('Загружаю...');
		var data = {
			'action': 'loadmore',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url: ajaxLoad.ajaxurl,
			data: data,
			type: 'POST',
			success:function(data){
				if( data ) { 
					$('.loadmore').text('Загрузить ещё');
					$('.portfolio__list').append(data);
					current_page++;
					if (current_page == max_pages) $(".portfolio__loadmore").remove();
				} else {
					$('.portfolio__loadmore').remove();
				}
			}
		});
	});
});