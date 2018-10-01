<?php

// Renvoie la liste des cours de cuisine
function getLesCours() {
    $bdd = getBdd();
    $lescours = $bdd->query('select * from cours');
    return $lescours;
}

// Renvoie les informations sur un cours et le chef qui l'assure
function getCours($numCours) {
    $bdd = getBdd();
    $cours = $bdd->prepare('select numcours,libellecours, dureecours,
    nomchef, prenomchef from cours JOIN chef on numchef = numchefcours where numcours = ?');
    $cours->execute(array($numCours));
    if ($cours->rowCount() == 1)
        return $cours->fetch();  // Accès à la première ligne de résultat
    else
        throw new Exception("Aucun cours ne correspond à l'identifiant '$idBillet'");
}

// Renvoie la liste des sessions associées à un cours
function getSessions($numCours) {
    $bdd = getBdd();
    $sessions = $bdd->prepare('select * from session where numcourssession = ?' ;
    $sessions->execute(array($numCours));
    return $sessions;
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd() {
    $bdd = new PDO('mysql:host=localhost;dbname=club-cuisine;charset=utf8', 'ts2',
            'ts2', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}
