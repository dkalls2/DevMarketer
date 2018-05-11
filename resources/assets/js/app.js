
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
    //We can't use buefy components straight away because buefy components are vue components and vue components can only be used inside of a vue object. 
    //First we have to create a vue object adn then use those vue components inside of a vue object.  Here is what we need to do:


// var app = new Vue({
//     //this is just creating a general vue app
//     el: '#app',
//         //we are setting this to an element and an element that is really good to set it equal to is this app id.
//         //we want to instantiate this whole app div as a vue object.  Now that it is, everything inside of this id of app is going to be a vue object.
//         //all div's are now a vue object in the app.blade.php file.
//         //we can now put vue components inside the navigation or anywhere else in app.blade.php and they will work because we set up the view object.
//     data:{
//         auto_password: true,
//         password_options: "keep"
//     }
//         //this is just empty data because we don't have a real vue project yet.
// })
    

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
