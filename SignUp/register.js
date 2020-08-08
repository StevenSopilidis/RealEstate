
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


new Vue({
    el: '#vue-app',

    data: {
        allInputAccepted : false,
        hallo: 'niga',
        validate: 'needs-validation',
        firstName: '',
        lastName: '',
        username: '',
        email: '',
        password: '',

        firstname_class: 'text-danger',
        lastname_class: 'text-danger',
        username_class: 'text-danger',
        email_class: 'text-danger',
        password_class: 'text-danger',

        firstname_message : 'Cant be empty',
        lastname_message : 'Cant be empty',
        username_message : 'Must be 5-20 chars',
        email_message : 'Invalid Email Address',
        password_message : 'Must be 10-40 chars',
        
        firstname_completed: false,
        lastname_completed: false,
        username_completed: false,
        email_completed: false,
        password_completed: false,
    },
    methods: {
        goHome : function(){
            //go to homepage
            window.location.href = '../Main/main.php';
        },
        validateFirstName: function(){
           if(this.firstName.length > 0){
               this.firstname_class = 'text-success';
               this.firstname_message = 'Valid';
               this.firstname_completed = true;
           }else{
               this.firstname_class = 'text-danger';
               this.firstname_message = 'Cant be emty';
               this.firstname_completed = false;
            }
        },
        gotoallistings: function(){
            window.location.href = '../allListings/featured.php';
        },
        validateLastname: function(){
            if(this.lastName.length > 0){
                this.lastname_class = 'text-success';
                this.lastname_message = 'Valid';
                this.lastname_completed = true;
            }else{
                this.lastname_class = 'text-danger';
                this.lastname_message = 'Cant be emty';
                this.lastname_completed = false;
            }
         },
        validateUserName: function(){
            if(this.username.length >= 5 && this.username.length <= 20){
                this.username_class = 'text-success';
                this.username_message = 'Valid';
                this.username_completed = true;
            }else{
                this.username_class = 'text-danger';
                this.username_message = 'Must be 5-20chars';
                this.username_completed = false;
            }
        },
        validateEmail: function(){
            let emailRegex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(emailRegex.test(this.email)){
                this.email_class = 'text-success';
                this.email_message = 'Valid';
                this.email_completed = true;
            }else{
                this.email_class = 'text-danger';
                this.email_message = 'Invalid Email Address';
                this.email_completed = false;
            }
        },
        validatePassword: function(){
            if(this.password.length >= 10 && this.password.length <= 40){
                this.password_class = 'text-success';
                this.password_message = 'Valid';
                this.password_completed = true;
            }else{
                this.password_class = 'text-danger';
                this.password_message = 'Must be 10-40 chars';
                this.password_completed = false;
            }
        },
        registerUser: function(){
            let completed_arr = [this.firstname_completed,this.lastname_completed,this.username_completed,this.email_completed,this.password_completed];
            const checkArr = completed_arr.every(item=> item === true);
            //if checkArr === true the regiter the user else not
            if(checkArr){
                document.getElementById("registerForm").submit();
            }
        }
    }

})