<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add To Cart In PHP</title>
    <link rel="stylesheet" src="custom-style.css">
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
}
.header-text{
    text-transform: uppercase;
    font-variant-caps: petite-caps;
    text-align: center;
    color: white !important;
    text-shadow: 0px 0px 3px black;
    font-size: 22px;
    font-weight: 700;
}
.flex-box-set{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    flex-direction: row;
}
.box-card-set{
    width: 300px;
    height: auto;
    margin: 10px;
}
.box-image-set{
    width: 50%;
    height: 50%;
    margin: 10px auto;
    overflow: hidden;
}
.box-image-set-2{
    width: 100px;
    height: 200px;
}
.v-set{
    vertical-align: middle !important;
    text-align: center;
}
    </style>
</head>

<body>
    <div id="header123">
        <?php include_once('header.php'); ?>
    </div>

    <div class="container-fluid">
        <div class="row flex-box-set">
            <?php foreach($product as $product_data){ ?>        
                <div class="card text-center box-card-set">
                    <img src="images/<?php echo $product_data['p_image']; ?>" class="card-img-top box-image-set img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php if(strlen($product_data['p_name']) > 50){ echo substr($product_data['p_name'],0,50).'....'; }else{ echo $product_data['p_name']; } ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">Price : </div>
                                <div class="col-6"><?php echo $product_data['p_amount']; ?></div>
                            </div>
                        </li>
                        <form method="post" class="submitpro">
                        <li class="list-group-item">
                                <div class="form-group row mb-0">
                                    <label for="staticEmail" class="col-6 col-form-label">Quantity : </label>
                                    <div class="col-6">
                                        <input type="number" class="form-control pro-qty" min="1" max="100" value="1" required>
                                    </div>
                                </div>
                            
                        </li>
                        <li class="list-group-item">
                            <button type="submit" class="btn btn-sm bg-danger text-light pc_data" data-dataid="<?php echo $product_data['p_number']; ?>">Add To Cart</button>
                        </li>
                        </form>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    
        $(document).ready(function (){
            $('.submitpro').on('submit', function(e){
                e.preventDefault();
                var product_num = $(this).find('.pc_data').data('dataid');
                var product_qty = $(this).find('.pro-qty').val();
                //alert("product Num = "+product_num+" Product Qty "+product_qty);
                if(product_num == '' || product_qty == ''){
                    alert("Data Key Not Found");
                    console.log("Data Key Not Found");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "ajax/cart-process.php",
                        data: { 'product_num' : product_num, 'product_qty' : product_qty },
                        success: function (response) {
                            var get_val = JSON.parse(response);
                            if(get_val.status == 100){
                                alert(get_val.msg);
                                console.log(get_val.msg);
                                location.reload();
                            }
                            else if(get_val.status == 103){
                                alert(get_val.msg);
                                console.log(get_val.msg);
                            }
                            else{
                                console.log(get_val.msg);
                            }
                        }
                    });
                }
            });
        });
    
    </script>


</body>

</html>