<!-- Menu de catégories -->
<nav class="categorie-header">
	<div class="categorie-navigation-links">
		<ul id="test">
			<li><a id="categorie-link" catID="0">
					A la une
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg>
				</a></li>
			<?php
			require_once("connect.inc.php");
			$req1 = "SELECT * FROM Categorie WHERE IDCATEGORIEMERE IS NULL ORDER BY IDCATEGORIE";
			$lesCategories = oci_parse($connect, $req1);
			$result1 = oci_execute($lesCategories);
			while (($laCategorie = oci_fetch_assoc($lesCategories)) != false) {
				echo '<li><a id="categorie-link" catID="' . $laCategorie["IDCATEGORIE"] . '">' . $laCategorie["NOMCAT"] . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
							<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
						</svg>
						</a></li>';
			}
			echo '<li><a id="categorie-link" catID="' . oci_num_rows($lesCategories) . '">
					<span class="text-danger fw-bold">Promotions</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>';
			echo '</ul>
	</div>';
			$req2 = "SELECT * FROM Categorie WHERE IDCATEGORIEMERE = :pIdCM ORDER BY IDCATEGORIE";
			$sousCat = oci_parse($connect, $req2);
			$result1 = oci_execute($lesCategories);
			while (($laCategorie = oci_fetch_assoc($lesCategories)) != false) {
				echo '<div class="navigation-dropdown" dropdownID="' . $laCategorie["IDCATEGORIE"] . '">
						<div class="dropdown-content">
							<div class="dropdown-header">
								<h3 class="dropdown-title">
									' . $laCategorie["NOMCAT"] . '
								</h3>
								
							</div>
							<div class="dropdown-links">
								<ul class="page-links">';
				oci_bind_by_name($sousCat, ":pIdCM", $laCategorie["IDCATEGORIE"]);
				$result2 = oci_execute($sousCat);
				while (($laSousCat = oci_fetch_assoc($sousCat)) != false) {
					echo '<li><a href="./search.php?getIDCat='. $laSousCat['IDCATEGORIE'] .'" class="link">' . $laSousCat['NOMCAT'] . '</a></li>';
				}
				echo '</ul>
						<ul class="more-action-link">
						<li><a href="./search.php?getIDCat='. $laCategorie["IDCATEGORIE"]. '" class="link link-seemore">Tout voir</a></li>
						</ul>
						</div>
						</div>
						
					</div>';
			}
			oci_free_statement($lesCategories);
			oci_free_statement($sousCat);
			?>

			<div class="navigation-dropdown" dropdownID="0">
				<div class="dropdown-content">
					<div class="dropdown-header">
						<h3 class="dropdown-title">
							A la une
						</h3>
						<h5 class="dropdown-subtitle text-muted">
							Vos produits à la une
						</h5>
					</div>
					<div class="dropdown-links">
						<ul class="page-links">
							<li><a href="" class="link">Barres fixation murale</a></li>
							<li><a href="" class="link">Barres fixation porte</a></li>
							<li><a href="" class="link">Barres libre autoporteuse</a></li>
						</ul>
						<ul class="more-action-link">
							<li><a href="" class="link link-seemore">Tout voir</a></li>
						</ul>
					</div>
				</div>
				<div class="dropdown-image-section">
					<img src="https://contents.mediadecathlon.com/p2097129/k$c130138d84f6488e09328728825735a5/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="Barre de traction fixation murale" class="dropdown-image">
				</div>
			</div>