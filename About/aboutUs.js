$(document).ready(() => {
    //if user is loged in display his username in the nav bar
    $('#username').load('../username/username.php');
})

// ------------------if the user is loged in
Vue.component('logout',{
    template : `
    <div style="display: flex;align-items: center; margin: 1rem;color: #fff;" id="logOut">
        <i class="fas fa-sign-in-alt"></i>
        <h5 style="margin-left: 0.5rem;cursor: pointer;">Log Out</h5>
    </div>`,
})
Vue.component('useregistered',{
    template: `<h5 id="username" v-on:click="goToDashboard" style="margin-left: 0.5rem;cursor: pointer; color:#fff;"></h5>`,
    
    methods: {
        goToDashboard(){
            window.location.href = '../DashBoard/dashboard.php';
        }
    }
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
                    <h5 v-on:click="goToRegistration" style="margin-left: 0.5rem;cursor: pointer;">Register</h5>
                </div>`,
    methods: {
        goToRegistration: function(){
            window.location.href = '../SignUp/signup.php';
        },
    }
})


new Vue({
    el: '#vue-app',

    data: {

    },
    methods: {
        goHome(){
            window.location.href = '../Main/main.php';
        },
        goToRegistration(){
            window.location.href = '../SignUp/signup.php';
        },
        goToFeaturedListings(){
            window.location.href = '../allListings/featured.php';
        }
    }

})

