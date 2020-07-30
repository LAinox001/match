import AppForm from '../app-components/Form/AppForm';

Vue.component('match-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                number: '5' ,
            },
        }
    }
});