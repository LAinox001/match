<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Parrain;
use App\Models\Etudiant;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Auth\Access\AuthorizationException;

class MatchController extends Controller
{
    public function index(){
        return view('admin.match.index');
    }

    public function match(Request $request){
        dd("hahalol", $request);

        return redirect('/');
        // return view('admin.match.match');
    }

    public function matchup(){
        $etudiants = Etudiant::all();
        $parrains = Parrain::all();

        foreach($parrains as $parrain){
            $parrain->match = 0;
            $parrain->save();
        }

        $couples = $this->matchTogether($etudiants, $parrains);
        // dd($couples);
        return view('admin.match.match')->with(['couples' => $couples]);

        // $couples = [];
        // $count_couples = 0;

        // foreach($etudiants as $etudiant){
        //     $best_parrain = [
        //         'Prénom' => null,
        //         'Nom' => null,
        //         'count_same' => 0
        //     ];
        //     $count_same = 0;
        //     $attributes_etudiant = $etudiant->getAttributes();
        //     unset($attributes_etudiant['id']);
        //     unset($attributes_etudiant['created_at']);
        //     unset($attributes_etudiant['updated_at']);
        //     unset($attributes_etudiant['prenom']);
        //     unset($attributes_etudiant['nom']);


        //     foreach($parrains as $parrain){
        //         $count_same = 0;
        //         $attributes_parrain = $parrain->getAttributes();
        //         unset($attributes_parrain['id']);
        //         unset($attributes_parrain['created_at']);
        //         unset($attributes_parrain['updated_at']);
        //         unset($attributes_parrain['prenom']);
        //         unset($attributes_parrain['nom']);


        //         foreach($attributes_etudiant as $keyEtA => $etudiantAttributs){
        //             foreach($attributes_parrain as $keyPaA => $parrainAttributs){
        //                 if($keyEtA == $keyPaA){
        //                     if($etudiantAttributs == $parrainAttributs){
        //                         $count_same += 1;
        //                     }
        //                 }
        //             }
        //         }


        //         if($count_same > $best_parrain['count_same']){
        //             $best_parrain = [
        //                 'Prénom' => $parrain->prenom,
        //                 'Nom' => $parrain->nom,
        //                 'count_same' => $count_same
        //             ];
        //         }
        //     }

        //     // On vérifie si le parrain de l'étudiant en question n'est pas déjà mis autre part 
        //     // et s'il est meilleur ou non
        //     foreach($couples as $key => $couple){
        //         if(($couple['Prénom Parrain'] == $best_parrain['Prénom']) && ($couple['Nom Parrain'] == $best_parrain['Nom'])){
        //             if($couple['Compte Communs'] < $best_parrain['count_same']){
        //                 $couples[$key]['Prénom Parrain'] = null;
        //                 $couples[$key]['Nom Parrain'] = null;
        //                 $couples[$key]['Compte Communs'] = 0;
        //             }
        //         }
        //     }

        //     $couples += ['couple' . $count_couples => [
        //             'Prénom Etudiant' => $etudiant->prenom,
        //             'Nom Etudiant' => $etudiant->nom,
        //             'Prénom Parrain' => $best_parrain['Prénom'],
        //             'Nom Parrain' => $best_parrain['Nom'],
        //             'Compte Communs' => $best_parrain['count_same']
        //         ]
        //     ];

        //     $count_couples++;
        // }

        // dd($couples);
    }
    

    public function matchTogether($etudiants, $parrains){
        
        $couples = [];
        $count_couples = 0;

        foreach($etudiants as $etudiant){
            // dump("Etudiant " . $etudiant->nom . " Numéro " . $count_couples);
            $best_parrain_and_couples = $this->check_for_parrain($parrains, $etudiant, $couples);

            $best_parrain = $best_parrain_and_couples[0];
            $couples = $best_parrain_and_couples[1];

            // dump($etudiant->nom . " best parrain:", $best_parrain);
            // dump($etudiant->nom . " couples:", $couples);
            
            foreach($couples as $key => $couple){
                if($couple['Parrain'] == null){
                    $couples[$key]['Parrain'] = $best_parrain['Parrain'];
                    $couples[$key]['Compte Communs'] = $best_parrain['count_same'];
                }
            }

            $couples += ['couple' . $count_couples => [
                    'Etudiant' => $etudiant,
                    'Parrain' => $best_parrain['Parrain'],
                    'Compte Communs' => $best_parrain['count_same']
                ]
            ];
            $count_couples++;
        }

        // dump("stop");
        return $couples;
    }


    public function check_for_parrain($parrains, $etudiant, $couples){

        // dump("Check Parrain for " . $etudiant->nom);

        $best_parrain = [
            'Parrain' => null,
            'count_same' => 0
        ];
        $count_same = 0;

        

        foreach($parrains as $parrain){
            $count_same = 0;
            $attributes_parrain = $parrain->getAttributes();
            unset($attributes_parrain['id']);
            unset($attributes_parrain['created_at']);
            unset($attributes_parrain['updated_at']);
            unset($attributes_parrain['prenom']);
            unset($attributes_parrain['nom']);
            unset($attributes_parrain['match']);

            foreach($attributes_parrain as $key => $parrainAttributs){
                if($parrainAttributs == $etudiant[$key]){
                    $count_same += 1;
                }
            }

            if($count_same > $best_parrain['count_same']){
                $best_parrain = [
                    'Parrain' => $parrain,
                    'count_same' => $count_same
                ];
            }
        }

        // dump("Parrain without check found for " . $etudiant->nom);
        // dump("Parrain is " . $best_parrain['Parrain']->nom);

        $matched = $this->check_parrain_already_matched($best_parrain, $couples, $etudiant);

        if($matched == false){
            $best_parrain['Parrain']->match = 1;
            $best_parrain['Parrain']->save();

            $best_parrain_and_couples = [
                $best_parrain,
                $couples
            ];

            // dump("Parrain after check found for " . $etudiant->nom);
            // dump("Parrain is " . $best_parrain['Parrain']->nom);

            return $best_parrain_and_couples;
        }else{
            return $matched;
        }
    }


    public function check_parrain_already_matched($best_parrain, $couples, $etudiant){
        $matched = false;

        foreach($couples as $couple){
            if($couple['Parrain'] == $best_parrain['Parrain']){
                $parrains = Parrain::where("match", 0)->get();
                if($couple['Compte Communs'] < $best_parrain['count_same']){

                    // On set le parrain et le compte du couple précédent à 0
                    foreach($couples as $key => $couple){
                        if($couple['Parrain'] == $best_parrain['Parrain']){
                            $couples[$key]['Parrain'] = null;
                            $couples[$key]['Compte Communs'] = 0;
                            $etudiant_check = $couple['Etudiant'];
                        }
                    }

                    // dump("check_parrain_already_matched");
                    // dump($etudiant->nom . " best parrain:", $best_parrain);
                    // dump($etudiant->nom . " couples:", $couples);

                    // On rentre le nouveau couple dans le tableau
                    $count_couples = count($couples);
                    $couples += ['couple' . $count_couples => [
                            'Etudiant' => $etudiant,
                            'Parrain' => $best_parrain['Parrain'],
                            'Compte Communs' => $best_parrain['count_same']
                        ]
                    ];
                    
                    $matched = $this->check_for_parrain($parrains, $etudiant_check, $couples);
                }else{
                    $best_parrain['count_same'] = 0;
                    $best_parrain['Parrain'] = null;
                    $matched = $this->check_for_parrain($parrains, $etudiant, $couples);
                }
            }
        }
        return $matched;
    }


}