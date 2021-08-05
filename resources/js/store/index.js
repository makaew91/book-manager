import {createStore, createLogger} from 'vuex'
import auth from './modules/auth.module'

const plugins = []

if (process.env.NODE_ENV === 'development') {
    plugins.push(createLogger())
}

export default createStore({
    plugins,
    state() {
        return {
            message: null,
            sidebar: false,
            editBook: null
        }
    },
    mutations: {
        setMessage(state, message) {
            state.message = message
        },
        setEditBook(state, book) {
            state.editBook = book
        },
        clearMessage(state) {
            state.message = null
        },
        clearBook(state) {
           state.editBook = null
        },
        openSidebar(state) {
            state.sidebar = true
        },
        closeSidebar(state) {
            state.sidebar = false
        }
    },
    actions: {
        setMessage({commit}, message) {
            commit('setMessage', message)
            setTimeout(() => {
                commit('clearMessage')
            }, 5000)
        },
        setBook({commit}, book) {
            commit('setEditBook', book)
        },
        clearBook({commit}) {
            commit('clearBook')
        }
    },
    getters: {
        getEditBook(state) {
            return state.editBook
        }
    },
    modules: {
        auth
    }
})
