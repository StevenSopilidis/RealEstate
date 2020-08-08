new Vue({
    el : "#vue-app",

    data(){
        return { 
            userAmount: 7
        }   
    },
    methods: {
        seeMoreUsers(){            
            $('#tablebody').load('displayMoreUsers.php',{
                amount: this.userAmount
            })
            this.userAmount += 3;
        }
    }
})