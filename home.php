<?php
define('URL', 'https://' . $_SERVER['SERVER_NAME'] . '/');
function version($name){
    return(filemtime($_SERVER['DOCUMENT_ROOT'] . '/assests/css/'.$name));
}
// $version($name) = filemtime($_SERVER['DOCUMENT_ROOT'] . '/AncientCity/assests/css/'.$name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oriental Kopi</title>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css?v=<?php echo version("style.css");?>">
</head>
<body>
    
    <nav class="text-uppercase container-fluid text-center  text-light py-3 font-weight-bold ">Oriental Kopi</nav>
    <div class="category text-uppercase">
        Signature menu
    </div>
    <div class="container-fluid">
        <div class="grid grid-col-4" id="productList">

        </div>
    </div>

    <div class="button">
        <button class="add-button">Add New Item</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
       $(document).ready(function() {
            // Fetch products using AJAX
            $.ajax({
                url: '/requests/getProducts.php', // URL of the PHP script
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    if (!data.error) {
                        // Loop through the products and display them
                        data.forEach(function(product) {
                            $('#productList').append(
                                
                                '<div class="product flex flex-col" id="'+product.id+'">' +
                                '<img class="productImage" src="' + product.image_path + '" alt="' + product.name + '">' +
                                '<span class="text-pretty truncate">' + product.name + '</span>' +
                                '</div>'
                            );
                        });
                    } else {
                        $('#productList').append('<p>' + data.error + '</p>');
                    }
                },
                error: function() {
                    $('#productList').append('<p>Error loading products.</p>');
                }
            });
        });
    </script>
</body>
</html>
