/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import './styles/app.css';
import './bootstrap';
import Vue from 'vue'
import axios from 'axios';
import App from './js/components/App';

Vue.prototype.$http = axios;

new Vue({
    el: '#app',
    components: {
        App
    }
});
