new Vue({
    el: '#vue-app',

    methods: {
        //set the realtor selected as mvp(realtor of the month)
        setMvp(event){
            const username = event.currentTarget.id;//the the username of the realtors which is saved as id
            $.post('setMvp.php', {
                mvp : username 
            },function(data,info){
                (info === 'success')? window.location.reload():alert("Service Failed Pls Try Again Later");
            })        
        }
    }
})