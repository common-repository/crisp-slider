<?php
/*
 * @author    Crisp Themes
 * @copyright Copyright (c) 2017, Crisp Themes, https://www.crispthemes.com
 * @license   http://en.wikipedia.org/wiki/MIT_License The MIT License
*/

function crisp_slider_shortcode($atts) {  
	ob_start();
	
	extract( shortcode_atts( array(
        'p' => '',
    ), $atts ) );

	$postid = $atts['id'];

	$slider_type = get_post_meta($postid, 'crisp_slider_type', true);
	$slider_width = get_post_meta($postid, 'crisp_slider_width', true);
	if (!$slider_width) {
		$slider_width = '100%';
	}
	$slider_controls = get_post_meta($postid, 'crisp_slider_controls', true);
	$slider_control_bgtype = get_post_meta($postid, 'crisp_slider_control_bgtype', true);
	$slider_control_bgcolor = get_post_meta($postid, 'crisp_slider_control_bgcolor', true);
	$slider_control_bgopacity = get_post_meta($postid, 'crisp_slider_control_bgopacity', true);
	$slider_control_arrcolor = get_post_meta($postid, 'crisp_slider_control_arrcolor', true);
	$slider_pager_style = get_post_meta($postid, 'crisp_slider_pager_style', true);
	$slider_bullet_type = get_post_meta($postid, 'crisp_slider_bullet_type', true);
	$slider_bullet_color = get_post_meta($postid, 'crisp_slider_bullet_color', true);
	$slider_abullet_color = get_post_meta($postid, 'crisp_slider_abullet_color', true);
	$slider_bullet_bg = get_post_meta($postid, 'crisp_slider_bullet_bg', true);
	$slider_bullet_tcolor = get_post_meta($postid, 'crisp_slider_bullet_tcolor', true);
	$slider_abullet_bg = get_post_meta($postid, 'crisp_slider_abullet_bg', true);
	$slider_sbullet_tcolor = get_post_meta($postid, 'crisp_slider_sbullet_tcolor', true);
	$slider_pager_position = get_post_meta($postid, 'crisp_slider_pager_position', true);
	$slider_pager_hposition = get_post_meta($postid, 'crisp_slider_pager_hposition', true);
	$slider_pager_vposition = get_post_meta($postid, 'crisp_slider_pager_vposition', true);
	$crisp_slider_arrcolor = get_post_meta($postid, 'crisp_slider_control_arrcolor', true);
	
	if ($slider_control_bgtype == 'transparent') {
		if ($slider_control_bgcolor) {
			$slider_control_bgcolor = substr($slider_control_bgcolor, 1);
			list($r,$g,$b) = array_map('hexdec',str_split($slider_control_bgcolor, 2));
			$rgb = $r . ', ' . $g . ', ' . $b;
		}
	} ?>
	
	<div class="crisp-slider-wrap">
		<style type="text/css">
			#slider-<?php echo $postid; ?> {
				max-width: <?php echo $slider_width; ?>;
				margin: 0 auto;
				line-height: 1;
				word-wrap: normal;
			}

			#slider-<?php echo $postid; ?> ul, #slider-<?php echo $postid; ?> ul li {
				margin: 0;
				padding: 0;
			}

			#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager {
				<?php if ($slider_pager_position == 'inside' && $slider_pager_vposition == 'bottom') { ?>
					bottom: 20px;
				<?php } ?>
				<?php if ($slider_pager_position == 'inside' && $slider_pager_vposition == 'top') { ?>
					bottom: auto;
					top: 0;
				<?php } ?>
				<?php if ($slider_pager_hposition == 'right') { ?>
					<?php if ($slider_pager_position == 'inside') { ?>
						padding-right: 20px;
					<?php } ?>
				<?php } elseif ($slider_pager_hposition == 'left') { ?>
					<?php if ($slider_pager_position == 'inside') { ?>
						padding-left: 20px;
					<?php } ?>
				<?php } ?>
			}

			#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager a {
				<?php if ($slider_bullet_type == 'square') { ?>
					-moz-border-radius: 0;
					-webkit-border-radius: 0;
					border-radius: 0;
				<?php } ?>
				<?php if ($slider_pager_style == 'number') { ?>
					text-indent: 0;
					width: 20px;
					height: 20px;
					text-align: center;
					padding: 5px 0;
					line-height: 1;
					font-size: 11px;
					<?php if ($slider_bullet_bg) { ?>
						background: <?php echo $slider_bullet_bg; ?>;
					<?php } else { ?>
						background: #ccc;
					<?php } ?>
					<?php if ($slider_bullet_tcolor) { ?>
						color: <?php echo $slider_bullet_tcolor; ?>;
					<?php } else { ?>
						color: #111;
					<?php } ?>
				<?php } elseif ($slider_pager_style == 'bullet') { ?>
					<?php if ($slider_bullet_color) { ?>
						background: <?php echo $slider_bullet_color; ?>;
					<?php } ?>
				<?php } ?>
			}

			#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager a:hover, #slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager a.active {
				<?php if ($slider_pager_style == 'number') { ?>
					<?php if ($slider_abullet_bg) { ?>
						background: <?php echo $slider_abullet_bg; ?>;
					<?php } else { ?>
						background: #111;
					<?php } ?>
					<?php if ($slider_sbullet_tcolor) { ?>
						color: <?php echo $slider_sbullet_tcolor; ?>;
					<?php } else { ?>
						color: #fff;
					<?php } ?>
				<?php } elseif ($slider_pager_style == 'bullet') { ?>
					<?php if ($slider_abullet_color) { ?>
						background: <?php echo $slider_abullet_color; ?>;
					<?php } else { ?>
						background: #111111;
					<?php } ?>
				<?php } ?>
			}

			#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager {
				text-align: <?php echo $slider_pager_hposition; ?>;
			}

			<?php if ($slider_pager_hposition == 'left') { ?>
				#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager .bx-pager-item:first-child a {
					margin-left: 0;
				}
			<?php } elseif ($slider_pager_hposition == 'right' && $slider_pager_style == 'bullet') { ?>
				#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager .bx-pager-item:last-child a {
					margin-right: 0;
				}

				#slider-<?php echo $postid; ?> .bx-wrapper .bx-pager.bx-default-pager a {
					text-indent: 9999px;
				}
			<?php } ?>

			<?php if ($slider_controls == 'true') { ?>
				<?php if ($slider_control_bgtype == 'solid') { ?>
					<?php if ($slider_control_bgcolor) { ?>
						#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
							background: <?php echo $slider_control_bgcolor; ?>;
						}
					<?php } else { ?>
						#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
							background: #111;
						}
					<?php } ?>
				<?php } elseif ($slider_control_bgtype == 'transparent') { ?>
					<?php if ($slider_control_bgcolor) { ?>
						<?php if ($slider_control_bgopacity) { ?>
							#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
								background: rgba(<?php echo $rgb; ?>, <?php echo $slider_control_bgopacity; ?>);
							}
						<?php } else { ?>
							#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
								background: rgba(<?php echo $rgb; ?>, 0.8);
							}
						<?php } ?>
					<?php } else { ?>
						<?php if ($slider_control_bgopacity) { ?>
							#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
								background: rgba(0, 0, 0, <?php echo $slider_control_bgopacity; ?>);
							}
						<?php } else { ?>
							#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a {
								background: rgba(0, 0, 0, 0.8);
							}
						<?php } ?>
					<?php } ?>
				<?php } ?>
			<?php } ?>

			<?php if ($crisp_slider_arrcolor) { ?>
				#slider-<?php echo $postid; ?> .bx-wrapper .bx-controls-direction a span {
					color: <?php echo $crisp_slider_arrcolor; ?>;
				}
			<?php } ?>
		</style>

		<?php
		$ids = get_post_meta($postid, 'vdw_gallery_id', true); ?>
		<div id="slider-<?php echo $postid; ?>" class="crisp-slider">
			<ul>
				<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value, 'full'); ?>
					<li><img src="<?php echo $image[0]; ?>"></li>
				<?php endforeach; endif; ?>
			</ul>
		</div>

		<?php 
		$crisp_slider_type = get_post_meta($postid, 'crisp_slider_type', true);
		$crisp_slider_mode = esc_html(get_post_meta($postid, 'crisp_slider_mode', true));
		$crisp_slider_auto = esc_html(get_post_meta($postid, 'crisp_slider_auto', true));
		$crisp_slider_interval = (int)get_post_meta($postid, 'crisp_slider_interval', true);
		$crisp_slider_controls = esc_html(get_post_meta($postid, 'crisp_slider_controls', true));
		$crisp_slider_pager = esc_html(get_post_meta($postid, 'crisp_slider_pager', true));
		$crisp_slider_transition = (int)get_post_meta($postid, 'crisp_slider_transition', true);
		$crisp_slider_carousel_elements = get_post_meta($postid, 'crisp_slider_carousel_elements', true);
		$crisp_slider_carousel_spacing = get_post_meta($postid, 'crisp_slider_carousel_spacing', true);
		?>	
		
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			if ($(window).width() < 569) {
		        var crispslider = $('#slider-<?php echo $postid; ?> ul').bxSlider({ 
		            <?php if ($crisp_slider_type == 'carousel') { ?>
						minSlides: 1,
					    maxSlides: 1,
						slideWidth: 500,
						<?php if ($crisp_slider_carousel_spacing) { ?>
							slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
						<?php } else { ?>
							slideMargin: 30,
						<?php } ?>
						pager: false,
						moveSlides: 1,
					<?php } else { ?>
						mode: '<?php echo $crisp_slider_mode; ?>',
						<?php if ($crisp_slider_pager == 'false') { ?>
							pager: false,
						<?php } ?>
						adaptiveHeight: true,
					<?php } ?>
					<?php if ($crisp_slider_transition) { ?>
						speed: <?php echo $crisp_slider_transition; ?>,
					<?php } else { ?>
						<?php if ($crisp_slider_mode == 'fade') { ?>
							speed: 800,
						<?php } else { ?>
							speed: 500,
						<?php } ?>
					<?php } ?>
					<?php if ($crisp_slider_controls == 'true') { ?>
						nextText: '<span class="icon-chevron-right"></span>',
						prevText: '<span class="icon-chevron-left"></span>',
					<?php } elseif ($crisp_slider_controls == 'false') { ?>
						controls: false,
					<?php } ?>
					<?php if ($crisp_slider_auto == 'true') { ?>
						auto: true,
						<?php if ($crisp_slider_interval) { ?>
							pause: <?php echo $crisp_slider_interval; ?>,
						<?php } else { ?>
							pause: 4000,
						<?php } ?>
					<?php } ?>
		        });
		    } else if ($(window).width() < 831) {
		        var crispslider = $('#slider-<?php echo $postid; ?> ul').bxSlider({ 
		            <?php if ($crisp_slider_type == 'carousel') { ?>
						minSlides: 2,
					    maxSlides: 2,
						slideWidth: 500,
						<?php if ($crisp_slider_carousel_spacing) { ?>
							slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
						<?php } else { ?>
							slideMargin: 30,
						<?php } ?>
						pager: false,
						moveSlides: 1,
					<?php } else { ?>
						mode: '<?php echo $crisp_slider_mode; ?>',
						<?php if ($crisp_slider_pager == 'false') { ?>
							pager: false,
						<?php } ?>
						adaptiveHeight: true,
					<?php } ?>
					<?php if ($crisp_slider_transition) { ?>
						speed: <?php echo $crisp_slider_transition; ?>,
					<?php } else { ?>
						<?php if ($crisp_slider_mode == 'fade') { ?>
							speed: 800,
						<?php } else { ?>
							speed: 500,
						<?php } ?>
					<?php } ?>
					<?php if ($crisp_slider_controls == 'true') { ?>
						nextText: '<span class="icon-chevron-right"></span>',
						prevText: '<span class="icon-chevron-left"></span>',
					<?php } elseif ($crisp_slider_controls == 'false') { ?>
						controls: false,
					<?php } ?>
					<?php if ($crisp_slider_auto == 'true') { ?>
						auto: true,
						<?php if ($crisp_slider_interval) { ?>
							pause: <?php echo $crisp_slider_interval; ?>,
						<?php } else { ?>
							pause: 4000,
						<?php } ?>
					<?php } ?>
		        });
		    } else if ($(window).width() >= 831) {
		        var crispslider = $('#slider-<?php echo $postid; ?> ul').bxSlider({ 
		            <?php if ($crisp_slider_type == 'carousel') { ?>
						<?php if ($crisp_slider_carousel_elements) { ?>
				        	minSlides: <?php echo $crisp_slider_carousel_elements; ?>,
				            maxSlides: <?php echo $crisp_slider_carousel_elements; ?>,
						<?php } else { ?>
				        	minSlides: 3,
			            	maxSlides: 3,
				        <?php } ?>
						slideWidth: 500,
						<?php if ($crisp_slider_carousel_spacing) { ?>
							slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
						<?php } else { ?>
							slideMargin: 30,
						<?php } ?>
						pager: false,
						moveSlides: 1,
					<?php } else { ?>
						mode: '<?php echo $crisp_slider_mode; ?>',
						<?php if ($crisp_slider_pager == 'false') { ?>
							pager: false,
						<?php } ?>
						adaptiveHeight: true,
					<?php } ?>
					<?php if ($crisp_slider_transition) { ?>
						speed: <?php echo $crisp_slider_transition; ?>,
					<?php } else { ?>
						<?php if ($crisp_slider_mode == 'fade') { ?>
							speed: 800,
						<?php } else { ?>
							speed: 500,
						<?php } ?>
					<?php } ?>
					<?php if ($crisp_slider_controls == 'true') { ?>
						nextText: '<span class="icon-chevron-right"></span>',
						prevText: '<span class="icon-chevron-left"></span>',
					<?php } elseif ($crisp_slider_controls == 'false') { ?>
						controls: false,
					<?php } ?>
					<?php if ($crisp_slider_auto == 'true') { ?>
						auto: true,
						<?php if ($crisp_slider_interval) { ?>
							pause: <?php echo $crisp_slider_interval; ?>,
						<?php } else { ?>
							pause: 4000,
						<?php } ?>
					<?php } ?>
		        });
		    }

			<?php if ($crisp_slider_type == 'carousel') { ?>
				$(window).on('resize', function(){
					if ($(window).width() < 569) {
				        crispslider.reloadSlider({
				            <?php if ($crisp_slider_type == 'carousel') { ?>
								minSlides: 1,
							    maxSlides: 1,
								slideWidth: 500,
								<?php if ($crisp_slider_carousel_spacing) { ?>
									slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
								<?php } else { ?>
									slideMargin: 30,
								<?php } ?>
								pager: false,
								moveSlides: 1,
							<?php } else { ?>
								mode: '<?php echo $crisp_slider_mode; ?>',
								<?php if ($crisp_slider_pager == 'false') { ?>
									pager: false,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_transition) { ?>
								speed: <?php echo $crisp_slider_transition; ?>,
							<?php } else { ?>
								<?php if ($crisp_slider_mode == 'fade') { ?>
									speed: 800,
								<?php } else { ?>
									speed: 500,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_controls == 'true') { ?>
								nextText: '<span class="icon-chevron-right"></span>',
								prevText: '<span class="icon-chevron-left"></span>',
							<?php } elseif ($crisp_slider_controls == 'false') { ?>
								controls: false,
							<?php } ?>
							<?php if ($crisp_slider_auto == 'true') { ?>
								auto: true,
								<?php if ($crisp_slider_interval) { ?>
									pause: <?php echo $crisp_slider_interval; ?>,
								<?php } else { ?>
									pause: 4000,
								<?php } ?>
							<?php } ?>
				        });
				    } else if ($(window).width() < 831) {
				        crispslider.reloadSlider({
				            <?php if ($crisp_slider_type == 'carousel') { ?>
								minSlides: 2,
							    maxSlides: 2,
								slideWidth: 500,
								<?php if ($crisp_slider_carousel_spacing) { ?>
									slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
								<?php } else { ?>
									slideMargin: 30,
								<?php } ?>
								pager: false,
								moveSlides: 1,
							<?php } else { ?>
								mode: '<?php echo $crisp_slider_mode; ?>',
								<?php if ($crisp_slider_pager == 'false') { ?>
									pager: false,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_transition) { ?>
								speed: <?php echo $crisp_slider_transition; ?>,
							<?php } else { ?>
								<?php if ($crisp_slider_mode == 'fade') { ?>
									speed: 800,
								<?php } else { ?>
									speed: 500,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_controls == 'true') { ?>
								nextText: '<span class="icon-chevron-right"></span>',
								prevText: '<span class="icon-chevron-left"></span>',
							<?php } elseif ($crisp_slider_controls == 'false') { ?>
								controls: false,
							<?php } ?>
							<?php if ($crisp_slider_auto == 'true') { ?>
								auto: true,
								<?php if ($crisp_slider_interval) { ?>
									pause: <?php echo $crisp_slider_interval; ?>,
								<?php } else { ?>
									pause: 4000,
								<?php } ?>
							<?php } ?>
				        });
				    } else if ($(window).width() >= 831) {
				        crispslider.reloadSlider({
				            <?php if ($crisp_slider_type == 'carousel') { ?>
								<?php if ($crisp_slider_carousel_elements) { ?>
						        	minSlides: <?php echo $crisp_slider_carousel_elements; ?>,
						            maxSlides: <?php echo $crisp_slider_carousel_elements; ?>,
								<?php } else { ?>
						        	minSlides: 3,
					            	maxSlides: 3,
						        <?php } ?>
								slideWidth: 500,
								<?php if ($crisp_slider_carousel_spacing) { ?>
									slideMargin: <?php echo $crisp_slider_carousel_spacing; ?>,
								<?php } else { ?>
									slideMargin: 30,
								<?php } ?>
								pager: false,
								moveSlides: 1,
							<?php } else { ?>
								mode: '<?php echo $crisp_slider_mode; ?>',
								<?php if ($crisp_slider_pager == 'false') { ?>
									pager: false,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_transition) { ?>
								speed: <?php echo $crisp_slider_transition; ?>,
							<?php } else { ?>
								<?php if ($crisp_slider_mode == 'fade') { ?>
									speed: 800,
								<?php } else { ?>
									speed: 500,
								<?php } ?>
							<?php } ?>
							<?php if ($crisp_slider_controls == 'true') { ?>
								nextText: '<span class="icon-chevron-right"></span>',
								prevText: '<span class="icon-chevron-left"></span>',
							<?php } elseif ($crisp_slider_controls == 'false') { ?>
								controls: false,
							<?php } ?>
							<?php if ($crisp_slider_auto == 'true') { ?>
								auto: true,
								<?php if ($crisp_slider_interval) { ?>
									pause: <?php echo $crisp_slider_interval; ?>,
								<?php } else { ?>
									pause: 4000,
								<?php } ?>
							<?php } ?>
				        });
				    }
				});
			<?php } ?>
		});
		</script>
	</div>

	<?php $wpslider = ob_get_clean();
	return $wpslider;
}  

add_shortcode('crispslider', 'crisp_slider_shortcode');

function hex2rgb( $colour ) {
	if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
			return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
?>