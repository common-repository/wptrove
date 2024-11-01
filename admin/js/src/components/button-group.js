/* global wptroveEditorVariables, wp */
const { Button, ButtonGroup } = wp.components;

const WptroveButtonGroup = (props) => {

    let wptroveClassObject = {}, wptroveKeys;

    wptroveKeys = Object.keys(props.options);

    wptroveKeys.forEach( (item ) => {
      wptroveClassObject[item] = "";
    } );

    if( props.value ){
      wptroveClassObject[ props.value ] = "primary";
    }

	return(

		<div className="wptrove-button-group-container" >

			<ButtonGroup>

				{wptroveKeys.map(( keyName ) => (
					<Button 
						className={ wptroveClassObject[keyName] }
						variant={ wptroveClassObject[keyName] }
						onClick={ 
							() => {
								props.wptroveCallback(keyName);
							} 
						}
					>
						{props.options[keyName].name}
					</Button>
				))}

			</ButtonGroup>
		
		</div>			

	);

}

export default WptroveButtonGroup;