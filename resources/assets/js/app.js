
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('todo-component', require('./components/Todo.vue'));
Vue.component('todo-item-component', require('./components/TodoItem.vue'));
Vue.component('todo-input-component', require('./components/TodoInput.vue'));

const todosStore = new Vuex.Store({
    state: {
        items: []
    },
    mutations: {
        FETCH(state, todos) {
            state.items = todos;
        }
    },
    actions: {
        fetch({commit}) {
            return axios.get(window.location.origin + '/api/todos')
                .then(response => commit('FETCH', response.data))
                .catch(e => {
                    alert(e);
                })
        },
        addTodo({}, todo) {
            axios.post(window.location.origin + '/api/todos', {
                text: todo.text,
                done: false
            }).then(response => {
                this.state.items.push(response.data);
            }).catch(e => {
                alert(e);
            });
        },
        removeTodo({}, id) {
            axios.delete(window.location.origin + '/api/todos/' + id).then(response => {
                this.state.items = this.state.items.filter(item => item.id !== id);
            }).catch(e => {
                alert(e);
            });
        }
    }
});


const app = new Vue({
    el: '#app',
    store: todosStore
});
