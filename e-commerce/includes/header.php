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
			<ul class="navbar-link-list">

				<li>
					<a href="panier.php">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
							<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
					</a>

				</li>
				<li>
					<div>
						<div class="dropdown">
							<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
									<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
								</svg>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">Connexion</a></li>
								<li><a class="dropdown-item text-primary fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#register-modal"> Inscription</a></li>
							</ul>
						</div>
					</div>
				</li>
				<li><a href="">Langue</a></li>
			</ul>
		</div>
	</div>
</nav>

<?php include('includes/catHeader.php'); ?>

<!-- Modals de connexion/inscription -->
<div class="modal" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<p class="text-muted">Si vous possédez déjà un compte sur notre site vous pouvez vous connecter avec vos identifiants. </p>

				<form action="">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Adresse mail</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label"> Mot de passe</label>
						<input type="password" class="form-control" id="exampleInputPassword1">
					</div>

					<div class="row d-flex justify-content-center">
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-primary btn-lg">
								Connexion
							</button>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-12 text-center">
							<p>Vous n'avez pas de compte ?</p>
							<a data-bs-toggle="modal" data-bs-target="#register-modal" class="text-info text-decoration-underline"> Inscrivez-vous</a>
						</div>
					</div>
				</form>

				<div class="row d-flex justify-content-center">
					<img src="./assets/images/logo.png" alt="" style="width: 50%;">
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Modal d'inscription -->
<div class="modal" id="register-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<p class="text-muted">Vous n'avez pas de compte ? Inscrivez-vous pour accéder à vos commandes, favoris et bien 
					d'autres fonctionnalités. </p>

				<form action="">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Prénom</label>
						<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Nom</label>
						<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Adresse mail</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label"> Mot de passe</label>
						<input type="password" class="form-control" id="exampleInputPassword1">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Confirmez le mot de passe</label>
						<input type="password" class="form-control" id="exampleInputPassword1">
					</div>

					<div class="row d-flex justify-content-center">
						<small class="text-muted mb-2">Tous les champs sont obligatoires</small>
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-primary btn-lg">
								Inscription
							</button>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-12 text-center">
							<p>Vous avez déjà un compte ?</p>
							<a data-bs-toggle="modal" data-bs-target="#login-modal" class="text-info text-decoration-underline"> Connectez-vous</a>
						</div>
					</div>
				</form>

				<div class="row d-flex justify-content-center">
					<img src="./assets/images/logo.png" alt="" style="width: 50%;">
				</div>


			</div>
		</div>
	</div>
</div>



</nav>