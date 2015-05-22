
<?php
	$cs = Yii::app()->getClientScript();  
	$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.mousewheel.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jcarousellite_1.0.1c4.js', CClientScript::POS_HEAD);
 //   $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/FlexSlider/jquery.flexslider.js', CClientScript::POS_HEAD);
//	$cs->registerCssFile(Yii::app()->theme->baseUrl . '/js/FlexSlider/flexslider.css');
        ?>
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		url : '/index.php/site/getNews',
		dataType: 'xml',
		success: function(data){	
			var i = 2;
			$(data).find('item').each(function() {
				i++;
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
				if(i > 30) return false;
			});
			$('.feedflare').hide();
			$('#feedContent').jCarouselLite({	 
				btnNext: "#news .navigator .next",
				btnPrev: "#news .navigator .prev",
				mouseWheel: true,
				vertical: true,
				hoverPause:true,
				visible: 1,
				auto:4000,
				speed:1000,
			});
			$('.overlay').css('background', 'none');
			$('.overlay').css('zIndex', '-1000');
		}
	});
});
</script>
<style type="text/css">
	#news{
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px; 
		padding: 10px;
		border: solid 1px #DCDCDC;
		margin: 20px 0;
		-webkit-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		-moz-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5); 
	}
	.overlay{
		/* Next 2 lines IE8 */
		background: url('http://flatratelist.com/images/loading_big.gif') no-repeat center center #DCDCDC;
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
		filter: alpha(opacity=50);
		z-index: 10000;
		opacity: .5;
		position: absolute;
		width: 910px;
		height: 200px;
		margin-top: -165px;
		margin-left: -10px;
		padding: 10px;
	}
	.entry a{
		text-transform: uppercase;
		font-weight: bold;
	}
</style>

<div id="homeSliderWrap">
    <div id="homeSliderContainer">

      <div class="flexslider">
             <div id="player" style="float:right;margin-top: 110px;margin-right: 25px;"></div>
<!--             <ul class="slides">
                  <li>
                     <div id="player"></div>
                      </li>
                  <li>
                  <img src="<?php //echo Yii::app()->theme->baseUrl . '/css/images/slide_1.png' ?>" alt=""  data-transition="slideInLeft" />
                </li>
                <li>
                  <img src="<?php// echo Yii::app()->theme->baseUrl . '/css/images/slide_3.png' ?>" alt="" data-transition="slideInLeft" />
                </li>
                <li>
                  <img src="<?php// echo Yii::app()->theme->baseUrl . '/css/images/slide_4.png' ?>" alt="" data-transition="slideInLeft" />
                </li>
                <li>
                  <img src="<?php// echo Yii::app()->theme->baseUrl . '/css/images/slide_5.png' ?>" alt=""  data-transition="slideInLeft" />
                </li>
              <li>
                  <img src="<?php// echo Yii::app()->theme->baseUrl . '/css/images/slide_6.png' ?>" alt=""  data-transition="slideInLeft" />
                </li>
              <li>
                  <img src="<?php// echo Yii::app()->theme->baseUrl . '/css/images/slide_2.png' ?>" alt=""  data-transition="slideInLeft" />
            </li>
              </ul>-->
        </div>
		
	  <!--	<iframe width="720" height="470" src="//www.youtube.com/embed/W7_Juy5tBDQ" frameborder="0" allowfullscreen></iframe> -->
    </div>
    <div id="homeTopForm">
        <div id="priceonly">$147 only</div>
        <div class="start-button" id="startlisting">
        	<?php echo CHtml::link('', Yii::app()->request->baseUrl . '/index.php/listing/mls/create' , array()); ?>
       	</div>
        
        <?php if(Yii::app()->user->isGuest) { ?>
            <div id="quick_login">
                <?php echo CHtml::beginForm(array('user/login')); ?>
                
                    <p><b>MEMBERS LOGIN</b></p>
                    
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($model,'username'); ?>
                        <?php echo CHtml::activeTextField($model,'username') ?>
                    </div>
                    
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($model,'password'); ?>
                        <?php echo CHtml::activePasswordField($model,'password') ?>
                    </div>
                    <br/>
                    <div class="row submit">
                        <?php echo CHtml::submitButton('',array('class'=>'btnlogin')); ?>
                    </div><br/>
                    <p><?php echo CHtml::link('Register', Yii::app()->request->baseUrl .'/index.php/user/registration', array()); ?>&nbsp;|&nbsp;<?php echo CHtml::link('Lost Password', Yii::app()->request->baseUrl .'/index.php/user/recovery/recovery', array()); ?></p>
                    <br/>
                
                <?php echo CHtml::endForm(); ?>
            </div><!-- form -->
		<?php } else { ?>
        	<div id="quick_login_off"></div><!-- form -->
        <?php } ?>
        <div id="broker">
        <span>Have a Real Estate Question?</span><br/>
		<form action="/index.php/site/broker" method="POST">
<!--	        	<a href="<?php echo app()->request->baseUrl; ?>/index.php/site/broker" id="ask_broker">-->
			<input  type="image" src="<?php echo app()->theme->baseUrl . '/css/images/ask_broker.png'; ?>"/>
	            	<?php// echo CHtml::image(app()->theme->baseUrl . '/css/images/ask_broker.png', '', array('height'=>'55px','width'=>'187px')); ?>
	           	<!--</a>-->
			<br/>
			<span style="line-height: 10px; font-size: 12px;"><label><input type="checkbox" checked="checked" name="notify"/>Want to be notified of important changes in real estate?</label></span>
		</form>
        </div>
	</div>
</div>

<div id="news">
	<div id="news-title"><h2>Real Estate News</h2></div>
	<div id="feedContent" style="min-height: 108px;">
		<ul id="news-ticker">
		</ul>
	</div>
	<div class="overlay">&nbsp;</div>
	<div class="navigator">
		<a href="#" class="prev" style="float: left">&laquo; Previous</a>
		<a href="#" class="next" style="float: right">Next &raquo;</a>
		<div style="clear: both"></div>
	</div>
</div>

<style type="text/css">


.msg_list {
	margin: 0px;
	padding: 0px;
	/*width: 383px;*/
}
.msg_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	/*background-color:#FFCCCC;*/
	margin:1px;
}
.msg_body {
	padding: 5px 0px 15px;
	/*background-color:#F4F4F8;*/
}
</style>
<div id="news" class="msg_list">
<p><b>Free Real Estate</b> Listing on the <b>Florida MLS multiple listing service</b> is simply finding and entering data about your home onto a form. Why pay thousands of dollars to realtors to input data. Market your home just like a realtor and pay yourself those thousands of dollars. Our <b>flat fee MLS</b> service is for the do it yourself investor and the real estate savvy home owner. Even licensed real estate agents use our flat rate MLS service. With the same marketing tool that Realtors use you can list your home on the same MLS not an abbreviated version used by some <b>for sale by owner</b> companies. This is the Florida MLS used by realtors in your area.</p>
<p class="msg_head" style ="color:#000099; text-decoration: underline;"><span class="read-more">Read More..</span></p>
	<div class="msg_body">
	<p>Our <b>flat rate MLS</b> service is not a free real estate listing, but almost. Think of it as being even better than a <b>discount real estate service</b>. For $147 you can have an MLS listing, access to forms and contract, and can purchase a professional looking for sale sign. Once on the MLS, 42+ national websites grab your listing from the <b>Listing on MLS</b> and place it on their site. Why is this important? When potential buyers find your home on one of the many public websites, they can deal with you directly. And when they deal with you directly you pay no commissions.</p>

<p>With flatratelist.com there is no up sale. Just get the <b>multiple listing service</b> at an exceptional price. There is no term your <b>MLS listing</b> stays active for as long as you like or until your home sells. Selling your home is a big decision, once you say <b>list my home</b> the hardest step is behind you. And for those that decide a flat fee service is not for you we also offer a full service real estate brokerage that will list and market your home as well as sell your home.</p>

<p>Registration is quick and free so take the next step and get your listing on the MLS. What do you have to lose?</p>

	</div>
</div>
<div id="news">
	Need the help of a full service Realtor? <a href="/index.php/site/broker">Click here</a>
</div>
<script>
  
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '250',
            width: '300',
            videoId: 'W7_Juy5tBDQ',
            events: {
                'onReady': onReady
            }
        });
    }

    function onReady() {
        player.addEventListener('onStateChange', function(e) {  console.log('State is:', e.data);
             if (e.data == 1 ) {
              $('.flexslider').flexslider("pause");
            }else{
              $('.flexslider').flexslider("play");
            }
        });
    }  
    
    $(document).ready(function(){
	//hide the all of the element with class msg_body
	$(".msg_body").hide();
	//toggle the componenet with class msg_body
	$(".msg_head").click(function(){
		$(this).next(".msg_body").slideToggle(600);
		$("span.read-more").hide();
		
	});
        
//        $('.flexslider').flexslider({
//            animation: "slide"
//          });
    });  

</script>