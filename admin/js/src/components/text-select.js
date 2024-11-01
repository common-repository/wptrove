/* global wptroveEditorVariables */
const WptroveTextSelectControl = (props) => {

    let wptroveClassObject = {}, wptroveKeys;

    wptroveKeys = Object.keys(props.options);

	if( props.value ){
		wptroveClassObject[ props.value ] = "wptrove-text-select-option wptrove-text-select-option--selected";
	}

    wptroveKeys.forEach( (item ) => {

		if ( !props.value ) {

			if ( props.options[item]['default'] ) {
				wptroveClassObject[ item ] = "wptrove-text-select-option wptrove-text-select-option--selected";
			}else{
				wptroveClassObject[item] = "wptrove-text-select-option";
			}

		}else{

			if( item !== props.value ){
				wptroveClassObject[item] = "wptrove-text-select-option";
			}

		}

    } );

	return(

		<div className="wptrove-text-select-option-container" >

			{wptroveKeys.map(( keyName ) => (
				<p 
					className={ wptroveClassObject[keyName] }
					onClick={ 
						() => {
							props.wptroveCallback(keyName);
						} 
					}
				>
					{props.options[keyName].name}
					<span className="wptrove-text-select-option__icon"></span>
				</p>
			))}
			
		</div>			

	);

}

export default WptroveTextSelectControl;