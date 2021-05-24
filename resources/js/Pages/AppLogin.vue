<template>
    <div class="login-page">
        <form @submit.prevent="auth">
            <div class="form">
                <h4>Login</h4>
                <form class="login-form">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="username" v-model="username"/>
                    <label for="password">Password</label>
                    <input type="password"  id="password" placeholder="password" v-model="pass"/>
                    <button class="btn" :disabled="username.length < 2" type="submit">login</button>
                </form>
            </div>
        </form>
        <div class="form-message">
            <p class="message">Нет аккаунта? <a href="#">НАПИШИТЕ НАМ</a></p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: '',
            pass: ''
        }
    },
    methods: {
        auth(event) {
            alert(this.username)
        },
        isActive() {
          if(this.username.length < 2) {
              return true;
          }
        }
    }
}
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

label {
    float: left;
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

.form input {
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

</style>
