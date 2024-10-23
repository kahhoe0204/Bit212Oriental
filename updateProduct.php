<?php
define('URL', 'https://' . $_SERVER['SERVER_NAME'] . '/');
function version($name){
    return(filemtime($_SERVER['DOCUMENT_ROOT'] .$name));
}
$productID = $_GET['productId'];

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
    <link rel="stylesheet" href="/style.css?v=<?php echo version("/style.css");?>">
</head>
<body>
        <nav onclick="window.location = '/home.php'" style="cursor: pointer;" class="text-uppercase container-fluid text-center  text-light py-3 font-weight-bold ">Oriental Kopi</nav>

        <div class="content-details">
            <div class="category text-uppercase">
                Product Details
            </div>
            <div class="productDetails" id="productDetails">

            </div>
            <div class="button" style="display:flex; flex-direction:column; width:150px">
                <button class="update-button" onclick="updateButton()" type="button" >Update Item</button>
                <button class="delete-button" onclick="deleteButton()" type="button" >Delete Item</button>
            </div>
        </div>

        <div class="deleteModalDark" style="display:none;">
            <div class="deletemodal">
                <div class="modal-head">
                    <h4>
                    Are you sure
                    </h4>
                </div>
                <div class="modal-body">
                    Delete product <span id="productNameModal"></span>
                </div>
                <div class="buttonsModal">
                    <button  id="modalCancel">Cancel</button>
                    <button  id="modalDelete">Delete</button>
                </div>
            </div>

        </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        let productName = "";
        let productPrice = "";
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const productID = urlParams.get('productId');


        $(document).ready(function() {
            $.ajaxSetup({
                cache : false
            });

            $.ajax({
                url: '/requests/getProducts.php?id=' + productID, // URL of the PHP script
                method: 'GET',
                success: function(data) {
                    if (!data.error) {
                        // Loop through the products and display them
                            $('#productDetails').append(
                                '<div class="updateProduct flex flex-col" id="'+data.id+'">' +
                                '<img class="productImage" src="' + data.image_path + '" alt="' + data.name + '">' +
                                '<span class="text-pretty truncate" id="productNameLabel">' + data.name + '</span>' +
                                '<span class="text-pretty truncate" id="productPriceLabel">RM' + data.price + '</span>' +
                                '</div>'
                            );
                            productName = data.name;
                            productPrice = data.price;
                            $("#productNameModal").text(data.name);
                    } else {
                        $('#productList').append('<p>' + data.error + '</p>');
                    }
                },
                error: function() {
                    $('#productList').append('<p>Error loading products.</p>');
                }
            });

        });

        function updateButton(){
            $("#productNameLabel").hide();
            $("#productPriceLabel").hide();
            $(".update-button").hide();
            $(".delete-button").hide();
            $('#productDetails .updateProduct').append(
                '<input type="text" id="updateName" name="name" style="margin-block:5px; border-radius:10px; text-align:center;" value="'+productName+'" />' +
                '<input type="number" id="updatePrice" name="price" style="margin-block:5px; border-radius:10px; text-align:center;" value="'+productPrice+'" />'
            )
            
            $(".button").append(
                '<button class="update-button" onclick="saveUpdate()" type="button" >Save</button>'
            )
        }

        function saveUpdate(){
            const newName = $("#updateName").val();
            const newPrice = $("#updatePrice").val();
        
            if (newName === productName && newPrice === productPrice) {
                window.location.reload()
            }else{
                $.ajax({
                url: '/requests/getProducts.php', // URL of the PHP script
                method: 'PUT',
                data: { id: productID, name: newName, price: newPrice },
                success: function(data) {
                    alert("Product Updated Successfully");
                    window.location.reload();
                },
                error: function() {
                    alert('Error in updating products.');
                }
                });
            }
        }

        $(".deleteModalDark").on("click",function(){
            if (!$(event.target).closest('.deletemodal').length) {
                $(".deleteModalDark").hide();
            }
        })

        $("#modalCancel").on("click",function(){
            $(".deleteModalDark").hide();
        })

        function deleteButton(){
            $(".deleteModalDark").show();
        }

        $("#modalDelete").on("click",function(){
            $.ajax({
                url: '/requests/getProducts.php?id=' + productID, // URL of the PHP script
                method: 'DELETE',
                success: function(data) {
                    alert("Product Deleted Successfully");
                    window.location = "/home.php";
                },
                error: function() {
                    alert('Error in deleting products.');
                }
            });
        })
        
    </script>
</body>
</html>
