<template>
    <div class="container">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
                </p>
                <p class="control">
                    <a class="button is-info" @click="addTodo">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
        <table class="table is-bordered">
            <tr v-for="(todo, index) in items" :key="index">
                <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }" @click="toggleDone(todo)">
                    {{ todo.text }}
                </td>
                <td class="is-narrow">
                    <a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a>
                </td>
            </tr>
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
            addTodo () {
                let text = this.todoItemText.trim();
                if (text !== '') {
                    axios.post(window.location.origin + '/api/todos', {
                        text: text,
                        done: false
                    }).then(response => {
                        this.items.push(response.data);
                        this.todoItemText = '';
                    }).catch(e => {
                        alert(e);
                    });
                }
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
