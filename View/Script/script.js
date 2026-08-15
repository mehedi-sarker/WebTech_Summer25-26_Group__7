var quantity = 1;


/*==========================================
          PRODUCT DETAILS PAGE
==========================================*/

function increaseQuantity()
{
    quantity++;

    document.getElementById("quantity").value =
        quantity;

    calculateTotal();
}


function decreaseQuantity()
{
    if(quantity > 1)
    {
        quantity--;

        document.getElementById("quantity").value =
            quantity;

        calculateTotal();
    }
}


function calculateTotal()
{
    var total =
        price * quantity;

    document.getElementById("totalPrice").innerHTML =
        total;
}


/*==========================================
                CART PAGE
==========================================*/

function calculateGrandTotal()
{
    var delivery = 0;


    var inside =
        document.querySelector(
            'input[name="delivery_area"][value="Inside Dhaka"]'
        );


    var outside =
        document.querySelector(
            'input[name="delivery_area"][value="Outside Dhaka"]'
        );


    if(inside && inside.checked)
    {
        delivery = 80;
    }


    else if(outside && outside.checked)
    {
        delivery = 130;
    }


    document.getElementById("deliveryCharge").innerHTML =
        delivery;


    var grandTotal =
        subtotal + delivery;


    document.getElementById("grandTotal").innerHTML =
        grandTotal;
}


/*==========================================
                PAGE LOAD
==========================================*/

window.onload = function()
{

    var inside =
        document.querySelector(
            'input[name="delivery_area"][value="Inside Dhaka"]'
        );


    var outside =
        document.querySelector(
            'input[name="delivery_area"][value="Outside Dhaka"]'
        );


    if(inside)
    {
        inside.addEventListener(
            "change",
            calculateGrandTotal
        );
    }


    if(outside)
    {
        outside.addEventListener(
            "change",
            calculateGrandTotal
        );
    }

};