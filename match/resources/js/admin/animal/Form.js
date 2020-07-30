import AppForm from '../app-components/Form/AppForm';

Vue.component('animal-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});