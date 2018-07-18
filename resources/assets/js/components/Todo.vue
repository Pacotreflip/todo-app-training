<template>
    <div class="container">
        <todo-input-component v-on:addTodo="addTodo($event)"></todo-input-component>
        <table class="table is-bordered">
            <todo-item-component v-for="(todo, index) in items"
                                 :id="todo.id"
                                 :text="todo.text"
                                 :done="todo.done"
                                 :key="index"
                v-on:removeTodo="removeTodo($event)"
                v-on:toggleDone="toggleDone($event)"
            ></todo-item-component>
        </table>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        data () {
            return { }
        },
        computed: {
            ...mapState(['items'])
        },
        mounted () {
            this.$store.dispatch('fetch');
        },
        methods: {
            addTodo (text) {
                this.$store.dispatch('addTodo', {
                    text: text,
                    done: false
                });
            },
            removeTodo (id) {
                this.$store.dispatch('removeTodo', id);
            },
            toggleDone (todo) {
                this.$store.dispatch('toggleDone', todo);
            }
        }
    }
</script>
