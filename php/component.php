<?php

// initializing a function to display a table of the products when ever called in the document
function component($productname, $productprice, $productimg, $productid){
    // using a here doc to save html string in a variable and print it out later
    $element =  <<<_list
    <form action="" method="post">
        <div class="card" style="width: 18rem; border: none; padding-left:13%;">
            <img class="card-img-top" src=$productimg  alt="Card image cap" width="9000px" height="350px">
            <div class="card-body">
            <h6 class="card-title" style="text-align:center">$productprice</h6>
            <h5 class="card-title" style="text-align:center">$productname</h5>
            <button id="btn$productid" type="submit" class="btn btn-warning my-3" name="add" onclick="addToCart('$productid', this.id)">Add to Cart <i class="fas fa-shopping-cart"></i></button>
            <input type='hidden' name='product_id' value='$productid'>
            </div>
        </div>
    </form>
    _list;
    //printing the here doc
    echo $element;
}
// initializing a function call to display the cart elements.
function cartElement($productimg, $productname, $productprice, $productid){
    //using a heredoc to print to store the cart display.
    $element = "
    
    <form action=\"cart.php\" method=\"POST\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid product-image\" data-id=\"$productid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: Akua's Mart</small>
                                <h5 class=\"pt-2\">₵$productprice</h5>
								<input type=\"hidden\" name=\"product_id\" value=\"$productid\" />
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\" id=\"remove-btn$productid\">Remove</button>
                            </div>
                            <div class=\"qty col-md-3 py-5\">
                                <div class=\"text-center\">
                                    <button name=\"minus-btn\" id = \"minus-btn\" type=\"button\" class=\"btn minus-btn disabled bg-light border rounded-circle qty-down\" onclick=\"decrementValue('quantity$productid', 'price$productid', '$productprice')\"><i class=\"fas fa-minus\"></i></button>
                                    <input class=\"quantity-box\" data-id=\"$productid\" style=\"font-size: 12px;\" id = \"quantity$productid\" type=\"text\" value=\"1\" class=\"text-center form-control w-25 d-inline \">
                                    <button name\"plus-btn\"  id = \"plus-btn\" type=\"button\" class=\"btn plus-btn disabled bg-light border rounded-circle qty-up\" onclick=\"incrementValue('quantity$productid', 'price$productid', '$productprice')\"><i class=\"fas fa-plus\"></i></button>
                                    <p class=\"total-price\">
                                    <span><i class=\"fa fa-cedi\"></i></span>
                                    <span style=\"font-size: 12px;\">Computed Price: ₵<span class=\"price-container\" id=\"price$productid\">$productprice</span></span>
                                </p>
                                </div>
                            </div>
                         </div>
                    </div>
                </form>
    <script type=\"text/javascript\" src=\"cart.js\"></script>
    
    ";
    // print out the here doc
    echo  $element;
}
?>

















