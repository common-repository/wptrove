/* global wp, jQuery */
const { __ } = wp.i18n;
const { registerBlockCollection, registerBlockType, query } = wp.blocks;
const { RichText, InspectorControls, useBlockProps, InnerBlocks, BlockControls, PlainText, PanelColorSettings } = wp.blockEditor;
const {
	CheckboxControl,
	RadioControl,
	TextControl,
	ToggleControl,
	SelectControl,
    __experimentalNumberControl: NumberControl,
    GradientPicker,
    Button, ButtonGroup
} = wp.components;	
const { serverSideRender: ServerSideRender } = wp;
const { PanelBody, Icon, ColorPicker } = wp.components;

import WptroveNumberControl from '../../../components/number';
import WptroveColorPicker from '../../../components/colorpicker';
import WptroveImageRadioControl from '../../../components/image-radio';
import WptroveButtonGroup from '../../../components/button-group';

const wptrovePaddingTypeOptions = {

	px : { name : __( 'Px', 'wptrove' ), default : true },
	em : { name : __( 'EM', 'wptrove' ), default : false },
    pc : { name : __( '%', 'wptrove' ), default : false },

}

const wptroveFontSizeOptions = {

	px : { name : __( 'Px', 'wptrove' ), default : true },
	em : { name : __( 'EM', 'wptrove' ), default : false },
    rem : { name : __( 'REM', 'wptrove' ), default : false },

}

registerBlockType( 'wptrove/add-testimonials', {

    edit( { attributes, setAttributes, isSelected } ) {		

        const blockProps = useBlockProps();

        return (

            <div { ...blockProps }>
                <InspectorControls>

                    <PanelBody
                        title={__('Container BG Color', 'wptrove')}
                        initialOpen={ false }
                    >
                        <ColorPicker
                            color={ attributes.containerBgColor }
                            onChangeComplete={ (value) => setAttributes({containerBgColor:value.rgb}) }
                        />
                    </PanelBody>                    

                    <PanelBody
                        title={__('Container BG Gradient', 'wptrove')}
                        initialOpen={ false }
                    >
                        <GradientPicker
                            value={ attributes.containerBgGradient }
                            onChange={ ( colorValue ) => setAttributes( { containerBgGradient: colorValue } ) }

                        />
                    </PanelBody>

                    <PanelBody
                        title={__('Container Padding', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveButtonGroup 
                            value={ attributes.containerPaddingUnits }
                            options={ wptrovePaddingTypeOptions }
                            wptroveCallback={ ( newValue ) => setAttributes( { containerPaddingUnits: newValue } ) }
                            wptroveSettingName="testimonialsLayout"

                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerPaddingTop: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerPaddingTop }
                            title={ __( 'Padding Top', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerPaddingRight: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerPaddingRight }
                            title={ __( 'Padding Right', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerPaddingBottom: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerPaddingBottom }
                            title={ __( 'Padding Bottom', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerPaddingLeft: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerPaddingLeft }
                            title={ __( 'Padding Left', 'wptrove' ) }
                        />                   
                    </PanelBody>

                    <PanelBody
                        title={__('Container Borders', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerBorderSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerBorderSize }
                            title={ __( 'Border width', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { containerBorderRadius: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.containerBorderRadius }
                            title={ __( 'Border Radius', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.containerBorderColor }
                            onChange={ (value) => setAttributes({containerBorderColor:value.rgb}) }
                            title={ __( 'Border color', 'wptrove' ) }
                        />                                              
                    </PanelBody>

                    <PanelBody
                        title={__('Text Sizes', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveButtonGroup 
                            value={ attributes.fontUnits }
                            options={ wptroveFontSizeOptions }
                            wptroveCallback={ ( newValue ) => setAttributes( { fontUnits: newValue } ) }

                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { headingSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.headingSize }
                            title={ __( 'Heading Size', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { textSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.textSize }
                            title={ __( 'Text Size', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { fieldTextSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.fieldTextSize }
                            title={ __( 'Field Text Size', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { submitTextSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.submitTextSize }
                            title={ __( 'Submit Text Size', 'wptrove' ) }
                        />
                    </PanelBody>

                    <PanelBody
                        title={__('Text Colors', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveColorPicker
                            color={ attributes.headingColor }
                            onChange={ (value) => setAttributes({headingColor:value.rgb}) }
                            title={ __( 'Heading color', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.textColor }
                            onChange={ (value) => setAttributes({textColor:value.rgb}) }
                            title={ __( 'Text color', 'wptrove' ) }
                        />
                    </PanelBody>

                    <PanelBody
                        title={__('Form Field Colors', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveColorPicker
                            color={ attributes.fieldBgColor }
                            onChange={ (value) => setAttributes({fieldBgColor:value.rgb}) }
                            title={ __( 'Field BG color', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.fieldTextColor }
                            onChange={ (value) => setAttributes({fieldTextColor:value.rgb}) }
                            title={ __( 'Field Text color', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.fieldBorderColor }
                            onChange={ (value) => setAttributes({fieldBorderColor:value.rgb}) }
                            title={ __( 'Field Border color', 'wptrove' ) }
                        />
                    </PanelBody>

                    <PanelBody
                        title={__('Submit Field Colors', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveColorPicker
                            color={ attributes.submitBgColor }
                            onChange={ (value) => setAttributes({submitBgColor:value.rgb}) }
                            title={ __( 'Submit BG color', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.submitTextColor }
                            onChange={ (value) => setAttributes({submitTextColor:value.rgb}) }
                            title={ __( 'Submit Text color', 'wptrove' ) }
                        />
                    </PanelBody>

                </InspectorControls>

                <ServerSideRender
                            
                    block="wptrove/add-testimonials"
                    attributes={{
                        containerBgColor: attributes.containerBgColor,
                        containerBgGradient: attributes.containerBgGradient,
                        containerPaddingUnits: attributes.containerPaddingUnits,
                        containerPaddingTop: attributes.containerPaddingTop,
                        containerPaddingRight: attributes.containerPaddingRight,
                        containerPaddingBottom: attributes.containerPaddingBottom,
                        containerPaddingLeft: attributes.containerPaddingLeft,
                        containerBorderSize: attributes.containerBorderSize,
                        containerBorderRadius: attributes.containerBorderRadius,
                        containerBorderColor: attributes.containerBorderColor,
                        fontUnits:attributes.fontUnits,
                        headingSize: attributes.headingSize,
                        headingColor: attributes.headingColor,
                        textSize: attributes.textSize,
                        textColor: attributes.textColor,
                        fieldBgColor: attributes.fieldBgColor,
                        fieldTextColor: attributes.fieldTextColor,
                        fieldTextSize: attributes.fieldTextSize,
                        fieldBorderColor: attributes.fieldBorderColor,
                        submitTextSize: attributes.submitTextSize,
                        submitBgColor: attributes.submitBgColor,
                        submitTextColor: attributes.submitTextColor,
                    }}

                />

            </div>

        );

    },
    save( { attributes } ) {
        return null;
    },

} );