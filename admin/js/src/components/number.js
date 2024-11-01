const { __experimentalNumberControl: NumberControl } = wp.components;

const WptroveNumberControl = ( props ) => {
  const { onChange, shiftStep, step, value, title, className } = props;
  return(
    <>
        <div className="wptrove-number-container">

            <div className="wptrove-number-label">
            <p className={className}>{title}</p>
            </div>

            <div className="wptrove-number-input">
                <NumberControl
                    onChange={ (value) => onChange( value ) }
                    shiftStep={ shiftStep }
                    step={step}
                    value={ value }
                />
            </div>            

        </div>
    </>
  )
}

export default WptroveNumberControl;