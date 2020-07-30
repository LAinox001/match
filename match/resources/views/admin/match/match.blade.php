@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Match')

@section('body')

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

@endsection