new Vue({
    el: '#vue-app',

    data(){
        return {

        }
    },

    methods: {
        editRealtor(event){
            const realtorsId = event.target.getAttribute('data-realtorsid');
            //edit admin

        },
        deleteRealtor(){
            const realtorsId = event.target.getAttribute('data-realtorsid');
            
            $.post('deleteUser.act.php', {
                userId: realtorsId
            },function(data,info){
                const deleteSucceded = new Promise((resolve,reject)=> {
                    if(info === 'success'){
                        window.location.reload();
                    }else{
                        alert("Service Failed Pls try again later");
                    }
                })
            })
        }
    }
})