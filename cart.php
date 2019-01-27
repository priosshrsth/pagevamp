<?php require_once 'layouts/app.php' ?>
<?php require_once 'layouts/header.php' ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Cart</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in cart" :key="index">
                                            <td class="product-thumbnail"><a href="javascript:void(0);"><img :src="'images/products/'+item.image" alt="product img"/></a></td>
                                            <td class="product-name"><a :href="'product.php?id='+item.id">{{item.name}}</a></td>
                                            <td class="product-price"><span class="amount">${{item.price}}</span></td>
                                            <td class="product-quantity">{{item.quantity}}</td>
                                            <td class="product-subtotal" v-text="getPrice(index)"></td>
                                            <td class="product-remove"><a @click="removeFromCart(index)" href="javascript:void(0)">X</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="wc-proceed-to-checkout">
                                        <a href="checkout.php">Proceed to Checkout</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 float-right">
                                    <div class="cart_totals">
                                        <table>
                                            <tbody>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td>
                                                        <strong><span class="amount">{{totalPrice}}</span></strong>
                                                    </td>
                                                </tr>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>

<?php require_once 'layouts/footer.php'; ?>