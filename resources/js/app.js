

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('tipotelefono', require('./components/tipotelefono.vue').default);
Vue.component('personacomponente', require('./components/personacomponente.vue').default);


const app = new Vue({
    el: '#app',
    data:{
        menu : 0
    }
});
