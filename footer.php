			</div><!-- END Row -->
		<!-- END CONTENT -->
		</div>
	
	<!-- END Main CONTAINER -->
	</div>

	<footer id="footer">
		<div class="container">
			<div class="inner-footer">

				<div class="footer-menu hidden-xs">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'main-menu', 'menu_class' => 'menu-inline menu-center' ) ); ?>
				</div>
				
				<div id="footer-top" class="clearfix">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
								<div class="widget-footer">
									<div class="title">Thông tin liên hệ</div>
									<div>
										<p>Đ/C: Quisque bibendum condimentum gravida, TP.Hà Nội</p>
										<p>Quisque bibendum condimentum gravida, TP.Hà Nội</p>
										<p>Quisque bibendum condimentum gravida, TP.Hà Nội</p>
										<p>Hotline: 0123 456 789</p>
										<p>Email: <a href="#" target="_top">noithatanthinh@gmail.com</a></p>
									</div>
								</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="widget-footer">
									<div class="title">Về Chúng Tôi</div>
									<ul>
										<li>
											<a href="#">Tiêu chí phát triển</a>
										</li>
										<li>
											<a href="#">Tuyển dụng</a>
										</li>
										<li>
											<a href="#">Góp ý & Khiếu nại</a>
										</li>
										<li>
											<a href="#">Tư vấn miễn phí</a>
										</li>
										<li>
											<a href="#">Giao hàng đúng tiến độ</a>
										</li>
										<li>
											<a href="#">Bảo hành chất lượng SP</a>
										</li>
									</ul>
								</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div>
									<p>
										Donec ut lacus justo. In scelerisque semper orci, id rhoncus arcu. Ut et augue in leo vestibulum malesuada. Maecenas elementum lacinia ligula, sit amet dictum orci venenatis non. Pellentesque non arcu metus. Donec mattis luctus ante sit amet tempus. Vivamus euismod, neque at facilisis dictum, tellus massa sollicitudin mi sollicitudin mi, eu luctus lacus eros blandit mauris.
									</p>

								</div>
								<?php if(!get_theme_mod('slt_footer_share')) : ?>
									<div id="footer-social">
										
										<?php if(get_theme_mod('slt_facebook')) : ?><a href="http://facebook.com/<?php echo esc_html(get_theme_mod('slt_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_twitter')) : ?><a href="http://twitter.com/<?php echo esc_html(get_theme_mod('slt_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_instagram')) : ?><a href="http://instagram.com/<?php echo esc_html(get_theme_mod('slt_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_pinterest')) : ?><a href="http://pinterest.com/<?php echo esc_html(get_theme_mod('slt_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_bloglovin')) : ?><a href="http://bloglovin.com/<?php echo esc_html(get_theme_mod('slt_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_google')) : ?><a href="http://plus.google.com/<?php echo esc_html(get_theme_mod('slt_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_tumblr')) : ?><a href="http://<?php echo esc_html(get_theme_mod('slt_tumblr')); ?>.tumblr.com/" target="_blank"><i class="fa fa-tumblr"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_youtube')) : ?><a href="http://youtube.com/<?php echo esc_html(get_theme_mod('slt_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_dribbble')) : ?><a href="http://dribbble.com/<?php echo esc_html(get_theme_mod('slt_dribbble')); ?>" target="_blank"><i class="fa fa-dribbble"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_soundcloud')) : ?><a href="http://soundcloud.com/<?php echo esc_html(get_theme_mod('slt_soundcloud')); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_vimeo')) : ?><a href="http://vimeo.com/<?php echo esc_html(get_theme_mod('slt_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_linkedin')) : ?><a href="<?php echo esc_html(get_theme_mod('slt_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>
										<?php if(get_theme_mod('slt_rss')) : ?><a href="<?php echo esc_url(get_theme_mod('slt_rss')); ?>" target="_blank"><i class="fa fa-rss"></i></a><?php endif; ?>
									</div>
									<?php endif; ?>
						</div>

				</div>

				
				
				<div id="footer-copyright">
					<p class="copyright"><?php echo wp_kses_post(get_theme_mod('slt_footer_copyright', '&copy; 2016 - Nội Thất An Thịnh. All Rights Reserved. Designed & Developed by PH2.')); ?></p>
				</div>
				
			</div>
		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
	
</body>

</html>