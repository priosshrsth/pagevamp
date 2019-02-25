<?php require_once 'layouts/app.php' ?>
<?php require_once 'layouts/header.php' ?>
<?php require_once('vendor/autoload.php');
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

$gateway = Omnipay::create('Stripe');
$gateway->setApiKey('sk_test_WDDBxqHa87ZHzWB5fLX4TGpo');
$gateway->setTestMode(true);
?>
<v-container grid-list-sm fluid>
    <v-layout row wrap>
        <v-flex v-for="(product,key) in products" :key="key" xs12 sm6 md4 lg3>
            <v-card>
                <v-img class="white--text" height="200px" :src="baseURL+'assets/images/'+product.image[0]">
                    <v-container fluid>
                        <v-layout>
                            <v-flex xs2 offset-xs10 justify-align-end flexbox>
                                <v-spacer></v-spacer>
                                    <v-fab-transition>
                                        <v-btn justify-end color="pink" fab dark big>
                                            ${{product.price}}
                                        </v-btn>
                                    </v-fab-transition>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-img>
                <v-card-title>
                    <div>
                        <span class="grey--text">{{product.name}}</span><br>
                        <span>Size: {{product.size}} {{product.category.attributes.filter((attr)=>attr.name=='size')[0].unit}}</span><br>
                        <span>{{product.category.name}}</span>
                    </div>
                </v-card-title>
                <v-card-actions>
                    <v-btn flat color="orange">Add TO Cart</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn flat color="orange" @click="buy(key)">Buy Now</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>

<v-dialog v-model="productModal" persistent max-width="500">
    <v-form :action="baseURL+'AppCode/Api.php?action=checkout'" ref="paymentForm" method="post" id="payment-form" v-model="valid" lazy-validation>
        <v-card>
            <v-toolbar color="primary">
                <v-toolbar-title>Credit or Debit Card</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text v-if="currentProduct.index>-1">
                You are about to pay Rs. {{totalPrice}} for <span class="purple--text">{{products[currentProduct.index].name}}</span>
                <v-text-field min='1' :max="products[currentProduct.index].stock" :rules="quantityRules" max="products[currentProduct.index].stock" :clearable="true" clear-icon prepend-icon="" name="quantity" v-model="currentProduct.quantity" label="Quantity" type="number" required></v-text-field>
                <input type="hidden" name="amount" v-model="totalPrice">
            </v-card-text>
            <v-card-text>
                <div id="card-errors" class="" role="alert"></div>

                <div id="card-element"></div>
            </v-card-text>
            <v-card-actions>
                <v-btn color="error" @click="productModal=false">Cancel</v-btn>
                <v-spacer></v-spacer>
                <v-btn type="submit" color="primary">Pay with Stripe</v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
</v-dialog>
<?php
$_JS = ["https://js.stripe.com/v3/,cdn"];
?>
<?php require_once 'layouts/footer.php'; ?>

<!--//<Mixins Here-->
<script>
var mixin = {
    data: ()=> ({
        productItems: [],
        categories: [],
        productModal: false,
        currentProduct: {
            index: -1,
            quantity: 1,
        },
        stripeToken: '',
        valid: true,
    }),
    computed: {
        products() {
            var self = this;
            return self.productItems.map((item)=> {
                category = self.categories.filter((cat) => cat.id == item.category_id);
                if(category !== undefined && category.length > 0) {
                    item.category = category[0];
                } else {
                    item.category = {
                        id: null,
                        name: null,
                    }
                }
                return item;
            });
        },
        quantityRules() {
            currentStock = this.getStock();
            return [
                v => !!v || 'Quantity is required',
                v => (v && v>0) || 'Quantity must atleast be 1',
                v => (v && v<=currentStock) || 'Out Of Stock!!',
            ];
        },
        totalPrice() {
            var product = this.products[this.currentProduct.index];
            if(this.currentProduct.quantity>0 && this.currentProduct.quantity <= product.stock) {
                return parseInt(this.currentProduct.quantity) * parseFloat(product.price);
            }
            else if(this.currentProduct<0) {
                return product.price;
            } else {
                return parseInt(product.stock) * parseFloat(product.price);
            }
        }
    },
    watch: {
        currentProduct: function(product) {
            var self = this;
            alert();
            if(product.quantity>self.getStock()) {
                self.currentProduct.quantity--;
            }
        }
    },
    created() {
        var self = this;
        axios.get(this.baseURL+'AppCode/Api.php?action=getProducts')
            .then(function (response) {
                var data = response.data;
                if(typeof(data) == 'object'  && 'success' in data) {
                    if(data.success) {
                        self.productItems = data.products;
                        self.categories = data.categories;

                    } else {
                        toastr.error(data.msg);
                    }
                } else {
                    toastr.warning('Invalid response!');
                    console.log(data);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    methods: {
        buy(index) {
            var self = this;
            self.currentProduct.index = index;
            $('body').on('click','.InputELmenet', function() {
                alert($(this).val());
            });
            $('.InputElement').each(function() {
                $(this).attr('readonnly', true);
                var name = $(this).attr('name');
                if(name == 'cardnumber') {
                    $(this).val("4242 4242 4242 4242");
                } else if(name == "exp-date") {
                    $(this).val("12 / 19");
                } else if(name == "cvd") {
                    $(this).val('123');
                } else {
                    $(this).val('45324');
                }
            });
            $('[name="exp-date"].InputElement').each(function() {
                $(this).val("4242 4242 4242 4242");
                $(this).attr('readonnly', true);
            });

            self.productModal = true;
        },
        checkout() {
            var self = this;
            var data = new FormData();
            data.append('stripe_token', this.stripeToken);
            data.append('product_id', this.products[this.currentProduct.index].id);
            data.append('totalPrice', this.totalPrice);
            data.append('quantity', this.currentProduct.quantity);
            console.log(self.$refs.paymentForm.validate());
            if (self.$refs.paymentForm.validate()) {
                axios.post(this.baseURL+'AppCode/Api.php?action=checkout', data)
                    .then(function (response) {
                        console.log(response.data);
                        var data = response.data;
                        if('success' in data) {
                            self.productModal = false;
                            toastr.success('Payment Successfull!', "You just paid Rs. "+self.totalPrice +" with Stripe!");
                        } else {
                            self.snackBarText="Invalid Response!";
                            self.snackbar = true;
                            console.log(data);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        getStock() {
            return parseInt(this.products[this.currentProduct.index].stock);
        },
        setToken(token) {
            this.stripeToken = token;
        }
    },
    mounted() {
        var stripe = Stripe('pk_test_TECyQ6aPfkLCtTd4uipiwdJN');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            app.stripeToken = token.id;
            app.checkout();
        }
    }
};
</script>
<?php require_once 'includes/vue.php'; ?>
