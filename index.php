<?php
session_start();

// Configuration
$token_attendu = "U16T"; // Changez ceci

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?");
    exit;
}

// Vérification du token
if (isset($_POST['token']) && $_POST['token'] === $token_attendu) {
    $_SESSION['auth'] = true;
}

// Si non authentifié : bloque l'affichage
if (!isset($_SESSION['auth'])) {
    header('HTTP/1.0 403 Forbidden');
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Accès Restreint</title></head>
    <body style="font-family: sans-serif; text-align: center; padding-top: 50px;">
        <h2>Contenu Chiffré / Accès Verrouillé</h2>
        <form method="post">
            <input type="password" name="token" placeholder="Entrez votre token" required>
            <button type="submit">Déchiffrer</button>
        </form>
    </body>
    </html>
    <?php
    exit; // Arrête l'exécution du script ici
}

// Le reste de votre site (HTML/Fichiers) ne s'affiche que si le token est bon
?>

<h1>Félicitations, le site est accessible</h1>
<p>Ceci est votre contenu protégé.</p>
<a href="?logout=1">Se déconnecter</a>
