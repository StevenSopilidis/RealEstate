
// ------------------if the user is loged in
Vue.component('logout',{
    template : `
    <div style="display: flex;align-items: center; margin: 1rem;color: #fff;" id="logOut">
        <i class="fas fa-sign-in-alt"></i>
        <h5 style="margin-left: 0.5rem;cursor: pointer;">Log Out</h5>
    </div>`,
})
Vue.component('useregistered',{
    template: `<h5 style="margin-left: 0.5rem;cursor: pointer; color:#fff;">Steven</h5>`
})

/// ------------------------ if the user isnt loged in
Vue.component('login',{
    template : `
    <div style="display: flex;align-items: center; margin: 1rem;color: #fff;" id="logOut">
        <i class="fas fa-sign-in-alt"></i>
        <h5 v-on:click="goToLoginPage" style="margin-left: 0.5rem;cursor: pointer;">Log In</h5>
    </div>`,

    methods: {
        goToLoginPage: function(){
            window.location.href = '../Login/login.php';
        },
    }
})
Vue.component('register',{
    template : `<div style="display: flex; align-items: center;" id="register">
                    <i class="fas fa-user-plus"></i>
                    <h5 v-on:click="goToRegistration" style="margin-left: 0.5rem;cursor: pointer;" >Register</h5>
                </div>`,
    methods: {
        goToRegistration: function(){
            window.location.href = '../SignUp/signup.php';
        },
    }
})

////////////////////templates that display proper messanges in the login.php
Vue.component('signedup', {//when user signs up display a messsage that tells him he is succesfully signed up
    template: '<div v-if="show" v-html="message" id=message class="alert alert-success"></div>',

    data: function(){
        return {
            message: `<strong>Signed Up</strong> Successfully`,
            show: true
        }
    },


})
Vue.component('invalidpassword', {//if the user inputed an invalid password
    template: '<div v-if="show" v-html="message" id=message class="alert alert-danger"></div>',

    data: function(){
        return {
            message: `<strong>Invalid</strong> Passoword`,
            show: true
        }
    },
})
Vue.component('invalidemail',{//if user inputed an invalid email
    template: '<div v-if="show" v-html="message" id=message class="alert alert-danger"></div>',

    data: function(){
        return {
            message: `<strong>Invalid</strong> Email`,
            show: true
        }
    },
})

new Vue({
    el: '#vue-app',
    data: {
        email: '',
        password: '',
        email_message: 'Cant be empty',
        password_message: 'Cant be empty',
        invalid_email: false,
        invalid_password: false,
    },
    methods: {
        goToRegistration: function(){
            window.location.href = '../SignUp/signup.php';
        },
        goHome : function(){
            window.location.href = '../Main/main.php';
        },
        // go to featured listings
        goToListings: function(){
            window.location.href = '../allListings/featured.php';
        },
        loginUser: function(){
            if(this.email.length <= 0){
                this.invalid_email = true;
            }
            if(this.password.length <= 0){
                this.invalid_password = true;
            }
            window.setTimeout(()=>{
                this.invalid_password = false;
            },2000);
            window.setTimeout(()=>{
                this.invalid_email = false;
            },2000);

            if(this.email.length > 0 && this.password.length > 0){
                document.getElementById('loginForm').submit();
            }
        }
    }
})