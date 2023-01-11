package view;
import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.stage.Stage;

import java.net.URL;
import java.util.ResourceBundle;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.control.RadioButton;
import javafx.stage.Stage;

public class windowController implements Initializable {
	
	private Stage primaryStage;
	
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
	
    CategoryAxis xAxis = new CategoryAxis();
    NumberAxis yAxis = new NumberAxis();
	
	@FXML
	private BarChart<String,Number> bc1; 
	@FXML
	private BarChart<String,Number> bc2 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc3 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc4 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc5 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc6 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc7 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc8 = new BarChart<String,Number>(xAxis,yAxis);
	@FXML
	private BarChart<String,Number> bc9 = new BarChart<String,Number>(xAxis,yAxis);
	
	@FXML
	private NumberAxis yaxis;
	
	
	@Override
	public void initialize(URL arg0, ResourceBundle arg1) {
		
	}
	
	public void ajoutGraph(int graphId) {
		 
	}
	
	public void WInitialisation(Stage PStage) {
		this.primaryStage=PStage;
	}
	
	final static String CO2 = "CO2";
    final static String brazil = "Brazil";
    final static String france = "France";
    final static String italy = "Italy";
    final static String usa = "USA";
 
    public void start(Stage stage) {
        stage.setTitle("Bar Chart Sample");
        /*final CategoryAxis xAxis = new CategoryAxis();
        final NumberAxis yAxis = new NumberAxis();
        final BarChart<String,Number> bc1 = 
            new BarChart<String,Number>(xAxis,yAxis);*/
        bc1.setTitle("Evolution CO2");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
 
        XYChart.Series series1 = new XYChart.Series<>();
        series1.setName("2003");       
        series1.getData().add(new XYChart.Data(CO2, 25601.34));
        
 
       
 
        bc1.getData().addAll(series1);
    }
    
    
 
    
}

	

