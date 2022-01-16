const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, ColorPalette } = wp.editor;
const { PanelBody } = wp.components;

import { ReactComponent as Logo } from '../pizzeria-icon.svg';

registerBlockType( 'lapizzeria/boxes', {
    title: 'Pizzeria Cajas',
    icon: { src: Logo },
    category: 'lapizzeria',
    attributes: {
        headingBox: {
            type: 'string',
            source: 'html',
            selector: '.box h2',
        },
        textBox: {
            type: 'string',
            source: 'html',
            selector: '.box p',
        },
        colorFondo: {
            type: 'string',
        } 
    },
    edit: (props) => {

        const { attributes: { headingBox, textBox, colorFondo }, setAttributes } = props ; 

        const onChangeHeadingBox = ( newHeading ) => {
            setAttributes( { headingBox: newHeading } );
        };

        const onChangeTextBox = ( newText ) => {
            setAttributes( { textBox: newText } );
        };

        const onChangeColorFondo = ( newColor ) => {
            setAttributes( { colorFondo: newColor } );
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody
                        title="Color de Fondo"
                        initialOpen={true}
                    >
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <label className="components-base-control__label">
                                    Color de Fondo
                                </label>
                                <ColorPalette 
                                    onChange={ onChangeColorFondo }
                                    value={ colorFondo }
                                />
                            </div>
                        </div>
                    </PanelBody>
                </InspectorControls>
                    
                <div className="box" style={{ backgroundColor: colorFondo }}>
                    <h2>
                        <RichText 
                            placeholder = "Agrega el encabezado"
                            onChange = { onChangeHeadingBox }
                            value = { headingBox }
                        />
                    </h2>
                    <p>
                        <RichText 
                            placeholder = "Agrega el texto"
                            onChange = { onChangeTextBox }
                            value = { textBox }
                        />
                    </p>
                </div>
            </>
        )
    },
    save: (props) => {

        const { attributes: { headingBox, textBox, colorFondo }, setAttributes } = props ; 

        return (
            <div className="box" style={{ backgroundColor: colorFondo }}>
                <h2>
                    <RichText.Content value={ headingBox } />
                </h2>

                <p>
                    <RichText.Content value={ textBox } />
                </p>
            </div>
        )
    }
});
