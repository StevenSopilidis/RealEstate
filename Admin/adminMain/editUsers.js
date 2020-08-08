new Vue({
    el : "#vue-app",

        data(){
            return { 
                userAmount: 7,
                //used in the editUserDetails.php
            }   
        },
        methods: {
            seeMoreUsers(){            
                $('#tablebody').load('displayMoreUsersForEdit.php',{
                    amount: this.userAmount
                })
                this.userAmount += 3;
            },
    }
})


//event listeners for edit and delete btn
document.addEventListener('click', e => {
    //check if the button clicked is the edit or the delete btn
    const btn = e.target.getAttribute('id');
    if(btn === 'editBtn'){
        //edit User
        const id = e.target.getAttribute('data-userid');//the id of the user

        window.location.href = `editUsersDetails.php?id=${id}`;
    }else if(btn === 'deleteBtn'){
        //delete User
        const id = e.target.getAttribute('data-userid');

        $.post('deleteUser.act.php',{
            userId: id
        },function(data,info){
            //check if the user was deleted succussfully
            const deleteSucceded = new Promise((resolve,reject)=> {
                if(info === 'success'){
                    window.location.reload();
                }else{
                    alert("Service Failed Pls try again later");
                }
            })
        })
    }
})