<template>
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
</template>

<script>
    export default {
        data () {
            return {
                todoItemText: ''
            }
        },
        methods: {
            addTodo () {
                if (this.todoItemText !== '') {
                    this.$emit('addTodo', this.todoItemText);
                    this.todoItemText = '';
                }
            }
        }
    }
</script>