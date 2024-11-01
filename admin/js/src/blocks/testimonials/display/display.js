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
//const { __experimentalGradientPickerControl: ColorGradientControl, __experimentalGradientPicker: CustomGradientPicker, __experimentalGradientPicker: GradientPicker} = wp.blockEditor;

import WptroveNumberControl from '../../../components/number';
import WptroveColorPicker from '../../../components/colorpicker';
import WptroveImageRadioControl from '../../../components/image-radio';
import WptroveTextSelectControl from '../../../components/text-select';
import WptroveButtonGroup from '../../../components/button-group';

const wptrovetestimonialLayoutOptions = {

	layoutOne : { image : 'layout-one.jpg', name : __( 'Layout One', 'wptrove' ) },
	layoutTwo : { image : 'layout-two.jpg', name : __( 'Layout Two', 'wptrove' ) },

}

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


registerBlockType( 'wptrove/testimonial-display', {

    edit( { attributes, setAttributes } ) {

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
                        title={__('Text Color', 'wptrove')}
                        initialOpen={ false }
                    >
                        <ColorPicker
                            color={ attributes.textColor }
                            onChangeComplete={ (value) => setAttributes({textColor:value.rgb}) }
                        />
                    </PanelBody>   

                    <PanelBody
                        title={__('Text Sizes', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveButtonGroup 
                            value={ attributes.textFontSizeType }
                            options={ wptroveFontSizeOptions }
                            wptroveCallback={ ( newValue ) => setAttributes( { textFontSizeType: newValue } ) }
                            wptroveSettingName="testimonialsLayout"

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
                            onChange={ (value) => setAttributes( { customerNameSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.customerNameSize }
                            title={ __( 'Customer Name Size', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { customerDesigSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.customerDesigSize }
                            title={ __( 'Designation Size', 'wptrove' ) }
                        />                                   
                    </PanelBody>

                    <PanelBody
                        title={__('Testimonial Layout', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveImageRadioControl 
                            value={ attributes.layout }
                            options={ wptrovetestimonialLayoutOptions }
                            wptroveCallback={ ( newValue ) => setAttributes( { layout: newValue } ) }
                            wptroveSettingName="testimonialsLayout"

                        />
                    </PanelBody>

                    { 'layoutTwo' === attributes.layout &&
                    <PanelBody
                        title={__('Testimonial BG', 'wptrove')}
                        initialOpen={ false }
                    >
                        <ColorPicker
                            color={ attributes.testimonialBgColor }
                            onChangeComplete={ (value) => setAttributes({testimonialBgColor:value.rgb}) }
                        />
                    </PanelBody>
                    }      

                    { 'layoutTwo' === attributes.layout &&
                    <PanelBody
                        title={__('Testimonial Borders', 'wptrove')}
                        initialOpen={ false }
                    >
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { testimonialBorderSize: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.testimonialBorderSize }
                            title={ __( 'Border width', 'wptrove' ) }
                        />
                        <WptroveNumberControl
                            onChange={ (value) => setAttributes( { testimonialBorderRadius: value } ) }
                            shiftStep={ 2 }
                            step={1}
                            value={ attributes.testimonialBorderRadius }
                            title={ __( 'Border Radius', 'wptrove' ) }
                        />
                        <WptroveColorPicker
                            color={ attributes.testimonialBorderColor }
                            onChange={ (value) => setAttributes({testimonialBorderColor:value.rgb}) }
                            title={ __( 'Border color', 'wptrove' ) }
                        />                                              
                    </PanelBody>
                    }                                         

                </InspectorControls>

                <ServerSideRender
							
                    block="wptrove/testimonial-display"
                    attributes={{
                        containerBgColor: attributes.containerBgColor,
                        containerBgGradient: attributes.containerBgGradient,
                        textColor: attributes.textColor,
                        containerBorderSize: attributes.containerBorderSize,
                        containerPaddingUnits: attributes.containerPaddingUnits,
                        containerPaddingTop: attributes.containerPaddingTop,
                        containerPaddingRight: attributes.containerPaddingRight,
                        containerPaddingBottom: attributes.containerPaddingBottom,
                        containerPaddingLeft: attributes.containerPaddingLeft,
                        containerBorderRadius: attributes.containerBorderRadius,
                        containerBorderColor: attributes.containerBorderColor,
                        textFontSizeType: attributes.textFontSizeType,
                        headingSize: attributes.headingSize,
                        textSize: attributes.textSize,
                        customerNameSize: attributes.customerNameSize,
                        customerDesigSize: attributes.customerDesigSize,
                        layout: attributes.layout,
                        testimonialBgColor: attributes.testimonialBgColor,
                        testimonialBorderSize: attributes.testimonialBorderSize,
                        testimonialBorderRadius: attributes.testimonialBorderRadius,
                        testimonialBorderColor: attributes.testimonialBorderColor
                    }}

                />                    

            </div>

        );

    },
    save( { attributes } ) {
        return null;
    },
} );