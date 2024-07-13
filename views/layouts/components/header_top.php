<div class="header_top">
            <div class="container-fluid">   
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-12">
                        <div class="welcome_text">
                           <ul>
                               <li><span>Free Delivery:</span> Take advantage of our time to save event</li>
                               <li><span>Free Returns *</span> Satisfaction guaranteed</li>
                           </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="top_right text-right">
                            <ul>
                                <?php if(!empty($_SESSION['user'])): ?>
                                    <li class="top_links"><a href="#"><?=$_SESSION['user']['fullname'] ?> <i class="ion-chevron-down"></i></a>
                                    <?php else: ?>
                               <li class="top_links"><a href="#">My Account <i class="ion-chevron-down"></i></a>
                               <?php endif ?>
                                    <ul class="dropdown_links">
                                        <li><a href="wishlist.html">My Wish List </a></li>
                                        <li><a href="my-account.html">My Account </a></li>
                                        <li><a href="#">Sign In</a></li>
                                        <li><a href="compare.html">Compare Products  </a></li>
                                    </ul>
                                </li> 
                            </ul>
                        </div>   
                    </div>
                </div>
            </div>
        </div>