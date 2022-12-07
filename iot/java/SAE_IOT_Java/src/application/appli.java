package application;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

public class appli extends Application {

	private Stage primaryStage;
	
	
	@Override
	public void start(Stage primaryStage) throws Exception {
		this.primaryStage=primaryStage;
		primaryStage.setResizable(false);


		FXMLLoader loader= new FXMLLoader();

		loader.setLocation(appli.class.getResource("../view/window.fxml"));
				
		BorderPane borderpane=loader.load();
		
		Scene sceneM=new Scene(borderpane);
		
		primaryStage.setScene(sceneM);
		primaryStage.setTitle("Visionnage des données");
		primaryStage.show();
		
	}
	
	public static void main(String[] args) {
		launch(args);
	}
}
