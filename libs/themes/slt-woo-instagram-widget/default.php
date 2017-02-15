<?php $tag_id = 'instagram_' .rand().time(); ?>
<?php if(isset($user_id) && $user_id && isset($access_token) && $access_token ):?>
<div class="vel-instagram">
 <div class="block">
 	<?php if(isset($title1) && $title1) {?>
	<div class="instagram-title">
		<?php
			echo '<h2>'. $title1 .'</h2>';
		?>
	</div>
	<?php } ?>
  <div class="block_content">
   <div id="<?php echo $tag_id; ?>" class="owl-carousel"></div>
  </div>
 </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		var value_user_id = "<?php echo $user_id; ?>";
		var value_access_token = "<?php echo $access_token; ?>";
		var value_limit = <?php echo $limit; ?>;
		if (value_user_id && value_access_token) {
			var media_users_recent = "https://api.instagram.com/v1/users/" + value_user_id + "/media/recent?access_token=" + value_access_token;
			$.ajax({
				method: "GET",
				dataType: "jsonp",
				cache: false,
				url: media_users_recent,
				success: function (response) {
					var data_image = response.data;
					if (typeof (data_image) == 'undefined') {
						$('#<?php $tag_id ?>').append("<li><?php echo __( 'Please check User ID, Access token or Networking again', TEXTDOMAIN ); ?></li>");
						return;
					}

					if (data_image.length > 0) {
						var html = '';
						for (var i = 0; i < value_limit; i++) {
							if(i < data_image.length){
								html += '<div class="image-instagram">'
										+ '<a class="instagram" target="_blank"  href="' + data_image[i].link + ' ">'
										+	'<img src="' + data_image[i].images.standard_resolution.url + '" alt="" title="" width="<?php echo $width; ?>" height="<?php echo $height; ?>">'
										+ '</a>'
									+'</div>';
							}	
							$('#<?php echo $tag_id; ?>').html(html);
						}
									
						addOwlCarousel($("#<?php echo $tag_id; ?>"));	
					}else {
						$('#<?php echo $tag_id; ?>').append("<li><?php echo __( 'No Image To Show', TEXTDOMAIN ); ?></li>");
						return;
					}
				},
				error: function () {
					$('#<?php echo $tag_id; ?>').append("<li><?php echo __( 'No Image To Show', TEXTDOMAIN ); ?></li>");
				}
			})
		}
		
		function addOwlCarousel(element){
			element.owlCarousel({
				nav:false,
				navContainerClass: 'owl-buttons',
				navText: [ '<i class="icon-arrow-left icons"></i>','<i class="icon-arrow-right icons"></i>' ],
				navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
				dots:false,
				loop:true,
				margin:0,
				responsive:{
					0:{
						items:<?php echo $columns2; ?>,
					},
					768:{
						items:<?php echo $columns1; ?>,
					},
					1024:{
						items:<?php echo $columns; ?>,
					}
				},
			});
		}
	});
</script>
<?php endif;?>