<?php 	
include_once('twitteroauth/twitteroauth.php');
	$tag_id = 'twitter_slider_'.rand().time();
	$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);
	$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $twitter_name, 'count' => $limit));	
?>

<?php if($my_tweets) : ?>
<div class="vel-twitter-slider">
 <div class="block">
  <?php if(isset($title) && $title) : ?>
   <div class="title-block">
    <h2><?php echo $title; ?></h2>
   </div>
  <?php endif; ?>
  <div class="block-content">		
	<div id="<?php echo $tag_id; ?>" class="owl-carousel">
		<?php foreach($my_tweets as $tweet) {?>
			<div class="item">
				<span><?php echo wp_trim_words( $tweet->text, $max_length, '...')?></span>
				<div class="read-more">
					<a href="<?php echo $tweet->entities->urls[0]->url; ?>">
						<?php echo $tweet->entities->urls[0]->url; ?>
					</a>
				</div>
				<?php
				  $first_date = strtotime($tweet->created_at);
				  $second_date = time();
				  $datediff = abs($first_date - $second_date);
				?>
				<span><?php echo __('Posted ', 'sellertemplate'); echo floor($datediff / (60*60*24)); echo __(' ago', 'sellertemplate'); ?></span>
			</div>
		<?php }?>
	</div>						
  </div>
 </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		var owl = $('#<?php echo $tag_id; ?>');
		owl.owlCarousel({
			nav:false,
			navContainerClass: 'owl-buttons',
			navText: [ '<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>' ],
			navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
			dots:true,
			loop:false,
			margin:30,
			responsiveClass:true,
			responsive:{
				0:{
					items:<?php echo $columns2; ?>
				},
				480:{
					items:<?php echo $columns1; ?>
				},
				768:{
					items:<?php echo $columns1; ?>
				},
				1024:{
					items:<?php echo $columns; ?>
				}
			},
		});
	});
</script>
<?php endif; ?>

