/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */

import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

const groups = [];

const activeGroups = wp.apiFetch({
	path: 'lifeline/v1/groups',
}).then(data => {
	data.forEach(group => {
		groups.push(group);
	});
	
	return groups;
});

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { groupId, groupName, displayTitle, productColumns } = attributes;

	return (
		<>
            <InspectorControls>
                <PanelBody title={ __( 'Settings', 'lifeline-groups-block' ) }>
					<SelectControl
						label="Display title"
						value={ displayTitle || true }
						options={ [
							{ label: 'Yes', value: true },
							{ label: 'No', value: false }
						] }
						onChange={ ( value ) =>
                            setAttributes( { displayTitle: value } )
                        }
						__nextHasNoMarginBottom
					/>

					<TextControl
                        label={ __(
                            'Products per row',
                            'lifeline-groups-block'
                        ) }
                        value={ productColumns || 6 }
                        onChange={ ( value ) =>
                            setAttributes( { productColumns: value } )
                        }
                    />

					<SelectControl
						label="Select group"
						value={ groupId || '' }
						options={ groups }
						onChange={ ( value ) => {
							let label = groups.filter( gr => { 
								return gr.value === value;
							} );


							console.log(value);
							console.log(label[0]);

							setAttributes( { groupId: value } );
                            setAttributes( { groupName: label[0].label } );
						} }
						__nextHasNoMarginBottom
					/>
                </PanelBody>
            </InspectorControls>

			<p { ...useBlockProps() }>
				{ 
					<span>Group: { groupName }</span>
				}
			</p>

		</>
	);
}
