<?php require_once '../layouts/app.php' ?>
<?php
if(auth('admin')->check()) {
    header('Location:'.$BASE_URL.'admin/');
}
function title() {
    echo "- Customer Login";
}
?>
<?php require_once '../layouts/header.php' ?>
<v-container fluid fill-height>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-form @submit.prevent="login" ref="form" id="frmLogin" action="" enctype="multipart/form-data" v-model="valid" lazy-validation>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Admin Login</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-alert dismissible v-if="loginStat!==null" :value="loginStat!==null" :type="loginStat.success?'success':'error'">
                        {{loginStat.msg}}
                    </v-alert>
                    <v-card-text>
                        <v-text-field :rules="usernameRules" :clearable="true" clear-icon counter prepend-icon="person" name="username" v-model="username" label="Username" type="text" required></v-text-field>
                        <v-text-field :rules="passwordRules" counter id="password" prepend-icon="lock" name="password" label="Password" v-model="password" type="password" required></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" :disabled="!valid" name="btnCustomerLogin" @click.stop="login">Login</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-flex>
    </v-layout>
</v-container>

<v-snackbar v-model="snackbar" multi-line="multi-line" >
    {{ snackBarText }}
    <v-btn color="pink" flat @click="snackbar = false">
        Close
    </v-btn>
</v-snackbar>

<?php require_once '../layouts/footer.php'; ?>

<!--//mixins here-->
<script>
    var mixin = {
        data: function() {
            return {
                valid: true,
                snackbar: false,
                snackBarText:'',
                loginStat: null,
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
        methods: {
            login() {
                var data = new FormData();
                var self = this;
                data.append('username', this.username);
                data.append('password', this.password);
                if (this.$refs.form.validate()) {
                    axios.post(this.baseURL+'AppCode/Api.php?action=login&role=admin', data)
                        .then(function (response) {
                            console.log(response);
                            var data = response.data;
                            if('success' in data) {
                                self.loginStat = {
                                    success: data.success,
                                    msg: data.msg,
                                }
                                self.adminLoggedIn = true;
                                window.location = self.baseURL+'admin/';
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
            }
        }
    };
</script>

<?php require_once '../includes/vue.php'; ?>
