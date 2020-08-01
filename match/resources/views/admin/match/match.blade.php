@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Match')

@section('body')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Liste des matchs
                        <a href="{{ route('admin/match/download') }}" class="btn btn-primary float-right"><i class="fa fa-download"></i> Télécharger en Excel</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Parrain</th>
                                        <th scope="col">Etudiant</th>
                                        <th scope="col">Compte Points Communs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($couples as $key => $couple)
                                        <tr>
                                            <th scope="row">{{ $key }}</th>
                                            <td>{{ $couple['Parrain']->prenom }} {{ $couple['Parrain']->nom }}</td>
                                            <td>{{ $couple['Etudiant']->prenom }} {{ $couple['Etudiant']->nom }}</td>
                                            <td>{{ $couple['Compte Communs'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection