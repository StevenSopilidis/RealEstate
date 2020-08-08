Vue.component('inquireform',{
    template: `<form action="sendInqure.php" class="needs-validation" ref="form" method="post">
                <div class="form-group col-12">
                    <label for="propery">Userame: <span id="errormessange1" class="text-danger">Cant Be Empty</span> </label>
                    <input class="form-control" type="text" name="username" placeholder="" ref="name">
                </div>
                <div class="form-group col-12">
                    <label for="propery">Email: <span id="errormessange2" class="text-danger">Cant Be Empty</span></label>
                    <input class="form-control" type="text" name="email" placeholder="" ref="email">
                </div>
                <div class="form-group col-12">
                    <label for="propery">Phone:</label>
                    <input class="form-control" type="text" name="phonenumber" placeholder="" ref="phonenumber">
                </div>
                <div class="form-group col-12">
                    <label for="propery">Messange:</label>
                    <input id="messange" class="form-control" type="text" name="messange" placeholder="" ref="messange">
                </div>
                <button v-on:click.prevent="sendInquire" class="col-8" type="submit">Send</button>
            </form>`,

    data: {

    },
    methods: {
        sendInquire(){
            const name = this.$refs.name.value;
            const email = this.$refs.email.value;
            const phonenumber = this.$refs.name.phonenumber;
            const messange = this.$refs.name.messange;
            
            //if name or email are empty display the <span id="errormessange" class="text-danger">Cant Be Empty</span>
            const check = new Promise((resolve,reject)=>{
                if(name.length === 0 || name === ' ' || email.length === 0 || email === ' '){
                    reject();
                }else{
                    resolve();
                }
            })

            //submit the form
            check.then(()=>{
                this.$refs.form.submit();
            })
            //dont allow the form to be submitted
            check.catch(()=>{
                $('#errormessange1').css("visibility", "visible");
                $('#errormessange2').css("visibility", "visible");
                //make disapear after 3 sec
                window.setTimeout(()=>{
                    $('#errormessange1').css("visibility", "hidden");
                    $('#errormessange2').css("visibility", "hidden");
                },3000)
            })

        }
    }
});

Vue.component('headercomponent',{
    template: `<div id="header">
                    <div>
                        <h5>Make an Inquire</h5>
                        <i v-on:click="exit" class="fas fa-times"></i>
                    </div>
                    <hr>
                </div>
               `,
    data: {

    },
    methods:{
        exit(){
            window.location.href='../Main/main.php';
        }
    }
})

new Vue({
    el: '#vue-app',
    data: {

    },
    methods: {
        sendInquire(){
            console.log('hallo');
        }
    }
})