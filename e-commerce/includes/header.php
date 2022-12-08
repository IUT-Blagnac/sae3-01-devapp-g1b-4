<?php
//include('include/connect.inc.php');
session_start();
?>


<nav>
	<div class="logo">
		<a href="index.php"><img src="assets/images/logo.png" width="100px"></a>
	</div>
	<div class="website-title">
		<h1>Blue Gym</h1>
	</div>
	<div class="navigation">
		<div class="search-bar">
			<form method="get" action="recherche.php" name="formSearch">
				<input type="text" name="rechercheUser" placeholder="Rechercher" class="search-input">
				<button type="submit" class="search-button">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
					</svg>
				</button>
			</form>
		</div>
		<div class="navbar-links">
			<ul>
				<li><a href="panier.php">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
							<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
					</a></li>
				<li><a href="compte.php">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
							<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
						</svg>
					</a></li>
				<li><a href="">Langue</a></li>
			</ul>
		</div>
	</div>
</nav>

<nav class="categorie-header">
	<div class="categorie-navigation-links">
		<ul id="test">
			<li><a id="categorie-link" catID="1">
					A la une
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg>
				</a></li>
			<li><a id="categorie-link" catID="2">
					Barres de traction
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg>
				</a></li>
			<li><a id="categorie-link" catID="3">
					Poulie
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
			<li><a id="categorie-link" catID="4">
					Barres
					<svg xmlns="http://www.w3.org/2000/svg" wisdth="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
			<li><a id="categorie-link" catID="5">
					Poids
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
			<li><a id="categorie-link" catID="6">
					Accessoires
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
			<li><a id="categorie-link" catID="7">
					Machines
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
			<li><a id="categorie-link" catID="8">
					<span class="text-danger fw-bold">Promotions</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
						<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
					</svg></a></li>
		</ul>
	</div>

	<div class="navigation-dropdown" dropdownID="1">
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
					<li><a href="" class="link link-seemore">Voir plus</a></li>
				</ul>
			</div>
		</div>
		<div class="dropdown-image-section">
			<img src="https://contents.mediadecathlon.com/p2097129/k$c130138d84f6488e09328728825735a5/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="Barre de traction fixation murale" class="dropdown-image">
		</div>
	</div>

	<div class="navigation-dropdown" dropdownID="2">
		<div class="dropdown-content">
			<div class="dropdown-header">
				<h3 class="dropdown-title">
					Barres de traction
				</h3>
				<h5 class="dropdown-subtitle text-muted">
					Sous-titre
				</h5>
			</div>
			<div class="dropdown-links">
				<ul class="page-links">
					<li><a href="" class="link">Barres fixation murale</a></li>
					<li><a href="" class="link">Barres fixation porte</a></li>
					<li><a href="" class="link">Barres libre autoporteuse</a></li>
				</ul>
				<ul class="more-action-link">
					<li><a href="" class="link link-seemore">Voir plus</a></li>
				</ul>
			</div>
		</div>
		<div class="dropdown-image-section">
			<img src="https://contents.mediadecathlon.com/p2097129/k$c130138d84f6488e09328728825735a5/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="Barre de traction fixation murale" class="dropdown-image">
		</div>
	</div>

</nav>