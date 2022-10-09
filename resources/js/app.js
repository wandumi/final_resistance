/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    "bbbee-sort",
    require("./components/Bbbee/bbbeeSort.vue").default
);

Vue.component("price-sort", require("./components/priceSupplements/priceSort.vue").default);

Vue.component("credit-sort", require("./components/creditRatings/creditSort.vue").default);

Vue.component("program-sort", require("./components/programDocuments/programSort.vue").default);

Vue.component("policy-sort", require("./components/policies/policySort.vue").default);

Vue.component("circular-sort", require("./components/circulars/circularSort.vue").default);

Vue.component("upload-logos", require("./components/logos/uploadLogos.vue").default);

Vue.component("shareholder-sort", require("./components/shareholder/shareholderSort.vue").default);

Vue.component("schedules-sort", require("./components/schedules/schedules-sort.vue").default);

Vue.component('property-sort', require('./components/properties/properties-sort.vue').default)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});