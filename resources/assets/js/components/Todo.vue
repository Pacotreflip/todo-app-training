<template>
    <div class="container">
        <todo-input-component v-on:addTodo="addTodo($event)"></todo-input-component>
        <table class="table is-bordered">
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        data () {
            return {
                todoItemText: '',
                items: [],
            }
        },
        mounted () {
            axios.get(window.location.origin + '/api/todos').then(response => {
                this.items = response.data;
            }).catch(e => {
                alert(e);
            })
        },
        methods: {
            addTodo (text) {
                axios.post(window.location.origin + '/api/todos', {
                    text: text,
                    done: false
                }).then(response => {
                    this.items.push(response.data);
                }).catch(e => {
                    alert(e);
                });
            },
            removeTodo (todo) {
                axios.delete(window.location.origin + '/api/todos/' + todo.id).then(response => {
                    this.items = this.items.filter(item => item.id !== todo.id);
                }).catch(e => {
                    alert(e);
                });
            },
            toggleDone (todo) {
                axios.put(window.location.origin + '/api/todos/' + todo.id, {
                    done: !todo.done
                }).then(response => {
                    todo.done = response.data.done;
                }).catch(e => {
                    alert(e);
                });
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
