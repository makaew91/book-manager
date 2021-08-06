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
                            <input type="text" v-model="book.title" class="form-control" id="name">

                            <label for="author" class="col-form-label">Автор</label>
                            <input type="text" v-model="book.author" class="form-control" id="author">
                        </div>
                        <div class="form-group">
                            <label for="select-slug" class="col-form-label">Жанр</label>
                            <select class="form-control" name="select-slug" id="select-slug" v-model="book.genre_id">
                                <option v-for="item in genres" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                        <label class="col-form-label">Год издания</label>
                        <select class="form-control" name="select-slug" v-model="book.date">
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
import { mapGetters } from "vuex";
export default {
    emits:['close', 'edit'],
    props: ['genres'],
    data() {
        return {
            errors: [],
            book: this.$store.state.editBook[0]
        }
    },
    methods: {
        editBook() {
            this.$emit('edit', this.book)
        },
        checkForm(e) {
            e.preventDefault();
            if (this.book.title && this.book.author && (this.book.genre_id !== 0)) {
                this.editBook()
            }

            this.errors = [];

            if (!this.book.title) {
                this.errors.push('Требуется указать название.');
            }
            if (!this.book.author) {
                this.errors.push('Требуется указать автора.');
            }
            if (this.book.genre === 0) {
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
