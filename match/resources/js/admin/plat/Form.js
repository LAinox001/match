import AppForm from '../app-components/Form/AppForm';

Vue.component('plat-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});