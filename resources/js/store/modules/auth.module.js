import axios from "axios";
const TOKEN_KEY = 'jwt-token'
import {useRouter} from 'vue-router'
export default {
    namespaced: true,
    state() {
        return {
            token: localStorage.getItem(TOKEN_KEY),
            role: localStorage.getItem('role'),
            user: localStorage.getItem('user')
        }
    },
    mutations: {
        setToken(state, token) {
            state.token = token
            localStorage.setItem(TOKEN_KEY, token)
        },
        setRole(state, role) {
            state.role = role
            localStorage.setItem('role', role)
        },
        setUser(state, user) {
            state.user = user
            localStorage.setItem('user', user)
        },
        logout(state) {
            state.token = null
            state.user = null
            state.role = null
            localStorage.removeItem(TOKEN_KEY)
            localStorage.removeItem('role')
            localStorage.removeItem('user')
        }
    },
    actions: {
        async login({commit}, payload) {
            const router = useRouter()
        const {data} = await axios.post('/api/login', {...payload, returnSecureToken: true})
            if (data.status) {
                commit('setToken', data.token)
                commit('setRole', data.user.slug)
                commit('setUser', JSON.stringify(data.user))
            }
        }
    },
    getters: {
        token(state) {
            return state.token
        },
        isAuthenticated(_, getters) {
            return !!getters.token
        },
        isManager(state) {
            if (state.role === 'manager') {
                return true
            }
            return false
        }
    }
}
