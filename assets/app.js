/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from "vue";

var app = new Vue({
    el: '#app',
    data: {
        status: false,
        allCategories: '',
        getOneCategory: '',
        addOneCategory: '',
        inputCatGet: '',
        inputCatAdd: '',
        inputCatPutId: '',
        inputCatPutName: '',
        putOneCategory: '',
        inputCatRemove: '',
        removeOneCategory: ''
    },
    methods: {
        getAllCategories: function () {
            fetch('api/categories/', {
                method: "GET",
            })
                .then(response => response.json())
                .then(data => this.allCategories = data.data)
        },
        getCategory: function () {
            fetch('api/category/' + this.inputCatGet + '/', {
                method: "GET",
            })
                .then(response => response.json())
                .then(data => this.getOneCategory = data.name)
        },
        addCategory: function () {
            this.status = false
            fetch('api/category/', {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name: this.inputCatAdd })
            })
                .then(response => response.json())
                .then(data => (this.addOneCategory = data.id))
        },
        putCategory: function () {
            this.status = false
            fetch('api/category/', {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: this.inputCatPutId, name: this.inputCatPutName })
            })
                .then(response => response.json())
                .then(data => (this.putOneCategory = data.name))
        },
        removeCategory: function () {
            this.status = false
            fetch('api/category/' + this.inputCatRemove + '/', {
                method: "DELETE",
            })
                .then(response => response.json())
                .then(data => (this.removeOneCategory = data.name))
        }
    }
});