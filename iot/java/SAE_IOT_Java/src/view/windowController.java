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
	private RadioButton bActivité;
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
	private BarChart<String,Number> bc2;
	@FXML
	private BarChart<String,Number> bc3;
	@FXML
	private BarChart<String,Number> bc4;
	@FXML
	private BarChart<String,Number> bc5;
	@FXML
	private BarChart<String,Number> bc6;
	@FXML
	private BarChart<String,Number> bc7;
	@FXML
	private BarChart<String,Number> bc8;
	@FXML
	private BarChart<String,Number> bc9;
	
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
	
	final static String Activité = "Activité";
    final static String CO2 = "CO2";
    final static String humidité = "humidité";
    final static String Illumination = "Illumination";
    final static String Infrarouge = "Infrarouge";
    final static String Infrarouge_visible = "Infrarouge_visible";
    final static String Pression = "Pression";
    final static String température = "température";
    final static String qualité_air = "qualité_air";
 
    public void start(Stage stage) {
        stage.setTitle("Bar Chart Sample");
        /*final CategoryAxis xAxis = new CategoryAxis();
        final NumberAxis yAxis = new NumberAxis();
        final BarChart<String,Number> bc1 = 
            new BarChart<String,Number>(xAxis,yAxis);*/
        bc1.setTitle("Evolution Activité");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc2.setTitle("Evolution CO2");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc3.setTitle("Evolution humidités");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc4.setTitle("Evolution Illumination");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc5.setTitle("Evolution Infrarouge");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc6.setTitle("Evolution Infrarouge_visible");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc7.setTitle("Evolution Pression");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc8.setTitle("Evolution température");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");
        
        bc9.setTitle("Evolution qualité_air");
        xAxis.setLabel("Country");       
        yAxis.setLabel("Value");

 
        XYChart.Series series1 = new XYChart.Series<>();      
        series1.getData().add(new XYChart.Data(Activité, 25601.34));
        
        XYChart.Series series2 = new XYChart.Series<>();
        series2.getData().add(new XYChart.Data(CO2, 15601.34));
        
        XYChart.Series series3 = new XYChart.Series<>();
        series3.getData().add(new XYChart.Data(humidité, 10000.34));
        
        XYChart.Series series4 = new XYChart.Series<>();
        series4.getData().add(new XYChart.Data(Illumination, 5000.34));
        
        XYChart.Series series5 = new XYChart.Series<>();     
        series5.getData().add(new XYChart.Data(Infrarouge, 25601.34));
        
        XYChart.Series series6 = new XYChart.Series<>();
        series6.getData().add(new XYChart.Data(CO2, 15601.34));
        
        XYChart.Series series7 = new XYChart.Series<>();
        series7.getData().add(new XYChart.Data(humidité, 10000.34));
        
        XYChart.Series series8 = new XYChart.Series<>();
        series8.getData().add(new XYChart.Data(Illumination, 5000.34));
        
        XYChart.Series series9 = new XYChart.Series<>();
        series9.getData().add(new XYChart.Data(Illumination, 5000.34));
       
 
        bc1.getData().addAll(series1);
        bc2.getData().addAll(series2);
        bc3.getData().addAll(series3);
        bc4.getData().addAll(series4);
        bc5.getData().addAll(series5);
        bc6.getData().addAll(series6);
        bc7.getData().addAll(series7);
        bc8.getData().addAll(series8);
        bc9.getData().addAll(series9);
    }
    
    
 
    
}

	

