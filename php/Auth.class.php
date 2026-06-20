<?php
/**
 * Classe Auth — centralise l'authentification de l'administrateur.
 *
 * Apporte deux choses par rapport au code précédent :
 * 1. Démonstration de la POO (classe, méthodes statiques, encapsulation)
 * 2. Sécurité renforcée : le mot de passe n'est plus comparé en clair dans
 *    le code, mais vérifié via un hachage bcrypt (password_hash / password_verify)
 */
class Auth {

  // Identifiant admin
  private static $loginAdmin = 'admin';

  // Hachage bcrypt du mot de passe (équivalent à '1234', mais illisible directement)
  // Généré avec : password_hash('1234', PASSWORD_BCRYPT)
  private static $hashMotDePasse = '$2b$10$CTqh/haPTxsQ8eO7t4HZKOhPOLD8SO5T7YDFCAXcqYA.0t9lSrWEC';

  /**
   * Vérifie les identifiants fournis par le formulaire de connexion.
   */
  public static function verifierIdentifiants($login, $motDePasse) {
    return $login === self::$loginAdmin && password_verify($motDePasse, self::$hashMotDePasse);
  }

  /**
   * Ouvre la session admin après une connexion réussie.
   */
  public static function connecter($login) {
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    $_SESSION['login'] = $login;
    $_SESSION['heure'] = date('H:i');
  }

  /**
   * Indique si un administrateur est actuellement connecté.
   */
  public static function estConnecte() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
  }

  /**
   * Ferme la session en cours.
   */
  public static function deconnecter() {
    session_unset();
    session_destroy();
  }
}
