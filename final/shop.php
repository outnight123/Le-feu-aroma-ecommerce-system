<?php require 'functions.php';
include 'header.php';
    $sort = "ASC";
    $column = "id";

    if (isset($_GET['column']) && isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $column = $_GET['column'];

        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
    }

    $queryProducts = "SELECT * FROM products ORDER BY $column $sort";
    $sqlProducts = mysqli_query($db, $queryProducts); ?>
        <!--Shop-->
        <section id="shop">
            <div class="page-wrapper">
                <div class="post-slider">
                    <h2>Viewing</h2>
                    <h3>All Scented Candles</h3>
                    <i class="fa fa-angle-right prev"></i>
                    <i class="fa fa-angle-left next"></i>
                    <div class="post-wrapper">
                     <?php while($results = mysqli_fetch_array($sqlProducts)) { ?> 
                        <div class="post">
                            <div class="post-info">
                                <img src="uploads/<?php echo $results['image']; ?>" style="width: 200px;" class="slider-img" />
                                <p class="name"><?php echo $results['productname']?></p>
                                <p class="size"><?php echo $results['size']?></p>
                                <p class="price"><?php echo $results['price']?></p>
                                <?php  if (isset($_SESSION['user_id'])): ?>
                                <a href="user-cart.php?id=<?php echo $results['id']?>&quantity=1" class="btn">Add to cart</a>
                                <?php else:?>
                                    <a href="cart.php?id=<?php echo $results['id']?>&quantity=1" class="btn">Add to cart</a>
                                <?php endif?>
                            </div>
                        </div>
                      <?php } ?>
                </div>
            </div>
        </section>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
        <script>
        $(document).ready(function(){
              $(".post-wrapper").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                nextArrow: $(".next"),
                prevArrow: $(".prev"),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
    <!--Footer-->
<?php include'footer.php';?>