<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'filliere' => [
        'title' => 'Fillieres',

        'actions' => [
            'index' => 'Fillieres',
            'create' => 'New Filliere',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'plat' => [
        'title' => 'Plats',

        'actions' => [
            'index' => 'Plats',
            'create' => 'New Plat',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'couleur' => [
        'title' => 'Couleurs',

        'actions' => [
            'index' => 'Couleurs',
            'create' => 'New Couleur',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'animal' => [
        'title' => 'Animals',

        'actions' => [
            'index' => 'Animals',
            'create' => 'New Animal',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'etudiant' => [
        'title' => 'Etudiants',

        'actions' => [
            'index' => 'Etudiants',
            'create' => 'New Etudiant',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'filliere_id' => 'Filliere',
            'plat_id' => 'Plat',
            'couleur_id' => 'Couleur',
            'animal_id' => 'Animal',
            
        ],
    ],

    'post' => [
        'title' => 'Posts',

        'actions' => [
            'index' => 'Posts',
            'create' => 'New Post',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'parrain' => [
        'title' => 'Parrains',

        'actions' => [
            'index' => 'Parrains',
            'create' => 'New Parrain',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'filliere_id' => 'Filliere',
            'plat_id' => 'Plat',
            'couleur_id' => 'Couleur',
            'animal_id' => 'Animal',
            'match' => 'Match',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];