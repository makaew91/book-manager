<template>
    <div class="login-page">
        <div class="form">
            <form @submit.prevent="onSubmit">
                <h4>Login</h4>
                <div :class="['form-control', {invalid: eError}]">
                    <label for="email">Email</label>
                    <input type="text" id="email" v-model="email" @blur="eBlur">
                    <small v-if="eError">{{ eError }}</small>
                </div>

                <div :class="['form-control', {invalid: pError}]">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" v-model="password" @blur="pBlur" data-toggle="password">
                    <small v-if="pError">{{ pError }}</small>
                </div>

                <button class="btn primary" type="submit" :disabled="isSubmitting">Войти</button>
            </form>
        </div>
        <div class="form-message">
            <p class="message">Нет аккаунта? <a href="#">НАПИШИТЕ НАМ</a></p>
        </div>
    </div>
</template>

<script>
// import {useRoute} from 'vue-router'
// import {useStore} from 'vuex'
// import {error} from '../utils/error'
import {useLoginForm} from '../use/login-form'

export default {
    setup() {
        // const route = useRoute()
        // const store = useStore()

        // if (route.query.message) {
        //     store.dispatch('setMessage', {
        //         value: error(route.query.message),
        //         type: 'warning'
        //     })
        // }
        return {...useLoginForm()}
    }
}
</script>

<style scoped>

label {
    float: left;
}

.form-control.invalid input {
    border-color: #e53935!important;
}

.form-control small {
    color: #e53935;
}

.btn:disabled {
    cursor: not-allowed;
    opacity: 1!important;
    background: #4f88c4 !important;
    border-color: #ddd!important;
    color: #999!important;
}

.login-page {
    width: 425px;
    padding: 8% 0 0;
    margin: auto;
}

.form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 425px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

.form-message {
    margin-top: 16px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
    background: #FFFFFF;
    max-width: 425px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

.form-control input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    border-radius: 5px;
    font-size: 14px;
}

.form button {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #376DA6;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    cursor: pointer;
    border-radius: 5px;
}

.form button:hover,.form button:active,.form button:focus {
    background: #0a427d;
    border-radius: 5px;
}

.form .message a {
    color: #376DA6;
    text-decoration: none;
}

.form-control {
    height: auto;
    border: none;
}

</style>
