<template>
    <div class="modal-backdrop " @click="$emit('close')"></div>
    <div class="modal d-block" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Введите данные книги</h4>
                    <button type="button" class="close" @click="$emit('close')" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent>
                        <div v-if="errors.length">
                            <b>Пожалуйста исправьте указанные ошибки:</b>
                            <ul>
                                <li class="alert-danger" v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Название книги</label>
                            <input type="text" v-model="form.name" class="form-control" id="name">

                            <label for="author" class="col-form-label">Автор</label>
                            <input type="text" v-model="form.author" class="form-control" id="author">
                        </div>
                        <div class="form-group">
                            <label for="select-slug" class="col-form-label">Жанр</label>
                            <select class="form-control" name="select-slug" id="select-slug" v-model="form.genre">
                                <option v-for="item in genres" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                        <label class="col-form-label">Год издания</label>
                        <select class="form-control" name="select-slug" v-model="form.date">
                            <option v-for="year in years" :value="year">{{year}}</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close')" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" @click="checkForm">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits:['close', 'add'],
    props: ['genres'],
    data() {
        return {
            errors: [],
            form: {
                name: '',
                author: '',
                genre: 0,
                date: 1990
            }
        }
    },
    methods: {
        addBook() {
            this.$emit('add', this.form)
        },
        checkForm(e) {
            e.preventDefault();
            if (this.form.name && this.form.author && (this.form.genre !== 0)) {
                this.addBook()
            }

            this.errors = [];

            if (!this.form.name) {
                this.errors.push('Требуется указать название.');
            }
            if (!this.form.author) {
                this.errors.push('Требуется указать автора.');
            }
            if (this.form.genre === 0) {
                this.errors.push('Требуется указать жанр.');
            }

        }
    },
    computed : {
        years () {
            const year = new Date().getFullYear()
            return Array.from({length: year - 1900}, (value, index) => 1901 + index)
        }
    }
}
</script>

<style scoped>
.modal {
    width:650px;
    left: 30%;
}

.modal-backdrop {
    opacity: 0.5;
}

.btn {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #376DA6;
    width: 100%;
    border: 0;
    padding: 8px;
    color: #FFFFFF;
    font-size: 14px;
    cursor: pointer;
    border-radius: 5px;
}
</style>
