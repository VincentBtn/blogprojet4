<?php

class UserManager extends Manager {

    public const ROLE_ADMIN = 'admin';
    
    // Ajouter un utilisateur à la base de données
    public function create(string $pseudo, string $password, string $email, string $role = "user"): void
    {
        $req = $this->db->prepare('INSERT INTO users (pseudo, password, email, role) VALUES (?, ?, ?, ?)');
        $req->execute([$pseudo, $password, $email, $role]);
    }

    // Vérifie si le pseudo existe en base (fonction connexion)
    public function getByPseudo(string $pseudo): ?array
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            $user = null;
        }

        return $user;
    }

}