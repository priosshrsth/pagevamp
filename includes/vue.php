<script>
    var admin = JSON.parse(<?php var_export(json_encode(auth('admin')->user())); ?>);
    var app = new Vue({
        el: '#app',
        mixins: [mixin],
        data: {
            cart: [],
            adminLoggedIn: <?php var_export(auth('admin')->check()); ?>,
            customerLoggedIn: <?php var_export(auth()->check()); ?>,
            header: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            clipped: false,
            drawer: false,
            fixed: false,
            baseURL: '<?php echo App::$base_url; ?>',
            admins: [
                ['Category', 'category'],
                ['Product', 'invert_colors']
            ],
            cruds: [
                ['Create', 'add'],
                ['Read', 'insert_drive_file'],
                ['Update', 'update'],
                ['Delete', 'delete']
            ],
            admin: admin,
            miniVariant: false,
            right: true,
            rightDrawer: false,
            title: 'Prios Shopify!!',
        },
        computed: {
            items() {
                if(this.adminLoggedIn) {
                    return [
                        {
                            icon: 'apps',
                            title: 'Dashboard',
                            to: this.baseURL+'admin/',
                        },
                        {
                            icon: 'home',
                            title: 'Home',
                            to: this.baseURL,
                        },
                        {
                            icon: 'person',
                            title: 'Customer Login',
                            to: this.baseURL+'login.php',
                        },
                    ];
                } else if(this.customerLoggedIn) {
                    return [
                        {
                            icon: 'home',
                            title: 'Home',
                            to: this.baseURL,
                        },
                    ];
                } else {
                    return [
                        {
                            icon: 'home',
                            title: 'Home',
                            to: this.baseURL,
                        },
                        {
                            icon: 'person',
                            title: 'Login',
                            to: this.baseURL+'login.php',
                        },
                    ];
                }
            }
        },
        created() {
            var self = this;
        },
        methods: {
            addToCart(productID) {
                var self = this;
                //var body = {
                //    'id': productID,
                //    'add_to_cart': 'Submit',
                //    '_token': "//",
                //};
                fetch('api.php?api=true&add_to_cart=true&id='+productID, {
                    method: "get",
                    headers: self.header,
                    credentials: "same-origin",
                })
                    .then((resp) => resp.json()) // Call the fetch function passing the url of the API as a parameter
                    .then(function(data) {
                        try {
                            if(data.success) {
                                if(data.new) {
                                    self.cart.push(data.product);
                                } else {
                                    let obj = self.cart.find(x => x.id == productID);
                                    let index = self.cart.indexOf(obj);
                                    self.cart[index].quantity = self.cart[index].quantity + 1;
                                }
                                toastr.success(data.msg, 'Added to cart!!');
                            } else {
                                toastr.error(data.msg, 'Ooops! Error!!!!');
                            }
                        } catch (e) {
                            console.log(data);
                            toastr.warning('Unable to resolve response!', 'Ooops! Error!!!!');
                        }
                        // Your code for handling the data you get from the API
                    })
                    .catch(function(error) {
                        console.log(error);
                        // This is where you run code if the server returns any errors
                    });
            },
            removeFromCart(index) {
                var self = this;
                fetch('api.php?api=true&remove_from_cart=true&index='+index, {
                    method: "get",
                    headers: self.header,
                    credentials: "same-origin",
                })
                    .then((resp) => resp.json()) // Call the fetch function passing the url of the API as a parameter
                    .then(function(data) {
                        try {
                            if(data.success) {
                                self.cart.splice(index,1);
                                toastr.success("Successfully Removed From CArt", 'Removed!!');
                            } else {
                                toastr.error("Unable To Remove!", 'Ooops! Error!!!!');
                            }
                        } catch (e) {
                            console.log(data);
                            toastr.warning('Unable to resolve response!', 'Ooops! Error!!!!');
                        }
                        // Your code for handling the data you get from the API
                    })
                    .catch(function(error) {
                        console.log(error);
                        // This is where you run code if the server returns any errors
                    });
            },
            getPrice(index) {
                console.log(index);
                var cart = this.cart;
                return parseFloat(cart[index].price) * parseFloat(cart[index].quantity);
            }
        }
    });
</script>