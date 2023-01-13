package view;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.stage.Stage;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.net.URL;
import java.util.ResourceBundle;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.RadioButton;
import javafx.stage.FileChooser;
import javafx.stage.FileChooser.ExtensionFilter;

public class windowController implements Initializable {
	
	private static Stage primaryStage;
	
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
	
	
	
	private File path;
	private File activity;
	
	public void initialize(URL arg0, ResourceBundle arg1) {
		
	}
	
	public void ajoutGraph(int graphId) {
		 
	}
	
	/**
	 * Permet d'initialiser le controlleur
	 * 
	 * Demande à l'utilisateur de renseigner le chemin vers le programme python qui récupère les données des capteurs.
	 * Sera utile pour la methode reading().
	 * @param PStage le PrimaryStage de l'application, qui sera aussi stocké dans le controlleur
	 * @return noRet un int qui va servir à savoir si le programme continue ou non
	 */
	public int WInitialisation(Stage PStage) {
		this.primaryStage=PStage;
		
		int noRet=1;
		
		/*File pyth = new File("./../../../../python/Python_SAE_IoT_1G4.py");
		System.out.println(pyth.getAbsolutePath());
		if(pyth.exists()) {
			System.out.println("Python existant !");
		}
		else {*/
			Alert pythPath=new Alert(AlertType.WARNING);
			pythPath.setTitle("python");
			pythPath.setHeaderText("Chemin vers le python");
			pythPath.setContentText("Afin de permettre à cette application java de fonctionner correctement, vous devez indiquer où se trouve le programme python.\n"
			+"Merci d'indiquer ou se trouve le python.");
			
			pythPath.showAndWait();
			
			Boolean valide = false;

			while(valide==false) {
				try {
					FileChooser fileChooser = new FileChooser();
					fileChooser.setTitle("Sélectionnez un répertoire");
					fileChooser.setInitialDirectory(new File(System.getProperty("user.home")));
					fileChooser.getExtensionFilters().addAll(
					    new ExtensionFilter("Python Files", "*.py")
					);
					File selectedFile = fileChooser.showOpenDialog(null);
					if (selectedFile != null) {
					  System.out.println("Le chemin d'accès sélectionné est : " + selectedFile.getAbsolutePath());
					  String getpath= selectedFile.getAbsolutePath().substring(0, selectedFile.getAbsolutePath().lastIndexOf("Python_SAE_IoT_1G4.py"));
					  path=new File(getpath);
					}
					else {
						//le programme sera arreté
						noRet=0; 
					}
					
					valide=true;
				}
				catch (Exception e) {
					pythPath=new Alert(AlertType.ERROR);
					pythPath.setTitle("python");
					pythPath.setHeaderText("Erreur");
					pythPath.setContentText("Chemin vers le fichier python invalide");
					
					pythPath.showAndWait();
				}
			}
		//}
		return noRet;
	}
	
	/**
	 * Cette methode permet de lire les données d'un fichier donné en paramètre.
	 * Le fichier doit se trouver dans le dossier du python (renseigné dans la méthode WInitialisation).
	 * reading() renvoie la dernière ligne du fichier, 
	 * 
	 * @param fileName le nom du fichier dont les données doivent être lues
	 * @return lastLine la dernière ligne du fichier
	 */
	public String reading(String fileName) {
				
		String line=path.getPath()+"\\"+fileName;		
		String lastLine="";
		System.out.println(line);
		
		activity = new File(line);
		
		try {
			BufferedReader doc = new BufferedReader(new FileReader(activity));
			while ((line = doc.readLine()) != null) {
				lastLine = line;
			}
		}
		catch (Exception e){
			e.printStackTrace();
			System.out.println("erreur");
		}
		return lastLine;
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
        
        //cette ligne permet de tester la méthode reading()
        //Il faut que l'utilisateur ait déjà éxécuté le fichier python, et que celui-ci ait créé 
        //les fichiers de données, pour que ce test fonctionne.
        //Pour ce test, les données de CO2 sont récoltées
        System.out.println(this.reading("Blue Gym_CO2_donnees.txt"));
    }
    
    
 
    
}

	

