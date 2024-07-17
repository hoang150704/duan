<!-- Banner -->
<div class="banner_section banner_section_three">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner8.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner9.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="banner_area bottom">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner10.jpg" alt="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product section area start-->
<section class="product_section womens_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản phẩm của chúng tôi</h2>
                    <p>Các sản phẩm thiết kế hiện đại,mới nhất</p>
                </div>
            </div>
        </div>
        <div class="product_area">
            <div class="row">
                <div class="col-12">
                    <div class="product_tab_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#clothing" role="tab" aria-controls="clothing" aria-selected="true">Áo thun</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#handbag" role="tab" aria-controls="handbag" aria-selected="false">Áo sơ mi</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#shoes" role="tab" aria-controls="shoes" aria-selected="false">Áo polo</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#accessories" role="tab" aria-controls="accessories" aria-selected="false">Quần âu</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="clothing" role="tabpanel">
                    <div class="product_container">
                        <div class="row product_column4">
                            <?php foreach ($listAoThun as $AoThun) :  ?>
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="<?=BASE_URL.'?act=product-detail&id='.$AoThun['id'] ?>"><img src="<?= BASE_URL . $AoThun['main_image'] ?>" alt="" id="main_image"></a>
                                            <!-- <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product22.jpg" alt=""></a> -->

                                            <div class="quick_button">
                                                <a href="<?=BASE_URL.'?act=product-detail&id='.$AoThun['id'] ?>" title="quick_view">Xem sản phẩm</a>

                                            </div>

                                            <div class="product_sale">
                                                <span><?php if($AoThun['sale_price'] !=0){
                                                    $percent= round(100- $AoThun['sale_price']/$AoThun['price']*100);
                                                    echo $percent.'%';
                                                }else{ echo 'New';} ?></span>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a href="<?=BASE_URL.'?act=product-detail&id='.$AoThun['id'] ?>"><?= $AoThun['product_name'] ?></a></h3>
                                            <?php if ($AoThun['sale_price'] == 0) : ?>
                                                <?php if ($AoThun['price'] == 0) : ?>
                                                    <span class="current_price">Liên hệ</span>
                                                <?php else : ?>
                                                    <span class="current_price"><?=$AoThun['price']. ' đ' ?></span>
                                                <?php endif ?>
                                                <?php else: ?>
                                                    <span class="current_price"><?=$AoThun['sale_price']. ' đ' ?></span>
                                                    <span class="old_price"><?=$AoThun['price']. ' đ' ?></span>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="handbag" role="tabpanel">
                    <div class="product_container">
                        <div class="row product_column4">
                            <div class="col-lg-3">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product20.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product19.jpg" alt=""></a>

                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Marshall Portable Bluetooth</a></h3>
                                        <span class="current_price">£60.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="shoes" role="tabpanel">
                    <div class="product_container">
                        <div class="row product_column4">
                            <div class="col-lg-3">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product10.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product11.jpg" alt=""></a>

                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>
                                        <div class="label_product">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Marshall Portable Bluetooth</a></h3>
                                        <span class="current_price">£60.00</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="accessories" role="tabpanel">
                    <div class="product_container">
                        <div class="row product_column4">
                            <div class="col-lg-3">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product1.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product2.jpg" alt=""></a>

                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>

                                        <div class="product_sale">
                                            <span>-7%</span>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Marshall Portable Bluetooth</a></h3>
                                        <span class="current_price">£60.00</span>
                                        <span class="old_price">£86.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--product section area end-->

<!--banner area start-->
<section class="banner_section banner_section_three">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-6 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner11.jpg" alt="#"></a>
                        <div class="banner_content">
                            <h1>Handbag <br> Men’s Collection</h1>
                            <a href="shop.html">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="banner_area">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner12.jpg" alt="#"></a>
                        <div class="banner_content">
                            <h1>Sneaker <br> Men’s Collection</h1>
                            <a href="shop.html">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--banner area end-->

<!--product section area start-->
<section class="product_section womens_product bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản phẩm thịnh hành</h2>
                    <p>Sản phẩm ấn tượng và bán chạy nhất</p>
                </div>
            </div>
        </div>
        <div class="product_area">
            <div class="row">
                <div class="product_carousel product_three_column4 owl-carousel">
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product21.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product22.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>

                                <div class="product_sale">
                                    <span>-7%</span>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Marshall Portable Bluetooth</a></h3>
                                <span class="current_price">£60.00</span>
                                <span class="old_price">£86.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product27.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product28.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Koss KPH7 Portable</a></h3>
                                <span class="current_price">£60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product6.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product5.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>

                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Beats Solo2 Solo 2</a></h3>
                                <span class="current_price">£60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product7.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product8.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>

                                <div class="product_sale">
                                    <span>-7%</span>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Beats EP Wired</a></h3>
                                <span class="current_price">£60.00</span>
                                <span class="old_price">£86.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product24.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product25.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Bose SoundLink Bluetooth</a></h3>
                                <span class="current_price">£60.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product10.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product11.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>

                                <div class="product_sale">
                                    <span>-7%</span>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">Apple iPhone SE 16GB</a></h3>
                                <span class="current_price">£60.00</span>
                                <span class="old_price">£86.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product23.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/product/product24.jpg" alt=""></a>

                                <div class="quick_button">
                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                </div>
                            </div>
                            <div class="product_content">
                                <h3><a href="product-details.html">JBL Flip 3 Portable</a></h3>
                                <span class="current_price">£60.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--product section area end-->