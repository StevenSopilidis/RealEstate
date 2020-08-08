new Vue({
    el: '#vue-app',

    data(){
        return {

        }
    },

    methods: {
        deleteListing(){

        },
        change(event){
            const houseId = event.target.getAttribute('data-propId');//get the id of the house we want to publish or unpublish
            const active = event.target.getAttribute('data-active');//tells use wether the property was listed as drafted or published before clicking the button 

            $.post('editListing.act.php',{
                houseId : houseId,
                active : active,
            },function(data,info){
                console.log(data); 
                const editProperty = new Promise((resolve,reject)=> {
                    if(info === 'success'){
                        resolve();
                    }else{
                        reject();
                    }
                })
                editProperty.then(() => {
                    window.location.reload();
                })
                editProperty.catch(() => {
                    alert("Service Failed Pls try again later");
                })
            })
        },

        deleteListing(event){
            const houseId = event.target.getAttribute('data-propId');//get the id of the house we want to publish or unpublish
            $.post('editListing.act.php',{
                deletehouseId : houseId,
            },function(data,info){
                console.log(data); 
                const deleteProperty = new Promise((resolve,reject)=> {
                    if(info === 'success'){
                        resolve();
                    }else{
                        reject();
                    }
                })
                deleteProperty.then(() => {
                    window.location.reload();
                })
                deleteProperty.catch(() => {
                    alert("Service Failed Pls try again later");
                })
            })
        }
    },
})
