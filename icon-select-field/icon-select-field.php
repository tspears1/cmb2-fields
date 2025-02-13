<?php
/**
 * CMB2 Icon Select Field.
 * A dialog field with radio buttons for selecting an icon.
 *
 * @package r3_excellence
 */

namespace BU\Themes\Responsive\R3_Excellence\Fields\Icon_Select;

// Enqueue scripts and styles for wordpress admin.
add_action('admin_enqueue_scripts', function() {
	wp_enqueue_script('r3-excellence-icon-select-field', get_template_directory_uri() . '/js/icon-select-field.js', array(), '1.0.0', true);
	wp_enqueue_style('r3-excellence-icon-select-field', get_template_directory_uri() . '/css/icon-select-field.css', array(), '1.0.0', true);
});

// Add template-parts/global/svg-store.php to wp-admin footer.
add_action('admin_footer', function() {
	$svg_store = get_template_directory() . '/template-parts/global/svg-store.php';
	if (file_exists($svg_store)) {
		include $svg_store;
	}
});

function cmb2_render_icon_select_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	// Create field template.
	$icons = array(
		"icon-meh",
		"icon-messages-square",
		"icon-minus",
		"icon-octagon-alert",
		"icon-phone",
		"icon-plane",
		"icon-play",
		"icon-plus",
		"icon-ruler",
		"icon-square-menu",
		"icon-tag",
		"icon-tram-front",
		"icon-triangle-alert",
		"icon-x",
		"icon-video"
	);

	$dialog_id = $field->args['_id'] . '_dialog';
	$label_id = $field->args['_id'] . '_label';
	$trigger_id = $field->args['_id'] . '_trigger';
	$input_id = $field->args['_id'] . '_input';
	$group_id = $field->args['_id'] . '-group';

	?>

		<div class="r3-excellence-icon-select-field">
			<dialog
				id="<?php echo esc_attr( $dialog_id ); ?>
				class="r3-excellence-icon-select-field__dialog"
				aria-labelledby="<?php echo esc_attr( $label_id ); ?>"
				data-icon-select="<?php echo esc_attr( $dialog_id ); ?>"
			>
				<div class="r3-excellence-icon-select-field__dialog-content">
					<div class="r3-excellence-icon-select-field__dialog-header">
						<h2 class="r3-excellence-icon-select-field__dialog-title" id="<?php echo esc_attr( $label_id ); ?>">
							<?php echo esc_html_e( 'Select an icon', 'r3-excellence' ); ?>
						</h2>
						<button
							class="r3-excellence-icon-select-field__dialog-close"
							type="button"
							data-icon-select-close="<?php echo esc_attr( $dialog_id ); ?>"
							value="cancel"
							formmethod="dialog"
						>
							<span class="screen-reader-text"><?php esc_html_e( 'Close', 'r3-excellence' ); ?></span>
							<svg class="r3-excellence-icon-select-field__dialog-close-icon" focusable="false" aria-hidden="true" role="img">
								<use xlink:href="#icon-x"></use>
							</svg>
						</button>
					</div>
					<div class="r3-excellence-icon-select-field__dialog-body">
						<ul class="r3-excellence-icon-select-field__dialog-list">
							<?php foreach ($icons as $icon) : ?>
								<?php
									$icon_id = $field->args['_id'] . '-' . $icon;
								?>
								<li class="r3-excellence-icon-select-field__dialog-list-item">
									<label for="<?php echo esc_attr( $icon_id ); ?>">
										<input
											type="radio"
											name="<?php echo esc_attr( $group_id); ?>"
											id="<?php echo esc_attr( $icon_id ); ?>"
											value="<?php echo esc_attr( $icon ); ?>"
											<?php checked( $value, $icon ); ?>
										/>
										<svg class="r3-excellence-icon-select-field__dialog-list-item-icon" focusable="false" aria-hidden="true" role="img">
											<use xlink:href="#<?php echo esc_attr( $icon ); ?>"></use>
										</svg>
										<span class="r3-excellence-icon-select-field__dialog-list-item-label"><?php echo esc_html( $icon ); ?></span>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="r3-excellence-icon-select-field__dialog-actions">
					<button class="r3-excellence-icon-select-field__dialog-submit" value="null" disabled data-icon-select-submit="<?php echo esc_attr( $dialog_id ); ?>">
						Select Icon
					</button>
				</div>
			</dialog>
			<button id="<?php echo esc_attr( $trigger_id ); ?>-trigger" data-icon-select-trigger="<?php echo esc_attr( $dialog_id ); ?>">
				<?php echo esc_html_e( 'Select Icon...', 'r3-excellence' ); ?>
			</button>
			<?php echo $field_type_object->input( array( 'type' => 'text', 'disabled' => true, 'value' => $value, 'id' => $input_id, 'data-icon-select-input' => $dialog_id ) ); ?>
		</div>
	<?php
}
add_action('cmb2_render_icon_select', __NAMESPACE__ . '\\cmb2_render_icon_select_field_callback', 10, 5 );



