<!DOCTYPE html>
<html>
    <head>
        <title> Delivery Dashboard </title>
        <link rel="stylesheet" href="delivery.css">
    </head>
    <body>
 
        <div class="delivery-container">
 
            <h2> Welcome, Karim (Delivery Man) </h2>
 
            <p class="success-msg"> Order #101 marked as Shipped successfully! </p>
 
            <form action="" class="tab-buttons">
                <input type="submit" name="view" value="Pending Orders">
                <input type="submit" name="view" value="Shipped Orders">
                <input type="submit" name="view" value="Delivered Orders">
            </form>
 
            <h3> Showing: Pending Orders </h3>
 
            <table class="delivery-table">
                <tr>
                    <th class="col-id"> Order ID </th>
                    <th class="col-name"> Customer Name </th>
                    <th class="col-address"> Address </th>
                    <th class="col-phone"> Phone </th>
                    <th class="col-items"> Items </th>
                    <th class="col-status"> Status </th>
                    <th class="col-action"> Action </th>
                </tr>
                <tr>
                    <td> 101 </td>
                    <td> Reve Kabir </td>
                    <td> House 12, Road 5, Dhanmondi </td>
                    <td> 01711-000000 </td>
                    <td> Barcelona Home Jersey (L) </td>
                    <td class="status-pending"> Pending </td>
                    <td>
                        <form action="">
                            <input type="hidden" name="order_id" value="101">
                            <input type="hidden" name="delivery_status" value="Shipped">
                            <input type="submit" name="update_status" value="Mark as Shipped">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td> 102 </td>
                    <td> Sadia Rahman </td>
                    <td> Mirpur 10 </td>
                    <td> 01755-333333 </td>
                    <td> Man United Jersey (M) </td>
                    <td class="status-pending"> Pending </td>
                    <td>
                        <form action="">
                            <input type="hidden" name="order_id" value="102">
                            <input type="hidden" name="delivery_status" value="Shipped">
                            <input type="submit" name="update_status" value="Mark as Shipped">
                        </form>
                    </td>
                </tr>
            </table>
 
            <br>
            <a href="#"> Logout </a>
 
        </div>
 
    </body>
</html>