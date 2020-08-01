<template>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Liste des matchs
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
                                    <tr v-for="couple in couples.data" :key="couple.id">
                                        <th scope="row">{{ couple.id }}</th>
                                        <td>{{ couple.parrain.nom }} {{ couple.parrain.prenom }}</td>
                                        <td>{{ couple.etudiant.nom }} {{ couple.etudiant.prenom }}</td>
                                        <td>{{ couple.compte_communs }}</td>
                                    </tr>
                            </tbody>
                            <pagination :data="couples" @pagination-change-page="getResults"></pagination>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                // Our data object that holds the Laravel paginator data
                couples: {},
            }
        },

        mounted() {
            // Fetch initial results
            this.getResults();
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://match.test/admin/match/matchup?page=' + page)
                    .then(response => {
                        this.couples = response.data;
                    });
            }
        }

    }
</script>