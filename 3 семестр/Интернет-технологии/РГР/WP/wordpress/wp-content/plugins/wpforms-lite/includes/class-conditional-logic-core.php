<?php

/**
 * Conditional logic core.
 *
 * Contains functionality for using conditional logic in the form builder as
 * well as a global processing method that can be leveraged by all types of
 * conditional logic.
 *
 * This was contained in an addon until version 1.3.8 when it was rolled into
 * core.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.3.8
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Conditional_Logic_Core {

	/**
	 * One is the loneliest number that you'll ever do.
	 *
	 * @since 1.1.0
	 * @var WPForms_Conditional_Logic_Core
	 */
	private static $instance;

	/**
	 * Main Instance.
	 *
	 * @since 1.1.0
	 * @return WPForms_Conditional_Logic_Core
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPForms_Conditional_Logic_Core ) ) {
			self::$instance = new WPForms_Conditional_Logic_Core;
			add_action( 'wpforms_loaded', array( self::$instance, 'init' ), 10 );
		}

		return self::$instance;
	}

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Form builder.
		add_action( 'wpforms_builder_enqueues', array( $this, 'builder_assets' ) );
		add_action( 'wpforms_builder_print_footer_scripts', array( $this, 'builder_footer_scripts' ) );
	}

	/**
	 * Enqueue assets for the builder.
	 *
	 * @since 1.0.0
	 */
	public function builder_assets() {

		// CSS.
		wp_enqueue_style(
			'wpforms-builder-conditionals',
			WPFORMS_PLUGIN_URL . 'assets/css/admin-builder-conditional-logic-core.css',
			array(),
			WPFORMS_VERSION
		);

		// JavaScript.
		wp_enqueue_script(
			'wpforms-builder-conditionals',
			WPFORMS_PLUGIN_URL . 'assets/js/admin-builder-conditional-logic-core.js',
			array( 'jquery', 'wpforms-utils', 'wpforms-builder' ),
			WPFORMS_VERSION,
			false
		);
	}

	/**
	 * Outputs footer scripts inside the form builder.
	 *
	 * @since 1.3.8
	 */
	public function builder_footer_scripts() {

		?>
		<script type="text/html" id="tmpl-wpforms-conditional-block">
			<# var containerID = data.fieldName.replace(/]/g, '').replace(/\[/g, '-'); #>
			<div class="wpforms-conditional-groups" id="wpforms-conditional-groups-{{ containerID }}">
				<h4>
					<select name="{{ data.fieldName }}[conditional_type]">
						<# _.each(data.actions, function(key, val) { #>
						<option value="{{ val }}">{{ key }}</option>
						<# }) #>
					</select>
					{{ data.actionDesc }}
				</h4>
				<div class="wpforms-conditional-group" data-reference="{{ data.fieldID }}">
					<table><tbody>
					<tr class="wpforms-conditional-row" data-field-id="{{ data.fieldID }}" data-input-name="{{ data.fieldName }}">
						<td class="field">
							<select name="{{ data.fieldName }}[conditionals][0][0][field]" class="wpforms-conditional-field" data-groupid="0" data-ruleid="0">
								<option value="">{{ wpforms_builder.select_field }}</option>
							</select>
						</td>
						<td class="operator">
							<select name="{{ data.fieldName }}[conditionals][0][0][operator]" class="wpforms-conditional-operator">
								<option value="==">{{ wpforms_builder.operator_is }}</option>
								<option value="!=">{{ wpforms_builder.operator_is_not }}</option>
								<option value="e">{{ wpforms_builder.operator_empty }}</option>
								<option value="!e">{{ wpforms_builder.operator_not_empty }}</option>
								<option value="c">{{ wpforms_builder.operator_contains }}</option>
								<option value="!c">{{ wpforms_builder.operator_not_contains }}</option>
								<option value="^">{{ wpforms_builder.operator_starts }}</option>
								<option value="~">{{ wpforms_builder.operator_ends }}</option>
								<option value=">">{{ wpforms_builder.operator_greater_than }}</option>
								<option value="<">{{ wpforms_builder.operator_less_than }}</option>
							</select>
						</td>
						<td class="value">
							<select name="{{ data.fieldName }}[conditionals][0][0][value]" class="wpforms-conditional-value">
								<option value="">{{ wpforms_builder.select_choice }}</option>
							</select>
						</td>
							<td class="actions">
								<button class="wpforms-conditional-rule-add" title="{{ wpforms_builder.rule_create }}">{{ wpforms_builder.and }}</button><button class="wpforms-conditional-rule-delete" title="{{ wpforms_builder.rule_delete }}"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
							</td>
						</tr>
					</tbody></table>
					<h5>{{ wpforms_builder.or }}</h5>
				</div>
				<button class="wpforms-conditional-groups-add">{{ wpforms_builder.rule_create_group }}</button>
			</div>
		</script>
		<?php
	}

	/**
	 * Builds the conditional logic settings to display in the form builder.
	 *
	 * @since 1.3.8
	 *
	 * @param array $args Data needed for a block to be generated properly.
	 * @param bool  $echo Whether to return or print. Default: print.
	 *
	 * @return string
	 */
	public function builder_block( $args = array(), $echo = true ) {

		if ( ! empty( $args['form'] ) ) {
			$form_fields = wpforms_get_form_fields( $args['form'], wpforms_get_conditional_logic_form_fields_supported() );
		} else {
			$form_fields = array();
		}

		// Define data.
		$type       = ! empty( $args['type'] ) ? $args['type'] : 'field';
		$panel      = ! empty( $args['panel'] ) ? $args['panel'] : false; // notifications/connections.
		$parent     = ! empty( $args['parent'] ) ? $args['parent'] : false; // settings.
		$subsection = ! empty( $args['subsection'] ) ? $args['subsection'] : false;
		$field      = ! empty( $args['field'] ) ? $args['field'] : false;
		$reference  = ! empty( $args['reference'] ) ? $args['reference'] : '';
		$data_attrs = '';

		ob_start();

		// Block open markup.
		printf(
			'<div class="wpforms-conditional-block wpforms-conditional-block-%s" data-type="%s">',
			esc_attr( $type ),
			esc_attr( $type )
		);

			switch ( $type ) {
				case 'field':
					/*
					 * This settings block is for a field.
					 */

					// Define more data for this field.
					$fields_instance = $args['instance'];
					$field_id        = absint( $field['id'] );
					$field_name      = "fields[{$field_id}]";
					$groups_id       = "wpforms-conditional-groups-fields-{$field_id}";
					$action_selected = ! empty( $field['conditional_type'] ) ? $field['conditional_type'] : '';
					$conditionals    = ! empty( $field['conditionals'] ) ? $field['conditionals'] : array( array( array() ) );
					$data_attrs      = 'data-field-id="' . $field_id . '" ';
					$reference       = $field_id;
					$enabled         = isset( $field['conditional_logic'] ) ? $field['conditional_logic'] : false;
					$action_desc     = ! empty( $args['action_desc'] ) ? $args['action_desc'] : esc_html__( 'this field if', 'wpforms-lite' );

					if ( empty( $args['actions'] ) ) {
						$actions = array(
							'show' => esc_attr__( 'Show', 'wpforms-lite' ),
							'hide' => esc_attr__( 'Hide', 'wpforms-lite' ),
						);
					} else {
						$actions = array_map( 'esc_attr', $args['actions'] );
					}

					// Output Conditional Logic toggle checkbox field option.
					$fld = $fields_instance->field_element(
						'checkbox',
						$field,
						array(
							'slug'    => 'conditional_logic',
							'value'   => $enabled,
							'desc'    => esc_html__( 'Enable conditional logic', 'wpforms-lite' ),
							'tooltip' => '<a href="https://wpforms.com/docs/how-to-use-conditional-logic-with-wpforms/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'How to use Conditional Logic', 'wpforms-lite' ) . '</a>',
							'data'    => array(
								'name'        => $field_name,
								'actions'     => $actions,
								'action-desc' => esc_attr( $action_desc ),
							),
						),
						false
					);
					$fields_instance->field_element(
						'row',
						$field,
						array(
							'slug'    => 'conditional_logic',
							'content' => $fld,
							'class'   => 'wpforms-conditionals-enable-toggle',
						)
					);

					// Prevent conditional logic from being applied to itself.
					if ( ! empty( $form_fields[ $field['id'] ] ) ) {
						unset( $form_fields[ $field['id'] ] );
					}
					break;

				case 'panel':
					/*
					 * This settings block is for something else - connections / notifications etc.
					 */

					$form_data = $args['form'];

					$action_desc = ! empty( $args['action_desc'] ) ? $args['action_desc'] : esc_html__( 'this connection if', 'wpforms-lite' );

					if ( empty( $args['actions'] ) ) {
						$actions = array(
							'go'   => esc_attr__( 'Process', 'wpforms-lite' ),
							'stop' => esc_attr__( 'Don\'t process', 'wpforms-lite' ),
						);
					} else {
						$actions = array_map( 'esc_attr', $args['actions'] );
					}

					// Below we do a bunch of voodoo to determine where this block
					// is located in the form builder - eg is it in a top level
					// setting or in a subsection, etc.
					if ( ! empty( $parent ) ) {
						if ( ! empty( $subsection ) ) {
							$field_name      = sprintf( '%s[%s][%s]', $parent, $panel, $subsection );
							$groups_id       = sprintf( 'wpforms-conditional-groups-%s-%s-%s', $parent, $panel, $subsection );
							$enabled         = ! empty( $form_data[ $parent ][ $panel ][ $subsection ]['conditional_logic'] ) ? true : false;
							$action_selected = ! empty( $form_data[ $parent ][ $panel ][ $subsection ]['conditional_type'] ) ? $form_data[ $parent ][ $panel ][ $subsection ]['conditional_type'] : '';
							$conditionals    = ! empty( $form_data[ $parent ][ $panel ][ $subsection ]['conditionals'] ) ? $form_data[ $parent ][ $panel ][ $subsection ]['conditionals'] : array( array( array() ) );
						} else {
							$field_name      = sprintf( '%s[%s]', $parent, $panel );
							$groups_id       = sprintf( 'wpforms-conditional-groups-%s-%s', $parent, $panel );
							$enabled         = ! empty( $form_data[ $parent ][ $panel ]['conditional_logic'] ) ? true : false;
							$action_selected = ! empty( $form_data[ $parent ][ $panel ]['conditional_type'] ) ? $form_data[ $parent ][ $panel ]['conditional_type'] : '';
							$conditionals    = ! empty( $form_data[ $parent ][ $panel ]['conditionals'] ) ? $form_data[ $parent ][ $panel ]['conditionals'] : array( array( array() ) );
						}
					} else {
						$field_name      = sprintf( '%s', $panel );
						$groups_id       = sprintf( 'wpforms-conditional-groups-%s', $panel );
						$enabled         = ! empty( $form_data[ $panel ]['conditional_logic'] ) ? true : false;
						$action_selected = ! empty( $form_data[ $panel ]['conditional_type'] ) ? $form_data[ $panel ]['conditional_type'] : '';
						$conditionals    = ! empty( $form_data[ $panel ]['conditionals'] ) ? $form_data[ $panel ]['conditionals'] : array( array( array() ) );
					}

					// Output Conditional Logic toggle checkbox panel setting.
					wpforms_panel_field(
						'checkbox',
						$panel,
						'conditional_logic',
						$args['form'],
						esc_html__( 'Enable conditional logic', 'wpforms-lite' ),
						array(
							'tooltip'     => '<a href="https://wpforms.com/docs/how-to-use-conditional-logic-with-wpforms/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'How to use Conditional Logic', 'wpforms-lite' ) . '</a>',
							'parent'      => $parent,
							'subsection'  => $subsection,
							'input_id'    => 'wpforms-panel-field-' . implode( '-', array_filter( array( $parent, $panel, $subsection, 'conditional_logic', 'checkbox' ) ) ),
							'input_class' => 'wpforms-panel-field-conditional_logic-checkbox',
							'class'       => 'wpforms-conditionals-enable-toggle',
							'data'        => array(
								'name'        => $field_name,
								'actions'     => $actions,
								'action-desc' => esc_attr( $action_desc ),
							),
						)
					);
					break;

				default:
					$enabled         = false;
					$field_name      = '';
					$reference       = '';
					$action_selected = '';
					$action_desc     = '';
					$groups_id       = '';
					$actions         = array();
					$conditionals    = array();
			}

			// Only display the block details if conditional logic is enabled.
			if ( $enabled ) :

				$data_attrs .= 'data-input-name="' . esc_attr( $field_name ) . '"';
				$style       = $enabled ? '' : 'display:none;';

				// Groups wrap open markup.
				printf(
					'<div class="wpforms-conditional-groups" id="%s" style="%s">',
					sanitize_html_class( $groups_id ),
					esc_attr( $style )
				);

					// This is the "[Show] this field if" type text and setting.
					echo '<h4>';
						echo '<select name="' . esc_attr( $field_name ) . '[conditional_type]">';
						foreach ( $actions as $key => $label ) {
							printf(
								'<option value="%s" %s>%s</option>',
								esc_attr( trim( $key ) ),
								selected( $key, $action_selected, false ),
								esc_html( $label )
							);
						}
						echo '</select>';
						echo esc_html( $action_desc ); // Eg "this field if".
					echo '</h4>';

					// Go through each conditional logic group.
					foreach ( $conditionals as $group_id => $group ) :

						// Individual group open markup.
						echo '<div class="wpforms-conditional-group" data-reference="' . $reference . '">';

							echo '<table><tbody>';

								foreach ( $group as $rule_id => $rule ) :

									$selected_current = false;

									// Individual rule table row.
									echo '<tr class="wpforms-conditional-row" ' . $data_attrs . '>';

										// Rule field - allows the user to select
										// which field the conditional logic rule is
										// anchored to.
										echo '<td class="field">';

											printf(
												'<select name="%s[conditionals][%d][%d][field]" class="wpforms-conditional-field" data-groupid="%d" data-ruleid="%d">',
												esc_attr( $field_name ),
												(int) $group_id,
												(int) $rule_id,
												(int) $group_id,
												(int) $rule_id
											);

												echo '<option value="">' . esc_html__( '--- Select Field ---', 'wpforms-lite' ) . '</option>';

												if ( ! empty( $form_fields ) ) {

													foreach ( $form_fields as $form_field ) {

														// Exclude fields that are
														// leveraging dynamic choices.
														if ( ! empty( $form_field['dynamic_choices'] ) ) {
															continue;
														}

														if ( isset( $rule['field'] ) ) {
															$selected         = $rule['field'];
															$selected_current = $rule['field'];
														} else {
															$selected = false;
														}

														$selected = selected( $selected, $form_field['id'], false );
														printf( '<option value="%s" %s>%s</option>', absint( $form_field['id'] ), $selected, esc_html( $form_field['label'] ) );
													}
												}

											echo '</select>';

										echo '</td>';

										// Rule operator - allows the user to
										// determine the comparison operator used
										// for processing.
										echo '<td class="operator">';

											printf(
												'<select name="%s[conditionals][%s][%s][operator]" class="wpforms-conditional-operator">',
												$field_name,
												$group_id,
												$rule_id
											);

												$operator = ! empty( $rule['operator'] ) ? $rule['operator'] : false;
												printf( '<option value="==" %s>%s</option>', selected( $operator, '==', false ), esc_html__( 'is', 'wpforms-lite' ) );
												printf( '<option value="!=" %s>%s</option>', selected( $operator, '!=', false ), esc_html__( 'is not', 'wpforms-lite' ) );
												printf( '<option value="e" %s>%s</option>', selected( $operator, 'e', false ), esc_html__( 'empty', 'wpforms-lite' ) );
												printf( '<option value="!e" %s>%s</option>', selected( $operator, '!e', false ), esc_html__( 'not empty', 'wpforms-lite' ) );

												// Only text based fields support
												// these additional operators.
												$disabled = '';
												if ( ! empty( $rule['field'] ) && ! empty( $form_fields[ $rule['field'] ]['type'] ) ) {
													$disabled = in_array( $form_fields[ $rule['field'] ]['type'], array( 'text', 'textarea', 'email', 'url', 'number', 'hidden', 'rating', 'number-slider', 'net_promoter_score' ), true ) ? '' : ' disabled';
												}

												printf( '<option value="c" %s%s>%s</option>', selected( $operator, 'c', false ), $disabled, esc_html__( 'contains', 'wpforms-lite' ) );
												printf( '<option value="!c" %s%s>%s</option>', selected( $operator, '!c', false ), $disabled, esc_html__( 'does not contain', 'wpforms-lite' ) );
												printf( '<option value="^" %s%s>%s</option>', selected( $operator, '^', false ), $disabled, esc_html__( 'starts with', 'wpforms-lite' ) );
												printf( '<option value="~" %s%s>%s</option>', selected( $operator, '~', false ), $disabled, esc_html__( 'ends with', 'wpforms-lite' ) );
												printf( '<option value=">" %s%s>%s</option>', selected( $operator, '>', false ), $disabled, esc_html__( 'greater than', 'wpforms-lite' ) );
												printf( '<option value="<" %s%s>%s</option>', selected( $operator, '<', false ), $disabled, esc_html__( 'less than', 'wpforms-lite' ) );

											echo '</select>';

										echo '</td>';

										// Rule value - allows the user to
										// determine the value we are using for
										// comparison.
										echo '<td class="value">';

											if ( isset( $rule['field'] ) ) {

												// For empty/not empty fields the field value input is not needed so we disable it.
												if ( ! empty( $rule['operator'] ) && in_array( $rule['operator'], array( 'e', '!e' ), true ) ) {
													$disabled      = 'disabled';
													$rule['value'] = '';
												} else {
													$disabled = '';
												}

												if ( isset( $form_fields[ $rule['field'] ]['type'] ) && in_array( $form_fields[ $rule['field'] ]['type'], array( 'text', 'textarea', 'email', 'url', 'number', 'hidden', 'rating', 'number-slider', 'net_promoter_score' ), true ) ) {

													$type = in_array( $form_fields[ $rule['field'] ]['type'], array( 'rating', 'net_promoter_score', 'number-slider' ), true ) ? 'number' : 'text';

													printf(
														'<input type="%s" name="%s[conditionals][%s][%s][value]" value="%s" class="wpforms-conditional-value" %s>',
														$type,
														$field_name,
														$group_id,
														$rule_id,
														esc_attr( $rule['value'] ),
														$disabled
													);

												} else {

													printf(
														'<select name="%s[conditionals][%s][%s][value]" class="wpforms-conditional-value" %d>',
														$field_name,
														$group_id,
														$rule_id,
														$disabled
													);

														echo '<option value="">' . esc_html__( '--- Select Choice ---', 'wpforms-lite' ) . '</option>';

														if ( ! empty( $form_fields[ $rule['field'] ]['choices'] ) ) {

															foreach ( $form_fields[ $rule['field'] ]['choices'] as $option_id => $option ) {
																$value    = isset( $rule['value'] ) ? $rule['value'] : '';
																$selected = selected( $option_id, $value, false );
																printf( '<option value="%s" %s>%s</option>', $option_id, $selected, esc_html( $option['label'] ) );
															}
														}

													echo '</select>';
												}
											} else {
												echo '<select></select>';
											} // End if().
										echo '</td>';

										// Rule actions.
										echo '<td class="actions">';
											echo '<button class="wpforms-conditional-rule-add" title="' . esc_attr__( 'Create new rule', 'wpforms-lite' ) . '">' . esc_html_x( 'AND', 'Conditional Logic: new rule logic.', 'wpforms-lite' ) . '</button>';
											echo '<button class="wpforms-conditional-rule-delete" title="' . esc_attr__( 'Delete rule', 'wpforms-lite' ) . '"><i class="fa fa-times-circle" aria-hidden="true"></i></button>';
										echo '</td>';

									echo '</tr>'; // Close individual rule table row.

								endforeach; // End foreach() for individual rules.

							echo '</tbody></table>';

							echo '<h5>' . esc_html_x( 'or', 'Conditional Logic: new rule logic.', 'wpforms-lite' ) . '</h5>';

						echo '</div>'; // Close individual group markup.

					endforeach; // End foreach() for conditional logic groups.

					echo '<button class="wpforms-conditional-groups-add">' . esc_html__( 'Add rule group', 'wpforms-lite' ) . '</button>';

				echo '</div>'; // Close Groups wrap markup.

			endif; // End $enabled.

		echo '</div>'; // Close block markup.

		$output = ob_get_clean();

		if ( $echo ) {
			echo $output; //phpcs:ignore
		} else {
			return $output;
		}
	}

	/**
	 * Alias method for backwards compatibility.
	 *
	 * @since 1.1.0
	 * @deprecated 1.3.8 Use wpforms_conditional_logic()->builder_block() instead.
	 *
	 * @param array $args Data needed for a block to be generated properly.
	 * @param bool  $echo Whether to return or print. Default: print.
	 *
	 * @return string
	 */
	public function conditionals_block( $args = array(), $echo = true ) {

		if ( $echo ) {
			echo $this->builder_block( $args, $echo ); //phpcs:ignore
		} else {
			return $this->builder_block( $args, $echo );
		}
	}

	/**
	 * Process conditional rules.
	 *
	 * Checks if a form passes the conditional logic rules that are provided.
	 *
	 * @since 1.3.8
	 *
	 * @param array $fields       List of fields with data and settings.
	 * @param array $form_data    Form data and settings.
	 * @param array $conditionals List of conditionals.
	 *
	 * @return bool
	 */
	public function process( $fields, $form_data, $conditionals ) {

		if ( empty( $conditionals ) ) {
			return true;
		}

		$pass = false;

		foreach ( $conditionals as $group_id => $group ) {

			$pass_group = true;

			if ( ! empty( $group ) ) {

				foreach ( $group as $rule_id => $rule ) {

					if ( ! isset( $rule['field'] ) || '' == $rule['field'] || ! isset( $rule['operator'] ) ) {
						continue;
					}

					if ( ! isset( $rule['value'] ) && ! in_array( $rule['operator'], array( 'e', '!e' ), true ) ) {
						continue;
					}

					$rule_field    = $rule['field'];
					$rule_operator = $rule['operator'];
					$rule_value    = isset( $rule['value'] ) ? $rule['value'] : '';

					if ( in_array( $fields[ $rule_field ]['type'], array( 'text', 'textarea', 'email', 'url', 'number', 'hidden', 'rating', 'number-slider', 'net_promoter_score' ), true ) ) {

						// Text based fields.
						$left  = trim( strtolower( $fields[ $rule_field ]['value'] ) );
						$right = trim( strtolower( $rule_value ) );

						switch ( $rule_operator ) {
							case '==':
								$pass_rule = ( $left == $right );
								break;
							case '!=':
								$pass_rule = ( $left != $right );
								break;
							case 'c':
								$pass_rule = ( strpos( $left, $right ) !== false );
								break;
							case '!c':
								$pass_rule = ( strpos( $left, $right ) === false );
								break;
							case '^':
								$pass_rule = ( strrpos( $left, $right, -strlen( $left ) ) !== false );
								break;
							case '~':
								$pass_rule = ( ( $temp = strlen( $left ) - strlen( $right ) ) >= 0 && strpos( $left, $right, $temp ) !== false );
								break;
							case 'e':
								$pass_rule = ( '' == $left );
								break;
							case '!e':
								$pass_rule = ( '' != $left );
								break;
							case '>':
								$left      = preg_replace( '/[^0-9.]/', '', $left );
								$pass_rule = ( '' !== $left ) && ( floatval( $left ) > floatval( $right ) );
								break;
							case '<':
								$left      = preg_replace( '/[^0-9.]/', '', $left );
								$pass_rule = ( '' !== $left ) && ( floatval( $left ) < floatval( $right ) );
								break;
							default:
								$pass_rule = apply_filters( 'wpforms_process_conditional_logic', false, $rule_operator, $left, $right );
								break;
						}
					} else {

						// Selector based fields.
						$provided_id = false;

						if (
							in_array( $fields[ $rule_field ]['type'], array( 'payment-multiple', 'payment-checkbox', 'payment-select' ), true ) &&
							isset( $fields[ $rule_field ]['value_raw'] ) &&
							'' != $fields[ $rule_field ]['value_raw']
						) {

							// Payment Multiple/Checkbox fields store the option key,
							// so we can reference that easily.
							$provided_id = $fields[ $rule_field ]['value_raw'];

						} elseif ( isset( $fields[ $rule_field ]['value'] ) && '' != $fields[ $rule_field ]['value'] ) {

							// Other select type fields we don't store the
							// option key so we have to do the logic to locate
							// it ourselves.
							$provided_id = array();

							if ( 'checkbox' === $fields[ $rule_field ]['type'] ) {
								$values = explode( "\n", $fields[ $rule_field ]['value'] );
							} else {
								$values = (array) $fields[ $rule_field ]['value'];
							}

							foreach ( $form_data['fields'][ $rule_field ]['choices'] as $key => $choice ) {

								$choice = array_map( 'sanitize_text_field', $choice );

								foreach ( $values as $value ) {
									$value = wpforms_decode_string( $value );

									if ( in_array( $value, $choice, true ) ) {
										$provided_id[] = $key;
									}
								}
							}
						}

						$left  = (array) $provided_id;
						$right = strtolower( trim( (int) $rule_value ) );

						switch ( $rule_operator ) {
							case '==':
							case 'c': // BC, no longer available.
							case '^': // BC, no longer available.
							case '~': // BC, no longer available.
								$pass_rule = in_array( $right, $left );
								break;
							case '!=':
							case '!c': // BC, no longer available.
								$pass_rule = ! in_array( $right, $left );
								break;
							case 'e':
								$pass_rule = ( false === $left[0] );
								break;
							case '!e':
								$pass_rule = ( false !== $left[0] );
								break;
							default:
								$pass_rule = apply_filters( 'wpforms_process_conditional_logic', false, $rule_operator, $left, $right );
								break;
						}
					} // End if().

					if ( ! $pass_rule ) {
						$pass_group = false;
						break;
					}
				} // End foreach().
			} // End if().

			if ( $pass_group ) {
				$pass = true;
			}
		} // End foreach().

		return $pass;
	}

	/**
	 * Alias function for backwards compatibility.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields       List of fields with data and settings.
	 * @param array $form_data    Form data and settings.
	 * @param array $conditionals List of conditionals.
	 *
	 * @return bool
	 */
	public function conditionals_process( $fields, $form_data, $conditionals ) {
		return $this->process( $fields, $form_data, $conditionals );
	}
}

/**
 * The function which returns the one WPForms_Conditional_Logic_Core instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @since 1.1.0
 *
 * @return WPForms_Conditional_Logic_Core
 */
function wpforms_conditional_logic() {
	return WPForms_Conditional_Logic_Core::instance();
}

wpforms_conditional_logic();
