import AppForm from '../app-components/Form/AppForm';

Vue.component('etudiant-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nom:  '' ,
                prenom:  '' ,
                filliere_id:  '' ,
                plat_id:  '' ,
                couleur_id:  '' ,
                animal_id:  '' ,
                
            }
        }
    }

});