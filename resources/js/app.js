import Vue from 'vue';
import vuetify from './plugins/vuetify';

Vue.component('app',require('./components/App.vue').default);
Vue.component('cliente-page',require('./components/cliente/ClientePage').default);

export default new Vue({
    el:"#app",
    vuetify,
});

