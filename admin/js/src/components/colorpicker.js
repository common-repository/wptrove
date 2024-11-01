/* global wptroveEditorVariables, wp */
const { ColorPicker } = wp.components;

const WptroveColorPicker = ( props ) => {
  const { onChange, color, title } = props;
  return(
    <>
        <div className="wptrove-color-container">

            <div className="wptrove-color-label">
            <p>{title}</p>
            </div>

            <div className="wptrove-color-input">
                 <ColorPicker
                    color={ color }
                    onChangeComplete={ (value) => onChange(value) }
                />
            </div>            

        </div>
    </>
  )
}

export default WptroveColorPicker;