const { dispatch, select, withSelect } = wp.data;

const WptroveSimpleSelectControl = withSelect( ( select, ownProps ) => {

    return {
      containerKey : ownProps.wptroveKey,
      containerClass : select( 'wptrove' ).getSimpleSelectClass( ownProps.wptroveKey ),
    };


} )( 

	(props) => {

		return(

      <>
      <div data-wptrove-visible={props.containerClass} className="wptrove-simple-select-container">

          <div className="wptrove-simple-select-label">
            <p className="wptrove-simple-select-label__text">{props.title}</p>
            <span 
              onClick={ 
                () => {
                  var newClass = ( props.containerClass === "yes" ) ? "no" : "yes";
                  dispatch( 'wptrove' ).setSimpleSelectClass( props.containerKey, newClass );
                } 
              }
              className="wptrove-simple-select-label__icon"
            >

            </span>
          </div>

          <div className="wptrove-simple-select-content">
              <p>Some content comes here</p>
          </div>            

      </div>
      </>		

		);

	}

);

export default WptroveSimpleSelectControl;