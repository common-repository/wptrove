/* global wptroveEditorVariables */
const WptroveImageRadioControl = (props) => {

    let wptroveClassObject = {}, wptroveKeys;

    wptroveKeys = Object.keys(props.options);

    wptroveKeys.forEach( (item ) => {
      wptroveClassObject[item] = "wptrove-image-radio-option";
    } );

    if( props.value ){
      wptroveClassObject[ props.value ] = "wptrove-image-radio-option-selected";
    }

		return(

			<div className="wptrove-image-radio-container" >

				{wptroveKeys.map(( keyName ) => (
				<p className={ wptroveClassObject[keyName] }>
					<img 
						src={ wptroveEditorVariables.pluginUrl + '/admin/images/' + props.options[keyName].image } 
						onClick={ 
							() => {
								props.wptroveCallback(keyName);
							} 
						} 
					/>
					<span>{props.options[keyName].name}</span>
				</p>
				))}
			
			</div>			

		);

}

export default WptroveImageRadioControl;