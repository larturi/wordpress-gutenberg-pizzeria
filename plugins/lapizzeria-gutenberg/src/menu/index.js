const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

import { ReactComponent as Logo } from '../pizzeria-icon.svg';

registerBlockType( 'lapizzeria/menu', {
    title: 'La Pizzeria Menu',
    icon: { src: Logo },
    category: 'lapizzeria',

    edit: (props) => {
        return <p>Menu</p>;
    },

    save: (pops) => {
        return null;
    }
});
