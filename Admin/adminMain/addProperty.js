//make the form into multiple parts
Vue.component('firstpart',{
    template: `
    <div>
        <div class="form-group">
            <div>
                <label for="price">Price</label>
                <input type="number" name="properties_price" class="form-control" v-model="price">
                <p class="text-danger">Cant Be empty</p>
            </div>
            <div>
                <label for="bedrooms">Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control" v-model="bedrooms">
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="Bathrooms">Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" v-model="bathrooms">
                <p class="text-danger">Cant Be empty</p>
            </div>
            <div>
                <label for="Garages">Garages</label>
                <input type="number" name="Garages" class="form-control" v-model="garages">
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div id="btn-div">
            <button v-on:click.prevent="goToNext" class="btn btn-info col-2">Next</button>
        </div>
    </div>`,

    data(){
        return{
            price: '',
            bedrooms: '',
            bathrooms: '',
            garages: ''
        }
    },

    methods: {
        goToNext(){
            this.$emit('nextpage',{
                price: this.price,
                bedrooms: this.bedrooms,
                bathrooms: this.bathrooms,
                garages: this.garages,
            })            
        }
    }
});
Vue.component('secondpart',{
    template : `
    <div>
        <div class="form-group">
            <div>
                <label for="Square_foot">Square_foot</label>
                <input type="number" name="square_foot" class="form-control" v-model="square_foot">
                <p class="text-danger">Cant Be empty</p>
            </div>
            <div> 
                <label for="Lot_size">Lot_size</label>
                <input type="number" name="lot_size" class="form-control" v-model="lot_size">
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="listing_date">listing_date</label>
                <input type="date" name="date" class="form-control" v-model="date">
                <p class="text-danger">Cant Be empty</p>
            </div>
            <div>
                <label for="State">State</label>
                <input type="text" name="state" class="form-control" v-model="state">
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div id="btn-div">
            <button v-on:click.prevent="goToPreviousPart" class="btn btn-danger col-2">Previous</button>
            <button v-on:click.prevent="goToNext" class="btn btn-info col-2">Next</button>
        </div>
    </div>
    `,

    data(){
        return{
            square_foot: '',
            lot_size: '',
            date: '',
            state: ''
        }
    },

    methods: {
        goToNext(){
            this.$emit('nextpage',{
                square_foot: this.square_foot,
                lot_size: this.lot_size,
                date: this.date,
                state: this.state,
            });       
        },
        goToPreviousPart(){
            this.$emit('previouspage');
        }
    }
})

Vue.component('thirdpart',{
    template : `
    <div>
        <div class="form-group">
            <div>
                <label for="City">City</label>
                <input type="text" name="city" class="form-control" v-model="city">
                <p class="text-danger">Cant Be empty</p>
            </div>
            <div>
                <label for="Details">Details</label>
                <textarea class="form-control" name="details" id="exampleFormControlTextarea5" rows="3" v-model="details"></textarea>
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div class="form-group">        
            <div>
                <label for="Street">Street</label>
                <input type="text" class="form-control" name="street" v-model="street">
                <p class="text-danger">Cant Be empty</p>
            </div>
        </div>
        <div id="btn-div">
            <button v-on:click.prevent="goToPreviousPart" class="btn btn-danger col-2">Previous</button>
            <button v-on:click.prevent="listPropertie" class="btn btn-info col-2">List</button>
        </div>
    </div>
    `,
    data(){
        return{
            city: '',
            details: '',
            street: '',
            selectedFile: null
        }
    },

    methods: {
        listPropertie(){
            this.$emit('listpropertie',{
                city: this.city,
                details: this.details,
                street: this.street,
            });       
        },
        goToPreviousPart(){
            this.$emit('previouspage');
        },
          
    }
})

new Vue({
    el: '#vue-app',
    data(){
        return {
            current: 'firstpart',

            price: '',
            bedrooms: '',
            bathrooms: '',
            garages: '',
            square_foot: '',
            lot_size: '',
            date: '',
            state: '',
            city: '',
            details: '',
            street: '',
        }
    },
    methods: {
        //goes to the next page
        goToNextPage(values){
            if(this.current === 'firstpart'){
                //extract all the inputs
                this.price = values.price,
                this.bedrooms = values.bedrooms,
                this.bathrooms = values.bedrooms,
                this.garages = values.bedrooms,
                
                this.current = 'secondpart';
            }else if(this.current === 'secondpart'){
                //extract all the inputs
                this.square_foot = values.square_foot,
                this.lot_size = values.lot_size,
                this.date = values.date,
                this.state = values.state,

                this.current = 'thirdpart';
            };
        },
        //goes to the previous page
        goToPreviousPage(){
            if(this.current === 'secondpart'){
                this.current = 'firstpart';
            }else if(this.current === 'thirdpart'){
                this.current = 'secondpart';
            }
        },
        //list the property the admin wants to
        listPropertie(values){
            //extract all the inputs
            this.city = values.city
            this.details = values.details
            this.street = values.street
            //pass the values into php and uplaod them to the server
            //the image will be selected by the php its self
            
            $.post('uploadDetailsonDb.php',{
                price: this.price,
                bedrooms: this.bedrooms,
                bathrooms: this.bathrooms,
                garages: this.garages,
                square_foot: this.square_foot,
                lot_size: this.lot_size,
                date: this.date,
                state: this.state,
                city: this.city,
                details: this.details,
                street: this.street,

            },function(data,info){
                const checkPost = new Promise((resolve,reject) => {
                    console.log(data);
                    if(info == 'success'){
                        resolve();
                    }else{
                        reject();
                    }
                })
                checkPost.then(() => {
                    //get admin to another form so he/she can upload images
                    window.location.href = 'addPropertieImage.php'
                })

                checkPost.catch(() => {
                    alert('Service Failed Pls Try Again Later');
                })
            })

        }
    }
})