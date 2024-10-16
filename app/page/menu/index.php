<?php

// $user_query = mysqli_query($connection, "SELECT * FROM products");
?>

<body>
    <main id="main">
        <section class="section1">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 p-5 top">
                        <div class="row justify-content-center align-items-center">
                            <div class="d-block my-auto p-5 col-12 col-xl-5">
                                <h1>Modern Interior Design Studio</h1>
                                <p>Donec vitea quis here is just for testing our sofa is the best in the world ,malaysia
                                    no.1</p>
                                <button class="m-2 px-4 py-2 button"><strong>Shop now</strong></button>
                                <button class="m-2 px-4 py-2 button"><strong>Explore</strong></button>
                            </div>

                            <div class="col-12 col-xl-7">
                                <div class="m-3 mx-auto" style="animation:bounceInRight 2s">
                                    <img src="../images/section1_img.png" class="img-fluid w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section2">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="m-5 col-12 col-xl-6 col-xxl-5">
                        <div class="d-block p-5  sec2_content" style="animation:bounce 2s">
                            <h1>Want to be member ?</h1><br>
                            <p>With our state-of-the-art content management and delivery system placing content orders
                                has never been faster and easier. You can order content in multiple languages in just
                                few clicks.
                                Furthermore, our professional content writers are ready to finalise your request as
                                fast as possible.
                            </p>
                        </div>
                    </div>
                    <?php
                    if (!isLoggedIn()) {
                        echo '<div class="col-12 col-xl-6 col-xxl-5 d-flex align-content-center justify-content-center">
                        <div class="m-5 p-5 d-block text-center sec2_box">
                            <h1>Premium</h1>
                            <ul>
                                <li>Offer coupons and discounts</li>
                                <li>membership milestones</li>
                                <li>Share valuable content</li>
                                <li>Create an online community</li>
                            </ul>
                            <a href="../account/login"><button
                                    class="m-2 px-4 py-2 sec2_btn"><strong>Login</strong></button></a>
                            <a href="../account/register"><button class="m-2 px-4 py-2 sec2_btn"><strong>Sign
                                        up</strong></button></a>
                        </div>
                    </div>';
                    }
                    ?>

                </div>
            </div>
        </section>


        <section class="section3">
            <div class="container-fluid">
                <div class="row m-2 m-xxl-5 p-0 p-xxl-5 d-flex align-items-center justify-content-center">


                    <div class="col-12 col-xxl-12">
                        <div class="m-5 d-block text-center" style="animation:fadeInUp 3s">
                            <h1>Crafted with excellent material</h1><br>
                            <h5>Donec vitea quis here is just for testing our sofa is the best in the world ,malaysia
                                no.1</h>
                        </div>
                    </div>


                    <div class="my-5 col-12 col-xxl-12">
                        <div class="row">
                            <div class="col-6 col-xl-3 col-xxl-3">
                                <?php
                                     $products = db_select_all('products');
                                    foreach($products as $product){
                                ?>
                                <a href="#" class="chair row1-chair1">
                                    <div class="p-2">
                                        <img src=' . $src . ' class="img-fluid w-100">
                                    </div>
                                    <p class="text-center"><strong><?php $product->name ?></strong></p>
                                    <p class="text-center"><strong><?php $product->price ?></strong></p>
                                </a>
                            </div>
                            <?php
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

<style>
    .section1 {
        background-color: #d9d9e1;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .chair,
    .chair::before {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        transition: all 0.5s ease;
    }

    .chair {
        position: relative;
        border: none;
        animation: fadeInLeftBig 3s;
    }

    .chair::before {
        content: '';
        position: absolute;
        background-color: #d9d9e1;
        opacity: 0;
        transform: translateY(0px);
        z-index: -1;
    }

    .chair:hover::before {
        transform: translateY(20px);
        opacity: 1;
    }

    .sec2_box {
        background-color: #343333;
        color: #d9d9e1;
        max-height: 400px;
        border: solid black 2px;
        border-radius: 20px;
        animation: pulse 2S infinite;
    }

    .sec2_btn {
        background-color: #d9d9e1;
        border-radius: 20px;

    }

    .sec2_btn:hover {
        background-color: #343333;
        color: #d9d9e1;
    }
</style>