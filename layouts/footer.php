            </v-content>
            <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>
                <v-list>
                    <v-list-tile @click.native="right = !right">
                        <v-list-tile-action>
                            <v-icon light>compare_arrows</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-title>Switch drawer (click me)</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>

            <v-footer :fixed="fixed" app>
                <span>&copy; 2019</span>
            </v-footer>
        </v-app>
    </div> <!-- End #app -->

<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="<?php asset('js/prios-vue-wysiwyg.js') ?>"></script>

    <?php
    if(isset($_JS)) {
        foreach($JS as $js) {
            $css = explode(',');
            if(end($js)==='cdn') {
                echo "<script src='$js'></script>";
            } else {
                echo "<script src='assets/js/$js'></script>";
            }
        }
    }
    ?>

    <script>
        // Vue.component('wysiwyg', {});
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = '<?php echo csrf_token(); ?>';
        toastr.options = {
            //"closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 4000,
            "extendedTimeOut": 3000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        <?php
        if(isset($success) && sizeof($success) > 0) {
            foreach ($success as $msg) {
                echo "toastr.success('$msg', 'Yay!! Successfull!!!!')";
            }
        }
        if(isset($exceptions) && sizeof($exceptions) > 0) {
            foreach ($exceptions as $msg) {
                echo "toastr.error('$msg', 'Ooops! Error!!!!',{timeOut: 3000})";
            }
        }
        if(isset($warnings) && sizeof($warnings) > 0) {
            foreach ($warnings as $msg) {
                echo "toastr.warning('$msg', 'Be Careful!!', {timeOut: 8000})";
            }
        }
        ?>

        $('.product-tab-list li a').click(function (e) {
           // e.preventDefault();
            $(this).tab('show');
        });

        $('#productModal').on('show.bs.modal', function (e) {
            var invoker = $(e.relatedTarget);
            var product = JSON.parse(invoker.attr('data'));
            $('img', $(this)).attr('src', 'images/products/'+product.image);
            $('.add_to_cart', $(this)).attr('product', product.id);
            $('.product-info>h1:first-child',$(this)).text(product.name);
            var price = parseFloat(product.price) + 500;
            $('.old-price', $(this)).text('$'+price);
            $('.new-price', $(this)).text('$'+product.price);
        });

        $(document).ready(function () {
            $("#productModal .add_to_cart").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('product');
                if(id != undefined) {
                    app.addToCart($(this).attr('product'));
                }
            });
        });

        function text($el) {
            var words = $el.val().match(/\S+/g).length;
            var min = $el.attr('min');
            if(typeof(min) == "undefined") {
                min = 0;
            }
            var max = $el.attr('max');
            if(typeof(max) == "undefined") {
                max = 4000;
            }
            if(words<min) {
                return "It needs to be more than "+min+" characters!";
            }
            if(words>max) {
                return "It needs to be less than "+max+" characters!";
            }
        }
    </script>