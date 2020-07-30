import AppForm from '../app-components/Form/AppForm';

Vue.component('filliere-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});