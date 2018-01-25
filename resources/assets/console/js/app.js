import ArticlesHome from './components/articles/Home.vue'
import ArticlesEditor from './components/articles/Editor.vue'

import ToolsMixin from './mixins/tools.js'
import APIMixin from './mixins/api.js'
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.mixin(ToolsMixin);
Vue.mixin(APIMixin);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components');

let rootComponentObjects = [
    ArticlesHome, ArticlesEditor
];
let rootComponents = {};
rootComponentObjects.forEach(component => rootComponents[component.name] = component);

const app = new Vue({
    el: '#app',
    components: rootComponents
});
