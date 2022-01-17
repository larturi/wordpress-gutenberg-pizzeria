const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, ColorPalette, BlockControls, AlignmentToolbar } = wp.editor;
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
        },
        colorTexto: {
            type: 'string',
        },
        alineacionContenido: {
            type: 'string',
            default: 'center',
        } 
    },
    edit: (props) => {

        const { attributes: { headingBox, textBox, colorFondo, colorTexto, alineacionContenido }, setAttributes } = props ; 

        const onChangeHeadingBox = ( newHeading ) => {
            setAttributes( { headingBox: newHeading } );
        };

        const onChangeTextBox = ( newText ) => {
            setAttributes( { textBox: newText } );
        };

        const onChangeColorFondo = ( newColor ) => {
            setAttributes( { colorFondo: newColor } );
        };

        const onChangeColorTexto = ( newColor ) => {
            setAttributes( { colorTexto: newColor } );
        };

        const onChangeAlinearContenido = ( newAlineacion ) => {
            setAttributes( { alineacionContenido: newAlineacion } );
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

                    <PanelBody
                        title="Color de Texto"
                        initialOpen={false}
                    >
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <label className="components-base-control__label">
                                    Color de Texto
                                </label>
                                <ColorPalette 
                                    onChange={ onChangeColorTexto }
                                    value={ colorTexto }
                                />
                            </div>
                        </div>
                    </PanelBody>
                </InspectorControls>

                <BlockControls>
                    <AlignmentToolbar
                        onChange={onChangeAlinearContenido}
                    />
                </BlockControls>
                    
                <div className="box" style={{ backgroundColor: colorFondo, textAlign: alineacionContenido }}>
                    <h2 style={{ color: colorTexto }}>
                        <RichText 
                            placeholder = "Agrega el encabezado"
                            onChange = { onChangeHeadingBox }
                            value = { headingBox }
                        />
                    </h2>
                    <p style={{ color: colorTexto }}>
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

        const { attributes: { headingBox, textBox, colorFondo, colorTexto, alineacionContenido }, setAttributes } = props ; 

        return (
            <div className="box" style={{ backgroundColor: colorFondo, textAlign: alineacionContenido }}>
                <h2 style={{ color: colorTexto }}>
                    <RichText.Content value={ headingBox } />
                </h2>

                <p style={{ color: colorTexto }}>
                    <RichText.Content value={ textBox } />
                </p>
            </div>
        )
    }
});
