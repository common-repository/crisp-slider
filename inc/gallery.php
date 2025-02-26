<?php
/*
 * @author    Daan Vos de Wael
 * @copyright Copyright (c) 2013, Daan Vos de Wael, http://www.daanvosdewael.com
 * @license   http://en.wikipedia.org/wiki/MIT_License The MIT License
*/

function crisp_slider_gallery_metabox($hook) {
  global $post_type;
  if( 'crisp_slider' == $post_type ) {
    wp_enqueue_script('crisp-slider-gallery-metabox', CRISP_SLIDER_URL . '/js/admin/gallery-metabox.js', array('jquery', 'jquery-ui-sortable'));
    wp_enqueue_style('crisp-slider-gallery-metabox', CRISP_SLIDER_URL . '/css/admin/gallery-metabox.css');
  }
}

add_action('admin_enqueue_scripts', 'crisp_slider_gallery_metabox');

function add_crisp_slider_gallery_metabox($post_type) {
  $types = array('crisp_slider');

  if (in_array($post_type, $types)) {
    add_meta_box(
      'gallery-metabox',
      __( "Slider Images", 'crispslider' ),
      'crisp_slider_gallery_meta_callback',
      $post_type,
      'normal',
      'default'
    );
  }
}
add_action('add_meta_boxes', 'add_crisp_slider_gallery_metabox');

function crisp_slider_gallery_meta_callback($post) {
  wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
  $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);

  ?>
  <table class="form-table">
    <tr><td>
      <a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>

      <ul id="gallery-metabox-list">
      <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

        <li>
          <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
          <img class="image-preview" src="<?php echo $image[0]; ?>">
          <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
          <small><a class="remove-image" href="#">Remove image</a></small>
        </li>

      <?php endforeach; endif; ?>
      </ul>

    </td></tr>
  </table>
<?php }

function crisp_slider_gallery_meta_save($post_id) {
  if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;

  if (!current_user_can('edit_post', $post_id)) return;

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  if(isset($_POST['vdw_gallery_id'])) {
    update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
  } else {
    delete_post_meta($post_id, 'vdw_gallery_id');
  }
}
add_action('save_post', 'crisp_slider_gallery_meta_save');
?>