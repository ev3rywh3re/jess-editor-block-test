/**
 * Jess - Editable Block test
 */
( function() {
	var __                = wp.i18n.__; // The __() function for internationalization.
	var createElement     = wp.element.createElement; // The wp.element.createElement() function to create elements.
	var registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
	var RichText          = wp.editor.RichText; // For creating editable elements.

	/**
	* Register block
	*
	* @param  {string}   name     Block name.
	* @param  {Object}   settings Block settings.
	* @return {?WPBlock}          Block itself, if registered successfully,
	*                             otherwise "undefined".
	*/
	registerBlockType(
		'jess/block-test', // Block name. Prefix namespace, class
		{
			title: __( 'Jess block test: wavy lines on hover.' ), // Block title.
			icon: 'edit', // Block icon.
			category: 'common', // Block category in editor.
			attributes: {
				content: {
					type: 'string',
					default: 'Editable block content...',
				},
			},

			// WP - Editor - block
			edit: function( props ) {
				var content = props.attributes.content;
				var focus = props.focus;

				function onChangeContent( updatedContent ) {
					props.setAttributes( { content: updatedContent } );
				}

				return createElement(
					RichText,
					{
						tagName: 'span',
						className: props.className,
						value: content,
						onChange: onChangeContent,
						focus: focus,
						onFocus: props.setFocus
					},
				);
			},

			// WP - Save content
			save: function( props ) {
				var content = props.attributes.content;

				return createElement( RichText.Content,
					{
						'tagName': 'span',
						'value': content
					}
				);
			},
		}
	);
})();
