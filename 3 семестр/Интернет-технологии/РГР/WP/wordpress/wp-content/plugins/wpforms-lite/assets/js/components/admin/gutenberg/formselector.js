/* global wpforms_gutenberg_form_selector, wp */
/*jshint es3: false, esversion: 6 */

'use strict';

const { __ } = wp.i18n;
const { createElement } = wp.element;
const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.editor;
const { SelectControl, ToggleControl, PanelBody, ServerSideRender, Placeholder } = wp.components;

const wpformsIcon = createElement( 'svg', { width: 20, height: 20, viewBox: '0 0 1792 1792', className: 'dashicon' },
	createElement( 'path', { fill: 'currentColor', d: 'M643 911v128h-252v-128h252zm0-255v127h-252v-127h252zm758 511v128h-341v-128h341zm0-256v128h-672v-128h672zm0-255v127h-672v-127h672zm135 860v-1240q0-8-6-14t-14-6h-32l-378 256-210-171-210 171-378-256h-32q-8 0-14 6t-6 14v1240q0 8 6 14t14 6h1240q8 0 14-6t6-14zm-855-1110l185-150h-406zm430 0l221-150h-406zm553-130v1240q0 62-43 105t-105 43h-1240q-62 0-105-43t-43-105v-1240q0-62 43-105t105-43h1240q62 0 105 43t43 105z' } )
);

registerBlockType( 'wpforms/form-selector', {
	title: wpforms_gutenberg_form_selector.i18n.title,
	description: wpforms_gutenberg_form_selector.i18n.description,
	icon: wpformsIcon,
	keywords: wpforms_gutenberg_form_selector.i18n.form_keywords,
	category: 'widgets',
	attributes: {
		formId: {
			type: 'string',
		},
		displayTitle: {
			type: 'boolean',
		},
		displayDesc: {
			type: 'boolean',
		},
	},
	edit( props ) {
		const { attributes: { formId = '', displayTitle = false, displayDesc = false }, setAttributes } = props;
		const formOptions = wpforms_gutenberg_form_selector.forms.map( value => (
			{ value: value.ID, label: value.post_title }
		) );
		let jsx;

		formOptions.unshift( { value: '', label: wpforms_gutenberg_form_selector.i18n.form_select } );

		function selectForm( value ) {
			setAttributes( { formId: value } );
		}

		function toggleDisplayTitle( value ) {
			setAttributes( { displayTitle: value } );
		}

		function toggleDisplayDesc( value ) {
			setAttributes( { displayDesc: value } );
		}

		jsx = [
			<InspectorControls key="wpforms-gutenberg-form-selector-inspector-controls">
				<PanelBody title={ wpforms_gutenberg_form_selector.i18n.form_settings }>
					<SelectControl
						label={ wpforms_gutenberg_form_selector.i18n.form_selected }
						value={ formId }
						options={ formOptions }
						onChange={ selectForm }
					/>
					<ToggleControl
						label={ wpforms_gutenberg_form_selector.i18n.show_title }
						checked={ displayTitle }
						onChange={ toggleDisplayTitle }
					/>
					<ToggleControl
						label={ wpforms_gutenberg_form_selector.i18n.show_description }
						checked={ displayDesc }
						onChange={ toggleDisplayDesc }
					/>
					<p class="wpforms-gutenberg-panel-notice">
						<strong>{ wpforms_gutenberg_form_selector.i18n.panel_notice_head }</strong><br />
						{ wpforms_gutenberg_form_selector.i18n.panel_notice_text }<br />
						<a href="https://wpforms.com/docs/how-to-properly-test-your-wordpress-forms-before-launching-checklist/" target="_blank">{ wpforms_gutenberg_form_selector.i18n.panel_notice_link }</a>
					</p>

				</PanelBody>
			</InspectorControls>
		];

		if ( formId ) {
			jsx.push(
				<ServerSideRender
					key="wpforms-gutenberg-form-selector-server-side-renderer"
					block="wpforms/form-selector"
					attributes={ props.attributes }
				/>
			);
		} else {
			jsx.push(
				<Placeholder
					key="wpforms-gutenberg-form-selector-wrap"
					className="wpforms-gutenberg-form-selector-wrap">
					<img src={ wpforms_gutenberg_form_selector.logo_url }/>
					<h3>{ wpforms_gutenberg_form_selector.i18n.title }</h3>
					<SelectControl
						key="wpforms-gutenberg-form-selector-select-control"
						value={ formId }
						options={ formOptions }
						onChange={ selectForm }
					/>
				</Placeholder>
			);
		}

		return jsx;
	},
	save() {
		return null;
	},
} );
