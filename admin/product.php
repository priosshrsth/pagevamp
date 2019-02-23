<?php require_once '../layouts/app.php' ?>
<?php
function title() {
    echo "- Customer Login";
}
?>
<?php require_once '../layouts/header.php' ?>
<v-container fluid fill-height>
    <v-layout align-center justify-center>
        <v-flex xs12>
            <v-form @submit.prevent="addProduct" ref="form" id="frmAddProduct" action="" enctype="multipart/form-data" v-model="valid" lazy-validation>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>New Product</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <prios-image :multiple="false" v-model="product.image"></prios-image>
                        <v-select :items="categories" item-text="name" v-model="selectedCategory" item-value="id" :rules="[v => !!v || 'Item is required']" label="Item" required></v-select>
                        <v-text-field :clearable="true" clear-icon name="name" v-model="baseProduct.name" label="Product Name" type="text" required></v-text-field>
                        <v-text-field :clearable="true" prepend-icon="attach_money" clear-icon name="name" v-model="baseProduct.price" label="Price" type="text" required></v-text-field>
                        <v-text-field :clearable="true" prepend-icon="store" clear-icon name="name" v-model="baseProduct.stock" label="Stock Quantity" type="number" required></v-text-field>
                        <div v-for="(attribute,key) in category.attributes" :key="key">
                            <v-select :items="attribute.supportedValues" :name="attribute.name" :label="'Select '+capitalize(attribute.name)" v-if="attribute.type=='select'" :required="attribute.required"></v-select>
                            <v-card v-else-if="attribute.type=='list'">
                                <v-card-title v-text="capitalize(attribute.name)"></v-card-title>
                                <wysiwyg v-model="product[attribute.name]"></wysiwyg>
                            </v-card>

                            <v-text-field v-else :clearable="true" clear-icon name="name" v-model="product[attribute.name]" :label="capitalize(attribute.name)" :type="attribute.type" :required="attribute.required"></v-text-field>
                        </div>
                        <v-text-field :rules="passwordRules" id="password" prepend-icon="lock" name="password" label="Password" v-model="password" type="password" required></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" :disabled="!valid" name="btnAddProduct" @click.stop="addProduct">AddProduct</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-flex>
    </v-layout>
</v-container>

<?php require_once '../layouts/footer.php'; ?>

<?php include '../includes/imageUpload.html'; ?>

<!--//mixins here-->
<script>
    var mixin = {
        data: function() {
            return {
                valid: true,
                snackbar: false,
                snackBarText:'',
                loginStat: null,
                baseProduct: {
                    'name': '',
                    'price': '',
                    'stock': '',
                    'image': '',
                },
                categories: [],
                selectedCategory: -1,
                usernameRules: [
                    v => !!v || 'Username is required',
                    v => (v && v.length >=6) || 'Username must be more than 5 characters',
                    v => (v && v.length <= 20) || 'Username must be less than 20 characters',
                ],
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => (v && v.length >=6) || 'Password must be more than 5 characters',
                    v => (v && v.length <= 20) || 'Password must be less than 20 characters',
                ],
                username: '',
                password: '',
            };
        },
        computed: {
            category() {
                var self = this;
                if(self.categories.length > 0) {

                    if(self.selectedCategory>-1) {
                        return self.categories.filter((cat)=> cat.id==self.selectedCategory)[0];
                    }
                }
                return '';
            },
            product() {
                var self = this;
                if(typeof(self.category) == 'object') {
                    var product = {
                        name: self.baseProduct.name,
                        price: self.baseProduct.price,
                        stock: self.baseProduct.stock,
                    };
                    self.category.attributes.forEach(function (attribute) {
                        product[attribute.name] = '';
                    });
                    return product;
                } else {
                    return this.baseProduct;
                }
            }
        },
        watch: {
            baseProduct(value) {
                this.product.name = value.name;
                this.product.price =  value.price;
                this.product.stock = value.stock;
            },
        },
        methods: {
            addProduct() {
                var self = this;
                var data = new FormData();
                var product = self.product;
                product.category_id = self.category.id;
                data.append('product', JSON.stringify(product));
                axios.post(this.baseURL+'AppCode/Api.php?action=addProduct&role=admin', data)
                    .then(function (response) {
                        console.log(response);
                        var data = response.data;
                        if('success' in data) {
                            console.log(data);
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
        created() {
            var self = this;
            axios.get(this.baseURL+'AppCode/Api.php?action=getCategories')
                .then(function (response) {
                    var data = response.data;
                    if(typeof(data) == 'object'  && 'success' in data) {
                       if(data.success) {
                           self.categories = data.categories;

                           self.selectedCategory = self.categories[0].id;
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
        }
    };
</script>

<?php require_once '../includes/vue.php'; ?>
