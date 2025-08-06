import { registerBlockType } from '@wordpress/blocks';
import { TextControl, URLInputButton, ColorPicker } from '@wordpress/components';

registerBlockType('alc/cta-banner', {
  edit({ attributes, setAttributes }) {
    return (
      <div>
        <TextControl
          label="Texte"
          value={attributes.text}
          onChange={(text) => setAttributes({ text })}
        />
        <URLInputButton
          label="URL"
          url={attributes.url}
          onChange={(url) => setAttributes({ url })}
        />
        <ColorPicker
          color={attributes.bgColor}
          onChangeComplete={(color) => setAttributes({ bgColor: color.hex })}
        />
      </div>
    );
  },
  save({ attributes }) {
    return (
      <div style={{ backgroundColor: attributes.bgColor }}>
        <a href={attributes.url}>{attributes.text}</a>
      </div>
    );
  }
});
