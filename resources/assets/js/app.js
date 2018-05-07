
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//we need to pull in the vue components.  we do that by:
import Buefy from 'buefy';
Vue.use(Buefy);
    //this pulls all of the buefy components.

//we dont need to worry about pulling in the .css file here because we are going to pull that in in our css file.

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
    //we might set up vue components later, but we do not need this example.  
    //if we were not using all of the compnents for buefy, we could pull them in individually by using the above syntax.







    // const app = new Vue({
    //     el: '#app'
    // });
        //we dot no need a system wide vue set up, we will set this up on each page, so we do not need this.