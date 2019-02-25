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
            BREADS: [
                ['Category', 'category'],
                ['Product', 'invert_colors']
            ],
            cruds: [
                ['New', 'add'],
                ['List', 'insert_drive_file'],
            ],
            admin: admin,
            miniVariant: false,
            right: true,
            rightDrawer: false,
            title: 'Prios Shopify!!',
        },
        computed: {
            links() {
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
            },
        },
        created() {
            var self = this;
        },
        methods: {
            capitalize(in_camelCaseString) {
                var result = in_camelCaseString                         // "ToGetYourGEDInTimeASongAboutThe26ABCsIsOfTheEssenceButAPersonalIDCardForUser456InRoom26AContainingABC26TimesIsNotAsEasyAs123ForC3POOrR2D2Or2R2D"
                    .replace(/([a-z])([A-Z][a-z])/g, "$1 $2")           // "To Get YourGEDIn TimeASong About The26ABCs IsOf The Essence ButAPersonalIDCard For User456In Room26AContainingABC26Times IsNot AsEasy As123ForC3POOrR2D2Or2R2D"
                    .replace(/([A-Z][a-z])([A-Z])/g, "$1 $2")           // "To Get YourGEDIn TimeASong About The26ABCs Is Of The Essence ButAPersonalIDCard For User456In Room26AContainingABC26Times Is Not As Easy As123ForC3POOr R2D2Or2R2D"
                    .replace(/([a-z])([A-Z]+[a-z])/g, "$1 $2")          // "To Get Your GEDIn Time ASong About The26ABCs Is Of The Essence But APersonal IDCard For User456In Room26AContainingABC26Times Is Not As Easy As123ForC3POOr R2D2Or2R2D"
                    .replace(/([A-Z]+)([A-Z][a-z][a-z])/g, "$1 $2")     // "To Get Your GEDIn Time A Song About The26ABCs Is Of The Essence But A Personal ID Card For User456In Room26A ContainingABC26Times Is Not As Easy As123ForC3POOr R2D2Or2R2D"
                    .replace(/([a-z]+)([A-Z0-9]+)/g, "$1 $2")           // "To Get Your GEDIn Time A Song About The 26ABCs Is Of The Essence But A Personal ID Card For User 456In Room 26A Containing ABC26Times Is Not As Easy As 123For C3POOr R2D2Or 2R2D"

                    // Note: the next regex includes a special case to exclude plurals of acronyms, e.g. "ABCs"
                    .replace(/([A-Z]+)([A-Z][a-rt-z][a-z]*)/g, "$1 $2") // "To Get Your GED In Time A Song About The 26ABCs Is Of The Essence But A Personal ID Card For User 456In Room 26A Containing ABC26Times Is Not As Easy As 123For C3PO Or R2D2Or 2R2D"
                    .replace(/([0-9])([A-Z][a-z]+)/g, "$1 $2")          // "To Get Your GED In Time A Song About The 26ABCs Is Of The Essence But A Personal ID Card For User 456In Room 26A Containing ABC 26Times Is Not As Easy As 123For C3PO Or R2D2Or 2R2D"

                    // Note: the next two regexes use {2,} instead of + to add space on phrases like Room26A and 26ABCs but not on phrases like R2D2 and C3PO"
                    .replace(/([A-Z]{2,})([0-9]{2,})/g, "$1 $2")        // "To Get Your GED In Time A Song About The 26ABCs Is Of The Essence But A Personal ID Card For User 456 In Room 26A Containing ABC 26 Times Is Not As Easy As 123 For C3PO Or R2D2 Or 2R2D"
                    .replace(/([0-9]{2,})([A-Z]{2,})/g, "$1 $2")        // "To Get Your GED In Time A Song About The 26 ABCs Is Of The Essence But A Personal ID Card For User 456 In Room 26A Containing ABC 26 Times Is Not As Easy As 123 For C3PO Or R2D2 Or 2R2D"
                    .trim();


                    // capitalize the first letter
                    return result.charAt(0).toUpperCase() + result.slice(1);
            },
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



</body>

</html>