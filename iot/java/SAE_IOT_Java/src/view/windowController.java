package view;

import java.net.URL;
import java.util.ResourceBundle;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ListView;
import javafx.scene.control.RadioButton;

public class windowController implements Initializable {

	@FXML
	private ListView<String> listViewData;
	
	@FXML
	private RadioButton bActivity;
	
	@FXML
	private RadioButton bCo2;
	
	@FXML
	private RadioButton bHumidity;
	
	@FXML
	private RadioButton bIllumination;
	
	@FXML
	private RadioButton bInfrared;
	
	@FXML
	private RadioButton bInfraredAndVisible;
	
	@FXML
	private RadioButton bPressure;
	
	@FXML
	private RadioButton bTemperature;
	
	@FXML
	private RadioButton bTvoc;
	
	@Override
	public void initialize(URL arg0, ResourceBundle arg1) {
		// TODO Auto-generated method stub
		
	}
	
	
	
}
