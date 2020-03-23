<template>
<div>
  <form v-if="showpaypal === false" autocomplete="nofill" @submit.prevent="submitDomain" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="category">Select a category</label>
    <select class="form-control" id="category" v-model="form.category_id">
      <option v-for="category in this.categories" :value="category.id">{{category.categoryname}}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="subcategory">Select a subcategory if you wish</label>
    <select class="form-control" id="subcategory" v-model="form.subcategory_id">
      <option v-for="subcategory in filteredSubcategories"  :value="subcategory.id">{{subcategory.subcategoryname}}</option>
    </select>
  </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input  autocomplete="nofill" type="email" :class="{ 'is-invalid' : form.errors.has('email') }" class="form-control" id="inputEmail4" v-model="form.email" placeholder="Your email address" @keydown="form.errors.clear('email')">
                        <div class="invalid-feedback" v-show="form.errors.has('email')" v-text="form.errors.get('email')"></div>
                    </div>
                    
                 <div class="form-group col-md-6">
                    <label for="url">Domain URL <span class="text-secondary">Start with: http:// or https://</span></label>
                    <input  autocomplete="nofill" type="text" :class="{ 'is-invalid': form.errors.has('url') }" class="form-control" id="url" placeholder="https://www.your-doamin.com" v-model='form.url' @keydown="form.errors.clear('url')">
                    <div class="invalid-feedback" v-show="form.errors.has('url')" v-text="form.errors.get('url')"></div>
                </div>
                </div>
  <div class="input-group mb-3">
    <input id="img" type="file"  class="form-control-file">
    <p class="text-danger text-sm" v-show="form.errors.has('img')" v-text="form.errors.get('img')"></p>
  </div>
                <div class="form-group">
                    <label for="inputAddress">Title of your website</label>
                    <input  autocomplete="nofill" type="text" :class="{ 'is-invalid' : form.errors.has('title') }" class="form-control" id="inputAddress" v-model="form.title" placeholder="Money blokes"  @keydown="form.errors.clear('title')"> 
                    <div class="invalid-feedback" v-show="form.errors.has('title')" v-text="form.errors.get('title')"></div>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Short description</label>
                    <input  autocomplete="nofill" type="text" :class="{ 'is-invalid' : form.errors.has('shortdescription') }" class="form-control" id="inputAddress2" placeholder="This website is about money management..." v-model="form.shortdescription"  @keydown="form.errors.clear('shortdescription')">
                                  <div class="invalid-feedback" v-show="form.errors.has('shortdescription')" v-text="form.errors.get('shortdescription')"></div>
                </div>
                <div class="form-group">
                    <vue-editor v-model="form.description" />
                </div>
                 <div class="form-group">
                    <label for="">Submit your website for  <span class="text-success">$4.99</span></label>
                </div>
               <button  type="submit" class="btn btn-success">Submit and Pay</button> 
               
        </form>
        <div  v-show="showpaypal === true & loadding === false" class="container">
          <div class="row text-center">
            <div class="w-100 text-center">
 <h5 class="mb-3 text-center">Your domain successfully registered, but you need to pay to be displayed on our website!</h5>
  <h5 class="mb-3 text-center">Please pay $4.99 </h5>
            </div>
             
             <div class="w-100">
                <div class="mx-auto w-50" ref="paypal"></div>
             </div>
              
          </div>
        </div>
        <div  v-show="showpaypal === true & loadding === true" class="container">
          <div class="row text-center">
            <div class="w-100 text-center">
              <h5 class="text-center">Checking your payment please wait!</h5>
             </div>
          </div>
        </div>

</div>
        

</template>
<script>
export default {
    props: ['categories', 'subcategories'],
    data(){
        return{
            loaded: false,
            showpaypal: false,
            loadding: false,
      paidFor: false,
      product: {
        price: 3.99,
        description: "backlink from"
      },
            form: new Form({
                url: '',
                email: '',
                title: '',
                shortdescription: '',
                description:'',
                img: '',
                category_id:'1',
                subcategory_id:'',
            })
        }
    },

     mounted: function() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AaWPbZcqvAtYj6DPHuolAF81c45GCPKkBxzKUyx60Xwg4QSnpsecha7GURHMoMBp0HYCdfvHovl7psnZ";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },

methods: {

    setLoaded: function(resp) {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: this.product.description,
                  amount: {
                    currency_code: "USD",
                    value: this.product.price
                  }
                }
              ]
            });
          },
          onApprove: async (data, actions, resp) => {
            this.loadding = true;
            const order = await actions.order.capture();
            this.data;
            this.paidFor = true;
            this.loadding = false;
            window.location.href = "./paymentsuccess/" +this.resp;
          },
          onError: err => {
            console.log(err);
          }
        })
        .render(this.$refs.paypal);
    },
    submitDomain(){
        let data = new FormData();
        data.append('title', this.form.title);
        data.append('url', this.form.url);
        data.append('email', this.form.email);
        data.append('shortdescription', this.form.shortdescription);
        data.append('description', this.form.description);
        data.append('category_id', this.form.category_id);
        data.append('subcategory_id', this.form.subcategory_id);
        if(document.getElementById('img').files[0]){data.append('img', document.getElementById('img').files[0])};

        axios.post('/domain', data)
        .then( (response)=> {
            this.form.reset();
            this.showpaypal = true;
           this.resp= response.data;
        })
        .catch(error => this.form.errors.record(error.response.data));
    }
},
 computed: {
        filteredSubcategories: function() {
            return this.subcategories.filter((item) => item.category_id == this.form.category_id);    
     }
    },
}
</script>
