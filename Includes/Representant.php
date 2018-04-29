<?php

class Representant 
{
  //attributs de la classe

  private $id_Demandeur;
  private $nom_Representant;
  private $prenom_Representant;
  private $rue_Representant;
  private $cp_Representant;
  private $ville_Representant;



   function __construct(array $tableau = null) {
    if (isset($tableau)) {
      $this->hydrater($tableau);
    }
  }


// getters de la classe
   public function get_id_Demandeur() {
    return $this->id_Demandeur;
  }
  public function get_nom_Representant() {
    return $this->nom_Representant;
  }

 public  function get_prenom_Representant() {
    return $this->prenom_Representant;
  }

 public function get_rue_Representant() {
    return $this->rue_Representant;
  }
 public function get_cp_Representant() {
    return $this->cp_Representant;
  }
  public function get_ville_Representant() {
    return $this->ville_Representant;
  }
 

//setters de la classe
function set_id_Demandeur($id_Demandeur) {
    $this->id_Demandeur = $id_Demandeur;
  }

function set_nom_Representant($nom_Representant) {
    $this->nom_Representant = $nom_Representant;
  }

  function set_prenom_Representant($prenom_Representant) {
    $this->prenom_Representant = $prenom_Representant;
  }
 function set_rue_Representant($rue_Representant) {
    $this->rue_Representant = $rue_Representant;
  } 
  function set_cp_Representant($cp_Representant) {
    $this->cp_Representant = $cp_Representant;
  } 
  function set_ville_Representant($ville_Representant) {
    $this->ville_Representant = $ville_Representant;
  }
 
    function hydrater(array $tableau) {
    foreach ($tableau as $cle => $valeur) {
      $methode = 'set_' . $cle;
      if (method_exists($this, $methode)) {
        $this->$methode($valeur);
      }
    }
  }
  



  public function index() {
    // Vérifie si l'utilisateur est connecté
    if (!Auth::est_authentifie()) {
      $this->redirect('utilisateur/login');
    }
    // Lecture de tous les utilisateurs
    $utilisateurDAO = new UtilisateurDAO();
    $utilisateurs = $utilisateurDAO->findAll();
    // Appele la vue 
    $this->show_view('utilisateur/index', array('utilisateurs' => $utilisateurs));
  }

  /**
   * Détails d'un utilisateur
   */
  public function details($id_utilisateur) {
    // Vérifie si l'utilisateur est connecté
    if (!Auth::est_authentifie()) {
      $this->redirect('utilisateur/login');
    }
    // Lecture du utilisateur
    $utilisateurDAO = new UtilisateurDAO();
    $utilisateur = $utilisateurDAO->find($id_utilisateur);
    // Appele la vue 
    $this->show_view('utilisateur/details', array(
        'utilisateur' => $utilisateur
    ));
  }

  /**
   * Inscrit un utilisateur
   */
  public function register() {
    // Formulaire saisi ?
    if ($this->request->exists("submit")) {
      // le formulaire est soumis
      $utilisateur = new Utilisateur(array(
          'login' => $this->request->get('login'),
          'password' => $this->request->get('password'),
          
      ));
      if (Auth::inscrire($utilisateur)) {
        Flash::add("Vous êtes inscrit !", 1);
      } else {
        Flash::add("Une erreur est survenue lors de l'inscription, veuillez réessayer SVP", 3);
      }
    } else {
      // Le formulaire n'a pas été soumis
      $utilisateur = new Utilisateur();
    }

    // Appele la vue 
    $this->show_view('utilisateur/register', array(
        'utilisateur' => $utilisateur,
        'action' => 'utilisateur/register'
    ));
  }

  /**
   * Connecte un utilisateur
   */
  public function login() {
    // Formulaire saisi ?
    if ($this->request->exists("submit")) {
      // le formulaire est soumis
      $utilisateur = new Utilisateur(array(
          'login' => $this->request->get('login'),
          'password' => $this->request->get('password')
              )
      );
      if (Auth::connecter($utilisateur)) {
        Flash::add("Vous êtes connecté !");
      } else {
        Flash::add("Erreur, veuillez réessayer SVP", 3);
      }
    } else {
      // Le formulaire n'a pas été soumis
      $utilisateur = new Utilisateur();
    }
    // Appele la vue 
    $this->show_view('utilisateur/login', array(
        'utilisateur' => $utilisateur,
        'action' => 'utilisateur/login'
    ));
  }

  /**
   * Connecte un utilisateur
   */
  public function logout() {
    if (Auth::deconnecter()) {
      // TODO : à cette instant, il n'y a plus de session donc ce message ne s'affichera jamais
      Flash::add("Vous êtes déconnecté !");
    } else {
      Flash::add("Erreur, impossible de vous déconnecter", 3);
    }
    // On redirige vers la page d'accueil
    $this->redirect('index');
  }

}


