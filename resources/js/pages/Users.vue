<template>
    <div>
        <app-header></app-header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 mt-3 left_block">
                    <div class="row mt-3">
                        <div class="col-12 avatar text-center">
                            <img src="img/avatar.png" width="150" alt="avatar">
                        </div>
                        <div class="col-12 text-center">
                            <h4><b>{{user.firstname}} {{user.lastname}}</b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row mt-5 d-flex">
                        <select class="form-control w-50 m-auto" name="genre" v-model="genre">
                            <option value="0">Выберите категорию для сортировки</option>
                            <option v-for="item in genres" :value="item.name">{{item.name}}</option>
                        </select>
                        <button class="btn btn-primary btn_add"  @click="modal = true">Добавить книгу</button>
                    </div>

                    <div class="content">
                        <book v-for="book in result" :book="book" @edit="edit=true" @delete="remove"></book>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <app-modal v-if="modal" @close="modal = false" @add="addBook" :genres="genres"></app-modal>
    <edit-book v-if="edit" @close="edit = false" :genres="genres" @edit="editBook"></edit-book>
</template>

<script>
import store from "../store"
import Fuse from 'fuse.js'
import AppHeader from "../Components/AppHeader";
import AppModal from "../components/AppModal";
import EditBook from "../components/EditBook";
import Book from "../components/Book";

export default {
    data() {
        return {
            genres: [],
            genre: 0,
            books: [],
            result: [],
            fuse: null,
            modal: false,
            edit: false,
            user: JSON.parse(store.state.auth.user),
            options : {
                shouldSort: true,
                includeScore: true,
                keys: [
                    "name",
                ]
            }
        }
    },
    methods: {
        async getGenres() {
            const data = await axios.get('/api/genres')
            this.genres.push(...data.data)
        },
       async addBook(data) {
           const books = await axios.post('/api/books/' + this.user.id, data)
           this.result = books.data.books
           this.modal = false
        },
        async editBook(data) {
            const books = await axios.patch('/api/book/' + data.id, data)
            this.result = books.data.books
            this.$store.dispatch('clearBook')
            this.edit = false
        },
        async getBooks() {
            const data = await axios.get('/api/books/' + this.user.id)
            this.books.push(...data.data)
        },
        remove(id) {
            this.result = this.result.filter(item => item.id !== id)
            console.log(this.result)
        }
    },
    mounted() {
        this.getGenres()
        this.getBooks()
        this.result = this.books
        console.log(this.$store.state.editBook)
    },
    watch: {
        genre() {
            this.fuse = new Fuse(this.books, this.options)
            if (this.genre === '0') {
                this.result = this.books
            } else {
                this.result = this.fuse.search(this.genre).map(result => result.item)
            }
        }
    },
    components: {EditBook, AppHeader, AppModal, Book}
}
</script>

<style scoped>
.avatar {
    height: 200px;
}

.left_block {
    height: 86vh;
    border-right: 1px solid #0a427d;
}

.btn_add {
    padding: 10px;
    width: 150px;
    margin-right: 10px;
}

select {
    height: 45px;
}

.content {
    display: flex;
    justify-content: left;
    flex-wrap: wrap;
}

.book__box {
    width: 250px;
    height: 300px;
    font-size: 18px;
    background-color: #1eb49e;
    color: #fff;
}

</style>
