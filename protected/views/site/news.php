<?php
	$cs = Yii::app()->getClientScript();  
	$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jcarousellite_1.0.1c4.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		url : '/index.php/site/getNews',
		success: function(data){
			$(data).find('item').each(function() {
				//name the current found item this for this particular loop run
				var $item = $(this);
				// grab the post title
				var title = $item.find('title').text();
				// grab the post's URL
				var link = $item.find('guid').text();
				// next, the description
				var description = $item.find('description').text();
				//don't forget the pubdate
				var pubDate = $item.find('pubDate').text();
	 
				// now create a var 'html' to store the markup we're using to output the feed to the browser window
				var html = "<li><div class=\"entry\"><h3 class=\"postTitle\">" + title + "<\/h3>";
				html += "<em class=\"date\">" + pubDate + "</em>";
				html += "<p class=\"description\">" + description + "</p>";
				html += "<a href=\"" + link + "\" target=\"_blank\">Read More &raquo;<\/a><\/div></li>";
	 
				//put that feed content on the screen!
				$('#news-ticker').append(html);  
			});
			$('.feedflare').hide();
			$('#feedContent').jCarouselLite({	
				vertical: true,
				hoverPause:true,
				visible: 1,
				auto:500,
				speed:1000
			});
			$('.overlay').css('background', 'none');
			$('.overlay').css('zIndex', '-1000');
		}
	})
});
</script>
<style type="text/css">
	#news{
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px; 
		padding: 10px;
		border: solid 1px;
	}
	.overlay{
		background: url('http://flatratelist.com/images/loading_big.gif') no-repeat center center rgba(220,220,220,0.5);
		z-index: 10000;
		position: absolute;
		width: 910px;
		height: 155px;
		margin-top: -165px;
		margin-left: -10px;
		padding: 10px;
	}
</style>
<div id="news">
	<div id="news-title"><h2>Florida Realtors News</h2></div>
	<div id="feedContent" style="min-height: 108px;">
		<ul id="news-ticker">
			
		</ul>
	</div>
	<div class="overlay">&nbsp;</div>
</div>