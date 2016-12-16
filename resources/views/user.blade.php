<!DOCTYPE html>

    <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
       
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/mycss.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/custom-styles.css">
        <link rel="stylesheet" href="css/component.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/font-awesome-ie7.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
       


            <div class="wrap-bg">
                <div class="site-header">
                    <div class="logo">
                        <h1>Product</h1>
                    </div>
                </div>
                <div class="container">
                <div class="banner">
                    <div class="carousel slide" id="myCarousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="item">
                                            <img src="img/car.png" alt="">
                                            <div class="carousel-caption">
                                              
                                              <div class="social-icons">
                                                <ul>
                                                    <li><a href="#"><i class="fw-icon-facebook icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-twitter icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-google-plus icon"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="item active">
                                            <img src="img/car.png" alt="">
                                            <div class="carousel-caption">
                                              
                                              <div class="social-icons">
                                                <ul>
                                                    <li><a href="#"><i class="fw-icon-facebook icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-twitter icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-google-plus icon"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img src="img/car.png" alt="">
                                            <div class="carousel-caption">
                                              
                                              <div class="social-icons">
                                                <ul>
                                                    <li><a href="#"><i class="fw-icon-facebook icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-twitter icon"></i></a></li>
                                                    <li><a href="#"><i class="fw-icon-google-plus icon"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <!-- Carousel nav -->
                                    <a data-slide="prev" href="#myCarousel" class="carousel-control left"><i class="fw-icon-chevron-left"></i></a>
                                    <a data-slide="next" href="#myCarousel" class="carousel-control right"><i class="fw-icon-chevron-right"></i></a>
                                </div>
                </div>
                </div>
            </div>
            <div class="menu">
                <div class="navbar">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="fw-icon-th-list"></i>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active border-left"><a href="home">Home</a></li>
                            <li><a href="email">email</a></li>
                            <li><a href="///">///</a></li>
                            <li><a href="///">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
                <div class="mini-menu">
            <label>
          <select class="selectnav">
            <option value="#" selected="">Home</option>
            <option value="#">About</option>
            <option value="#">→ Another action</option>
            <option value="#">→ Something else here</option>
            <option value="#">→ Another action</option>
            <option value="#">→ Something else here</option>
            <option value="#">Work</option>
            <option value="#">Contact</option>
          </select>
          </label>
          </div>
            </div>
            <div class="container bg-light-gray">
              <div class="main-content">
                <div class="featured-heading">
                    <h1>Sed egestas ante et vulputate</h1>
                    <h2>semper est vitae luctus metus libero eu augue Morbi purus libero</h2>
                </div>
                <div class="ruler"></div>
                <div class="featured-blocks , table-responsive  ">
                   <table class="table table-hover , table table-striped , table table-bordered , denger " style='margin:0 auto;'>
                    <?php foreach ($product as $result): ?>   
                        <tr id=<?php echo $result->id;?> style='margin:10px;'>
                            <td contenteditable> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $result->name_product;?> &nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td contenteditable> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $result->price;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td >
                            <img src='img/<?php echo $result->image_name;?>' style='max-height: 150px;max-width: 150px'>
                            </td>
                            <td><input type="button" value="Delete" class="btn btn-default btn-lg delete_product" ></td>
                            <td><input type="button" value="Update" class="update" ></td>
                        </tr>
                    <?php endforeach ?>
                </table>

                   {!! $product->links() !!} 
                </div>
                <div class="ruler"></div>
                <div class="tabs">
                    <ul id="myTabContent" class="nav nav-tabs">
                      <li class="active"><a href="#vestibuluco" data-toggle="tab">Lexus</a></li>
                      <li class=""><a href="#fuscelobin" data-toggle="tab">BMW</a></li>
                      <li class=""><a href="#praesentplac" data-toggle="tab">Mercedes</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade active in" id="vestibuluco">
                                <div class="media">
                                  <img src="img/img1.jpg" class="spacing-r" alt="">
                                  <div class="media-body">
                                    <h1 class="media-heading ruler-bottom">Integer vitae libero ac risus</h1>
                                    <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede</p>
                                    <div class="readmore">
                                  <a href="#">Read more <i class="fw-icon-chevron-right"></i> </a>
                                  </div>
                                  </div>
                                </div>
                                
                        </div>
                        <div class="tab-pane fade" id="fuscelobin">
                                <div class="media">
                                  <img src="img/img1.jpg" class="spacing-r" alt="">
                                  <div class="media-body">
                                    <h1 class="media-heading ruler-bottom">Nunc tellus ante mattis eget</h1>
                                    <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede</p>
                                    <div class="readmore">
                                  <a href="#">Readmore <i class="fw-icon-chevron-right"></i> </a>
                                  </div>
                                  </div>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="praesentplac">
                                <div class="media">
                                  <img src="img/merc.jpg" width='650px' class="spacing-r" alt="">
                                  <div class="media-body">
                                    <h1 class="media-heading ruler-bottom">Mercedes-Benz</h1>
                                    <p>Mercedes-Benz traces its origins to Karl Benz's creation of the first petrol-powered car, the Benz Patent Motorwagen, financed by Bertha Benz[2] and patented in January 1886,[3] and Gottlieb Daimler and engineer Wilhelm Maybach's conversion of a stagecoach by the addition of a petrol engine later that year. The Mercedes automobile was first marketed in 1901 by  </p>
                                    <div class="readmore">
                                  <a href="#">Read more <i class="fw-icon-chevron-right"></i> </a>
                                  </div>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
              <div class="featured-content">
                  <div class="row-fluid">
                      <div class="span4">
                          <div class="block">
                              <div class="block-title">
                                  <h1>Morbi interdum </h1>
                              </div>
                              <div class="block-content">
                                  <p>Suspendisse mauris. Fusce accumsan mollis eros. Pellentesque a diam sit amet mi ullamcorper ehicula. Integer adipiscing risus a sem</p>
                                  <ul>
                                      <li><i class="fw-icon-check"></i>Fusce accumsan mollis eros lorem </li>
                                      <li><i class="fw-icon-check"></i>Pellentesque a diam sit amet mi ullam</li>
                                      <li><i class="fw-icon-check"></i>Vehicula teger adipiscing risus a sem</li>
                                      <li><i class="fw-icon-check"></i>Nunc tellus mattis eget gravida vitad</li>
                                  </ul>
                                  <a href="#">read more <i class="fw-icon-chevron-right"></i></a>
                              </div>
                          </div>
                      </div>
                      <div class="span4">
                          <div class="block">
                              <div class="block-title">
                                  <h1>Morbi interdum </h1>
                              </div>
                              <div class="block-content">
                                  <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis.</p>
                                  <p>Libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in.</p>
                                  <p>Acinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante.</p>
                                  <a href="#">read more <i class="fw-icon-chevron-right"></i></a>
                              </div>
                          </div>
                      </div>
                      <div class="span4">
                          <div class="block">
                              <div class="block-title">
                                  <h1>Morbi interdum </h1>
                              </div>
                              <div class="block-content">
                                  <p>Morbi interdum mollis sapien. Sed ac risus</p>
                                  <div class="row-fluid">
                                    <ul class="gallery">
                                      <li>
                                        <a href="#" >
                                          <img src="img/img2.jpg" alt="">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <img src="img/img3.jpg" alt="">                 
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                         <img src="img/img4.jpg" alt="">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <img src="img/img5.jpg" alt="">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#" >
                                          <img src="img/img6.jpg" alt="">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <img src="img/img7.jpg" alt="">                 
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                         <img src="img/img8.jpg" alt="">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <img src="img/img9.jpg" alt="">
                                        </a>
                                      </li>
                                    </ul>
                                </div>
                                  <a href="#">read more <i class="fw-icon-chevron-right"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
             
        </div>
        </div>
        <div class="site-footer">
            <div class="container">
            <div class="row-fluid">
                <div class="span8 offset2">
            <div class="copy-rights">
                Copyright (c) websitename. All rights reserved. 
            </div>
            </div>
            </div>
            </div>
            <div class="site-content">
            <p class="last">Designed By: <a href="http://www.alltemplateneeds.com">www.alltemplateneeds.com</a></p>
                Images from: <a href="http://www.wallcoo.net">www.wallcoo.net</a>
            </div>
        </div>                  

        <!-- /container -->

       <script src="js/jquery-1.9.1.js"></script> 
<script src="js/bootstrap.js"></script>
    </body>
</html>







 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $('document').ready(function(){ 
        $('.delete_product').click(function(){
            var product_id = $(this).parent().parent().attr('id');
            $.ajax({            
                type:'get',
                url:'delete',
                data:{product_id:product_id },
                success:function(dm){
                    location.reload()
                }
            })
        })
        $('.update').click(function(){
            var product_id = $(this).parent().parent().attr('id');
            var name_product = $(this).parent().parent().children().eq(0).text();
            var price_product = $(this).parent().parent().children().eq(1).text();
            $.ajax({            
                type:'get',
                url:'update',
                data:{
                    product_id:product_id, 
                    name_product:name_product, 
                    price_product:price_product 
                },
                success:function(dm){                    location.reload()
                }
            })
        })
    })
</script>
