    </main>
<footer>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <!-- compteur de vues (ici marche parce qu'on est le seul visiteur)
                sur un site "normal", on fera pas comme ça -->
            <?php

            /*  1ère méthode pour le compteur
                require_once 'functions' . DIRECTORY_SEPARATOR . 'compteur.php';
                ajouter_vue();
                $vues = nombre_vues(); */
            
            // 2ème méthode pour le compteur
            require_once 'class' . DIRECTORY_SEPARATOR . 'Compteur.php';
            $compteur = new Compteur('data' . DIRECTORY_SEPARATOR . 'compteur');
            // require_once 'class' . DIRECTORY_SEPARATOR . 'DoubleCompteur.php';
            // $compteur = new DoubleCompteur('data' . DIRECTORY_SEPARATOR . 'compteur');
            $compteur->incrementer();
            $vues = $compteur->recuperer();
            ?>

            <!-- 1ère méthode pour le compteur
            Il y a (php) nombre_vues() (php) visite (php) if ($vues > 1):(php)s(php) endif (php) sur le site. -->

            <!-- 2ème méthode pour le compteur -->
            Il y a <?= $vues ?> visite<?php if ($vues > 1):?>s<?php endif ?> sur le site.
        </div>
        <div class="col-md-4">
            <!-- On inclut le formulaire pour s'inscrire à la newsletter -->
            <form action="newsletter.php" method="POST" class="form-inline">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Entrez votre email" required class="form-control" value="<?= htmlentities($email) ?>">
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
        <div class="col-md-4">
            <h5>Navigation</h5>
            <ul class="list-unstyled text-small">
                <!-- On affiche le menu avec la fonction nav_menu -->
                <?= nav_menu('') ?>
            </ul>
        </div>
    </div>
</footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>