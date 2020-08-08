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
        displayOverlay: false,
        srcOfImage: '',//src of the image the user wants to see;
    },
    methods: {
        goHome(){
            window.location.href = '../Main/main.php';
        },
        goFeaturedListings(){
            window.location.href = '../allListings/featured.php';
        },
        goToRegistration(){
            window.location.href = '../SignUp/signup.php';
        },
        //incuire a house
        makeInqurie(){
            window.location.href = '../InquireHouses/inquire.php';
        },
        //delete inquire for a specific house
        Uninquire(){
            window.location.href = './deleteInquire.php';
        },
        //see image
        seeImage(event){
            this.displayOverlay = true;
            //get the images name and display it bigger
            const image_name = event.target.getAttribute('src');
            this.srcOfImage = image_name;
        },
        closeWindow(){
            this.displayOverlay = false;
        },
        goToAbout(){
            window.location.href = '../About/about.php';
        }
    }

})