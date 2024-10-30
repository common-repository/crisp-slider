<?php
/*
 * @author    Crisp Themes
 * @copyright Copyright (c) 2017, Crisp Themes, https://www.crispthemes.com
 * @license   http://en.wikipedia.org/wiki/MIT_License The MIT License
*/

add_action( 'add_meta_boxes', 'crisp_slider_metabox' );

function crisp_slider_metabox() {
    add_meta_box( 'crispslider-shortcode', __( "Slider Shortcode", 'crispslider' ), 'crisp_slider_cb', 'crisp_slider', 'normal', 'high' );
	add_meta_box( 'crispslider-settings', __( "Slider Settings", 'crispslider' ), 'crisp_slider_settings', 'crisp_slider', 'normal', 'default' );
}

function crisp_slider_cb($post) {
	$shortcode = get_post_meta($post->ID, 'crisp_slider_shortcode', true);
	wp_nonce_field( 'crisp_slider_nonce_set', 'crisp_slider_nonce' ); ?>
    <input type="text" name="crisp_slider_shortcode" id="crisp_slider_shortcode" value="<?php echo htmlentities($shortcode);?>" style="width: 100%; max-width: 300px;" readonly /><br />
	<p>Use this shortcode wherever you want to display the slider.</p>
    <?php    
}

function crisp_slider_settings($post) {
	wp_nonce_field( 'crisp_slider_nonce_set', 'crisp_slider_nonce' );
	$slider_type = get_post_meta($post->ID, 'crisp_slider_type', true);
	$slider_width = get_post_meta($post->ID, 'crisp_slider_width', true);
	$slider_mode = get_post_meta($post->ID, 'crisp_slider_mode', true);
	$slider_auto = get_post_meta($post->ID, 'crisp_slider_auto', true);
	$slider_carousel_elements = get_post_meta($post->ID, 'crisp_slider_carousel_elements', true);
	$slider_carousel_spacing = get_post_meta($post->ID, 'crisp_slider_carousel_spacing', true);
	$slider_interval = get_post_meta($post->ID, 'crisp_slider_interval', true);
	$slider_controls = get_post_meta($post->ID, 'crisp_slider_controls', true);
	$slider_pager = get_post_meta($post->ID, 'crisp_slider_pager', true);
	$slider_transition = get_post_meta($post->ID, 'crisp_slider_transition', true);
	$slider_pager_style = get_post_meta($post->ID, 'crisp_slider_pager_style', true);
	$slider_bullet_type = get_post_meta($post->ID, 'crisp_slider_bullet_type', true);
	$slider_bullet_color = get_post_meta($post->ID, 'crisp_slider_bullet_color', true);
	$slider_abullet_color = get_post_meta($post->ID, 'crisp_slider_abullet_color', true);
	$slider_bullet_bg = get_post_meta($post->ID, 'crisp_slider_bullet_bg', true);
	$slider_bullet_tcolor = get_post_meta($post->ID, 'crisp_slider_bullet_tcolor', true);
	$slider_abullet_bg = get_post_meta($post->ID, 'crisp_slider_abullet_bg', true);
	$slider_sbullet_tcolor = get_post_meta($post->ID, 'crisp_slider_sbullet_tcolor', true);
	$slider_pager_position = get_post_meta($post->ID, 'crisp_slider_pager_position', true);
	$slider_pager_hposition = get_post_meta($post->ID, 'crisp_slider_pager_hposition', true);
	$slider_pager_vposition = get_post_meta($post->ID, 'crisp_slider_pager_vposition', true);
	$slider_control_bgtype = get_post_meta($post->ID, 'crisp_slider_control_bgtype', true);
	$slider_control_bgcolor = get_post_meta($post->ID, 'crisp_slider_control_bgcolor', true);
	$slider_control_bgopacity = get_post_meta($post->ID, 'crisp_slider_control_bgopacity', true);
	$slider_control_arrcolor = get_post_meta($post->ID, 'crisp_slider_control_arrcolor', true); ?>

	<div id="crisp-slider-settings">
		<div class="crisp-slider-left">
			<h3><?php esc_attr_e( 'Slider Type', 'crispslider' ); ?></h3>
			
			<div class="slider-type">
				<fieldset>
					<div class="slider-type-wrap">
						<legend class="screen-reader-text"><span><?php esc_attr_e( 'Basic', 'crispslider' ); ?></span></legend>
						<label for="slider-type">
							<input name="crisp_slider_type" type="radio" value="basic" <?php checked( $slider_type, 'basic' ); ?> <?php if (!$slider_type) { ?>checked<?php } ?> />
							<span><?php esc_attr_e( 'Basic', 'crispslider' ); ?></span>
						</label>
					</div>

					<div class="slider-type-wrap">
						<legend class="screen-reader-text"><span><?php esc_attr_e( 'Carousel', 'crispslider' ); ?></span></legend>
						<label for="slider-type">
							<input name="crisp_slider_type" type="radio" value="carousel" <?php checked( $slider_type, 'carousel' ); ?> />
							<span><?php esc_attr_e( 'Carousel', 'crispslider' ); ?></span>
						</label>
					</div>

					<div class="clear"></div>
				</fieldset>

				<div class="clear"></div>
			</div>

			<div id="crispslider-settings">
				<h3>Slider Settings</h3>
				<div class="slider-settings-wrap slider-carousel-setting">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Elements per Slide', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Elements per Slide', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_carousel_elements" type="text" value="<?php if ($slider_carousel_elements) { echo $slider_carousel_elements; } ?>" placeholder="3" />
							</label>
						</div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Slider Width', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Slider Width', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_width" type="text" value="<?php if ($slider_width) { echo $slider_width; } ?>" placeholder="100%" />
							</label>
						</div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-settings-wrap slider-carousel-setting">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Spacing', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Spacing', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_carousel_spacing" type="text" value="<?php if ($slider_carousel_spacing) { echo $slider_carousel_spacing; } ?>" placeholder="30" />
							</label>
						</div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-settings-wrap slider-mode-setting">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Mode', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Horizontal', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_mode" type="radio" value="horizontal" <?php checked( $slider_mode, 'horizontal' ); ?> <?php if (!$slider_mode) { ?>checked<?php } ?> />
								<span><?php esc_attr_e( 'Horizontal', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Vertical', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_mode" type="radio" value="vertical" <?php checked( $slider_mode, 'vertical' ); ?> />
								<span><?php esc_attr_e( 'Vertical', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Fade', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_mode" type="radio" value="fade" <?php checked( $slider_mode, 'fade' ); ?> />
								<span><?php esc_attr_e( 'Fade', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Auto', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_auto" type="radio" value="true" <?php checked( $slider_auto, 'true' ); ?> <?php if (!$slider_auto) { ?>checked<?php } ?> />
								<span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'No', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_auto" type="radio" value="false" <?php checked( $slider_auto, 'false' ); ?> />
								<span><?php esc_attr_e( 'No', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div id="slider-setting-interval" class="slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Slide Interval', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Slide Interval', 'crispslider' ); ?></span></legend>
							<input name="crisp_slider_interval" type="text" value="<?php if ($slider_interval) { echo $slider_interval; } ?>" placeholder="4000" />
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>
				
				<div class="slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Controls', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_controls" type="radio" value="true" <?php checked( $slider_controls, 'true' ); ?> <?php if (!$slider_controls) { ?>checked<?php } ?> />
								<span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'No', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_controls" type="radio" value="false" <?php checked( $slider_controls, 'false' ); ?> />
								<span><?php esc_attr_e( 'No', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-pager-type slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Pager', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_pager" type="radio" value="true" <?php checked( $slider_pager, 'true' ); ?> <?php if (!$slider_pager) { ?>checked<?php } ?> />
								<span><?php esc_attr_e( 'Yes', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'No', 'crispslider' ); ?></span></legend>
							<label for="slider-type">
								<input name="crisp_slider_pager" type="radio" value="false" <?php checked( $slider_pager, 'false' ); ?> />
								<span><?php esc_attr_e( 'No', 'crispslider' ); ?></span>
							</label>
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>

				<div class="slider-settings-wrap">
					<div class="slider-labels">
						<h5><?php esc_attr_e( 'Transition Speed', 'crispslider' ); ?>:</h5>
					</div>

					<fieldset>
						<div class="slider-type-wrap">
							<legend class="screen-reader-text"><span><?php esc_attr_e( 'Transition Speed', 'crispslider' ); ?></span></legend>
							<input name="crisp_slider_transition" type="text" value="<?php if ($slider_transition) { echo $slider_transition; } ?>" placeholder="800" />
						</div>

						<div class="clear"></div>
					</fieldset>

					<div class="clear"></div>
				</div>
				
				<div id="slider-pager">
					<h3><?php esc_attr_e( 'Pager', 'crispslider' ); ?></h3>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Style', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Bullets', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_style" type="radio" value="bullet" <?php checked( $slider_pager_style, 'bullet' ); ?> <?php if (!$slider_pager_style) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Bullets', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Numbered', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_style" type="radio" value="number" <?php checked( $slider_pager_style, 'number' ); ?> />
									<span><?php esc_attr_e( 'Numbered', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="clear"></div>
						</fieldset>

						<div class="clear"></div>
					</div>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Bullet Type', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Rounded', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_bullet_type" type="radio" value="rounded" <?php checked( $slider_bullet_type, 'rounded' ); ?> <?php if (!$slider_bullet_type) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Rounded', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Square', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_bullet_type" type="radio" value="square" <?php checked( $slider_bullet_type, 'square' ); ?> />
									<span><?php esc_attr_e( 'Square', 'crispslider' ); ?></span>
								</label>
							</div>
						</fieldset>

						<div class="clear"></div>
					</div>
					
					<div id="slider-bullet">
						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Bullet Color', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Bullet Color', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_bullet_color" type="text" value="<?php if ($slider_bullet_color) { echo $slider_bullet_color; } ?>" placeholder="#999999" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>

						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Active Bullet Color', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Active Bullet Color', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_abullet_color" type="text" value="<?php if ($slider_abullet_color) { echo $slider_abullet_color; } ?>" placeholder="#111111" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>
					</div>

					<div id="slider-number">
						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Background', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Background', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_bullet_bg" type="text" value="<?php if ($slider_bullet_bg) { echo $slider_bullet_bg; } ?>" placeholder="#CCCCCC" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>

						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Text Color', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Text Color', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_bullet_tcolor" type="text" value="<?php if ($slider_bullet_tcolor) { echo $slider_bullet_tcolor; } ?>" placeholder="#111111" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>

						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Active/Hover Background', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Active/Hover Background', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_abullet_bg" type="text" value="<?php if ($slider_abullet_bg) { echo $slider_abullet_bg; } ?>" placeholder="#111111" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>

						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Active/Hover Text Color', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Active/Hover Text Color', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input class="crisp-color" name="crisp_slider_sbullet_tcolor" type="text" value="<?php if ($slider_sbullet_tcolor) { echo $slider_sbullet_tcolor; } ?>" placeholder="#FFFFFF" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>
					</div>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Bullet Position', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Outside', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_position" type="radio" value="outside" <?php checked( $slider_pager_position, 'outside' ); ?> <?php if (!$slider_pager_position) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Outside', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Inside', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_position" type="radio" value="inside" <?php checked( $slider_pager_position, 'inside' ); ?> />
									<span><?php esc_attr_e( 'Inside', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="clear"></div>
						</fieldset>

						<div class="clear"></div>
					</div>

					<div class="slider-settings-wrap slider-settings-horizontal">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Horizontal Position', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Left', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_hposition" type="radio" value="left" <?php checked( $slider_pager_hposition, 'left' ); ?> />
									<span><?php esc_attr_e( 'Left', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Center', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_hposition" type="radio" value="center" <?php checked( $slider_pager_hposition, 'center' ); ?> <?php if (!$slider_pager_hposition) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Center', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Right', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_hposition" type="radio" value="right" <?php checked( $slider_pager_hposition, 'right' ); ?> />
									<span><?php esc_attr_e( 'Right', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="clear"></div>
						</fieldset>

						<div class="clear"></div>
					</div>

					<div class="slider-settings-wrap slider-settings-vertical">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Vertical Position', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Top', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_vposition" type="radio" value="top" <?php checked( $slider_pager_vposition, 'top' ); ?> />
									<span><?php esc_attr_e( 'Top', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Bottom', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_pager_vposition" type="radio" value="bottom" <?php checked( $slider_pager_vposition, 'bottom' ); ?> <?php if (!$slider_pager_vposition) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Bottom', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="clear"></div>
						</fieldset>

						<div class="clear"></div>
					</div>
				</div>

				<div id="slider-controls">
					<h3><?php esc_attr_e( 'Controls', 'crispslider' ); ?></h3>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Background Type', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Solid', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_control_bgtype" type="radio" value="solid" <?php checked( $slider_control_bgtype, 'solid' ); ?> />
									<span><?php esc_attr_e( 'Solid', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Transparent', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input name="crisp_slider_control_bgtype" type="radio" value="transparent" <?php checked( $slider_control_bgtype, 'transparent' ); ?> <?php if (!$slider_pager_vposition) { ?>checked<?php } ?> />
									<span><?php esc_attr_e( 'Transparent', 'crispslider' ); ?></span>
								</label>
							</div>

							<div class="clear"></div>
						</fieldset>

						<div class="clear"></div>
					</div>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Background Color', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Background Color', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input class="crisp-color" name="crisp_slider_control_bgcolor" type="text" value="<?php if ($slider_control_bgcolor) { echo $slider_control_bgcolor; } ?>" placeholder="#111111" />
								</label>
							</div>
						</fieldset>

						<div class="clear"></div>
					</div>
					
					<div id="slider-control-bgopacity">
						<div class="slider-settings-wrap">
							<div class="slider-labels">
								<h5><?php esc_attr_e( 'Background Opacity', 'crispslider' ); ?>:</h5>
							</div>

							<fieldset>
								<div class="slider-type-wrap">
									<legend class="screen-reader-text"><span><?php esc_attr_e( 'Background Opacity', 'crispslider' ); ?></span></legend>
									<label for="slider-type">
										<input name="crisp_slider_control_bgopacity" type="text" value="<?php if ($slider_control_bgopacity) { echo $slider_control_bgopacity; } ?>" placeholder="0.8" />
									</label>
								</div>
							</fieldset>

							<div class="clear"></div>
						</div>
					</div>

					<div class="slider-settings-wrap">
						<div class="slider-labels">
							<h5><?php esc_attr_e( 'Arrow Color', 'crispslider' ); ?>:</h5>
						</div>

						<fieldset>
							<div class="slider-type-wrap">
								<legend class="screen-reader-text"><span><?php esc_attr_e( 'Arrow Color', 'crispslider' ); ?></span></legend>
								<label for="slider-type">
									<input class="crisp-color" name="crisp_slider_control_arrcolor" type="text" value="<?php if ($slider_control_arrcolor) { echo $slider_control_arrcolor; } ?>" placeholder="#FFFFFF" />
								</label>
							</div>
						</fieldset>

						<div class="clear"></div>
					</div>
				</div>

				<input type="submit" id="crisp-update" value="Update" />
			</div>
		</div>

		<div class="crisp-ads-section">
			<div class="crisp-ad-section">
				<a href="https://www.crispthemes.com/" target="_blank"><img src="<?php echo CRISP_SLIDER_URL; ?>/css/images/crisp_theme_logo.jpg" /></a>
			</div>

			<div class="crisp-ad-section">
				<a href="https://www.crispthemes.com/support/forum/plugins/crispslider/" target="_blank"><img src="<?php echo CRISP_SLIDER_URL; ?>/css/images/plugin-support.png" /></a>
			</div>

			<div class="crisp-ad-section">
				<a href="https://www.crispthemes.com/plugins/" target="_blank"><img src="<?php echo CRISP_SLIDER_URL; ?>/css/images/plugin-banner.png" /></a>
			</div>

			<div class="crisp-ad-section">
				<a href="https://www.crispthemes.com/themes/" target="_blank"><img src="<?php echo CRISP_SLIDER_URL; ?>/css/images/theme-banner.png" /></a>
			</div>
		</div>

		<div class="clear"></div>
	</div>
<?php }

add_action('save_post', 'crisp_save_slider');

function crisp_save_slider($post_id){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !isset( $_POST['crisp_slider_nonce'] ) || !wp_verify_nonce( $_POST['crisp_slider_nonce'], 'crisp_slider_nonce_set' ) ) return;
     
    if( !current_user_can( 'edit_post', $post_id ) ) return;

	if(isset($_POST['post_type']) && ($_POST['post_type'] == "crisp_slider")) {
        $shortcode = get_post_meta($post_id, 'crisp_slider_shortcode', true);
		if (!$shortcode) {
			update_post_meta( $post_id, 'crisp_slider_shortcode', '[crispslider id="' . $post_id . '"]' );
		}

		if( isset( $_POST['crisp_slider_type'] )) {
			update_post_meta( $post_id, 'crisp_slider_type', esc_attr( $_POST['crisp_slider_type'] ) );
		}

		if( isset( $_POST['crisp_slider_width'] )) {
			update_post_meta( $post_id, 'crisp_slider_width', esc_attr( $_POST['crisp_slider_width'] ) );
		}

		if( isset( $_POST['crisp_slider_mode'] )) {
			update_post_meta( $post_id, 'crisp_slider_mode', esc_attr( $_POST['crisp_slider_mode'] ) );
		}

		if( isset( $_POST['crisp_slider_carousel_elements'] )) {
			update_post_meta( $post_id, 'crisp_slider_carousel_elements', esc_attr( $_POST['crisp_slider_carousel_elements'] ) );
		}

		if( isset( $_POST['crisp_slider_carousel_spacing'] )) {
			update_post_meta( $post_id, 'crisp_slider_carousel_spacing', esc_attr( $_POST['crisp_slider_carousel_spacing'] ) );
		}

		if( isset( $_POST['crisp_slider_auto'] )) {
			update_post_meta( $post_id, 'crisp_slider_auto', esc_attr( $_POST['crisp_slider_auto'] ) );
		}

		if( isset( $_POST['crisp_slider_interval'] )) {
			update_post_meta( $post_id, 'crisp_slider_interval', esc_attr( $_POST['crisp_slider_interval'] ) );
		}

		if( isset( $_POST['crisp_slider_controls'] )) {
			update_post_meta( $post_id, 'crisp_slider_controls', esc_attr( $_POST['crisp_slider_controls'] ) );
		}

		if( isset( $_POST['crisp_slider_pager'] )) {
			update_post_meta( $post_id, 'crisp_slider_pager', esc_attr( $_POST['crisp_slider_pager'] ) );
		}

		if( isset( $_POST['crisp_slider_transition'] )) {
			update_post_meta( $post_id, 'crisp_slider_transition', esc_attr( $_POST['crisp_slider_transition'] ) );
		}

		if( isset( $_POST['crisp_slider_pager_style'] )) {
			update_post_meta( $post_id, 'crisp_slider_pager_style', esc_attr( $_POST['crisp_slider_pager_style'] ) );
		}

		if( isset( $_POST['crisp_slider_bullet_type'] )) {
			update_post_meta( $post_id, 'crisp_slider_bullet_type', esc_attr( $_POST['crisp_slider_bullet_type'] ) );
		}

		if( isset( $_POST['crisp_slider_bullet_color'] )) {
			update_post_meta( $post_id, 'crisp_slider_bullet_color', esc_attr( $_POST['crisp_slider_bullet_color'] ) );
		}

		if( isset( $_POST['crisp_slider_abullet_color'] )) {
			update_post_meta( $post_id, 'crisp_slider_abullet_color', esc_attr( $_POST['crisp_slider_abullet_color'] ) );
		}

		if( isset( $_POST['crisp_slider_bullet_bg'] )) {
			update_post_meta( $post_id, 'crisp_slider_bullet_bg', esc_attr( $_POST['crisp_slider_bullet_bg'] ) );
		}

		if( isset( $_POST['crisp_slider_bullet_tcolor'] )) {
			update_post_meta( $post_id, 'crisp_slider_bullet_tcolor', esc_attr( $_POST['crisp_slider_bullet_tcolor'] ) );
		}

		if( isset( $_POST['crisp_slider_abullet_bg'] )) {
			update_post_meta( $post_id, 'crisp_slider_abullet_bg', esc_attr( $_POST['slider_abullet_bg'] ) );
		}

		if( isset( $_POST['crisp_slider_sbullet_tcolor'] )) {
			update_post_meta( $post_id, 'crisp_slider_sbullet_tcolor', esc_attr( $_POST['crisp_slider_sbullet_tcolor'] ) );
		}

		if( isset( $_POST['crisp_slider_pager_position'] )) {
			update_post_meta( $post_id, 'crisp_slider_pager_position', esc_attr( $_POST['crisp_slider_pager_position'] ) );
		}

		if( isset( $_POST['crisp_slider_pager_hposition'] )) {
			update_post_meta( $post_id, 'crisp_slider_pager_hposition', esc_attr( $_POST['crisp_slider_pager_hposition'] ) );
		}

		if( isset( $_POST['crisp_slider_pager_vposition'] )) {
			update_post_meta( $post_id, 'crisp_slider_pager_vposition', esc_attr( $_POST['crisp_slider_pager_vposition'] ) );
		}

		if( isset( $_POST['crisp_slider_control_bgtype'] )) {
			update_post_meta( $post_id, 'crisp_slider_control_bgtype', esc_attr( $_POST['crisp_slider_control_bgtype'] ) );
		}

		if( isset( $_POST['crisp_slider_control_bgcolor'] )) {
			update_post_meta( $post_id, 'crisp_slider_control_bgcolor', esc_attr( $_POST['crisp_slider_control_bgcolor'] ) );
		}

		if( isset( $_POST['crisp_slider_control_bgopacity'] )) {
			update_post_meta( $post_id, 'crisp_slider_control_bgopacity', esc_attr( $_POST['crisp_slider_control_bgopacity'] ) );
		}

		if( isset( $_POST['crisp_slider_control_arrcolor'] )) {
			update_post_meta( $post_id, 'crisp_slider_control_arrcolor', esc_attr( $_POST['crisp_slider_control_arrcolor'] ) );
		}
	}
}
?>