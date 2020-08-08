new Vue({
    el: '#vue-app',
    data(){
        return {
        }
    },

    methods: {
        seeAllUsers(){
            window.location.href = 'displayallUsers.php';
        },
        seeRealtors(){
            window.location.href = 'displayAllRealtors.php';
        },
        seeInquires(){
            //see all the inquires that have been sent to the specific user
            window.location.href = 'seeAllinquries.php';
        },
        goToListings(){
            window.location.href = 'displayListings.php';
        },
        addProperty(){
            window.location.href = 'addProperty.php';
        },
        addUser(){
            //let admin create a user account
            window.location.href = 'addUser.php';
        },
        editUser(){
            //let admin edit users
            window.location.href = 'editUser.php'
        },
        addRealtor(){
            //add a new realtor
            window.location.href = 'createAdmin.php';
        },
        editRealtor(){
            //create Admin
            window.location.href = 'editRealtors.php'
        },
        editListings(){
            //let user edit listings (just unpublish them or delete them)
            window.location.href = 'editListings.php';
        }
    }
})