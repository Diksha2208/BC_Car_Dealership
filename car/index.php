<?php
require_once "../Model/dbconfig.php";
require_once "../Model/cars_db.php";
require_once "../Model/cart_model.php";
require_once "../User/user.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    
$user = unserialize($_SESSION['user']); // Unserialize the object
if (is_object($user)) {
    $user_id = $user->id; 
} 



// Get action and category_id from the URL
$action = $_GET['action'] ?? 'list_categories';
$category_id = $_GET['category_id'] ?? 'Sedan';

// Controller logic
switch ($action) {
    case 'list_categories':
        $categories = getCategories($conn);
        $category_name = $category_id;
        $models = getModelsByCategory($conn, $category_id);
        include "../car/car_view.php";
        break;

    case 'list_models':
        $categories = getCategories($conn);
        $category_name = $category_id;
        $models = getModelsByCategory($conn, $category_id);
        include "../car/car_view.php";
        break;

    case 'view_model':
        $categories = getCategories($conn);
        $model_id = $_GET['model_id'] ?? null;
        $model = getModelById($conn, $model_id);
        include "../car/car_view.php";
        break;
    case 'add_to_cart':


        if (!isset($_SESSION['user'])) {
            // Redirect to login page if user is not logged in
            header("Location: ../User/login.php?message=login_required");
            exit;
        }

    
        $car_id = $_POST['car_id'];
        $car_name = $_POST['car_name'];
        $car_price = $_POST['car_price'];
    
        // Build car array
        $car = [
            'id' => $car_id,
            'name' => $car_name,
            'price' => $car_price,
            'details' => []
        ];
    
        // Add the car to the cart
        addToCart($car);
        $cart_items = getCartItems();
        $cart_total = getCartTotal();
        // Redirect to the category or model page
        include "../car/cart_view.php";
        exit;
    
    case 'view_cart':
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $cart_items = getCartItems();
        $cart_total = getCartTotal();
        
        $partdetails = [];
        foreach ($cart_items as $car_id => $item) {
            if (!empty($item['details'])) {
                foreach ($item['details'] as $partID) {
                    $part = fetchpartsdetails($conn, $partID);
                    $partdetails[$part['partName']] = $part['price'];
                }
            }
        }
        include "../car/cart_view.php";
        break;
    
    case 'remove_from_cart':

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $car_id = $_POST['car_id'];
        
        removeFromCart($car_id);
        $cart_items = getCartItems(); 
        $cart_total = getCartTotal();
        
        $partdetails = [];
        foreach ($cart_items as $car_id => $item) {
            if (!empty($item['details'])) {
                foreach ($item['details'] as $partID) {
                    $part = fetchpartsdetails($conn, $partID);
                    $partdetails[$part['partName']] = $part['price'];
                }
            }
        }  
    
        include "../car/cart_view.php";
        exit;
    
    case 'clear_cart':
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        clearCart();
        $cart_items = getCartItems();
        $cart_total = getCartTotal();
        
        $partdetails = [];
        foreach ($cart_items as $car_id => $item) {
            if (!empty($item['details'])) {
                foreach ($item['details'] as $partID) {
                    $part = fetchpartsdetails($conn, $partID);
                    $partdetails[$part['partName']] = $part['price'];
                }
            }
        }
        // Redirect to the category or model page
        include "../car/cart_view.php";
        exit;
    case 'create_order':

        
        $cart_items = getCartItems();
        $cart_total = getCartTotal();       
        if (!empty($cart_items)) {
            try {
                // Start transaction
                $conn->begin_transaction();

                // Add a new order
                $order_id = addOrder($conn, $user_id, $cart_total);

                // Add order items
                addOrderItems($conn, $order_id, $cart_items);



                // Commit the transaction
                $conn->commit();

                // Clear the cart after order creation
                clearCart();

                // Redirect to a confirmation page
                header("Location: ?action=order_confirmation");
                exit;
            } catch (Exception $e) {
                // Rollback transaction in case of an error
                $conn->rollback();
                echo "Error creating order: " . $e->getMessage();
            }
        } else {
            echo "Cart is empty. Cannot create an order.";
        }
        break;
    case 'view_past_orders':
        
        $past_orders = getPastOrders($conn, $user_id);

        include "../car/past_orders_view.php";
        break;
    case 'order_confirmation':
        include "../car/order_confirmation.php";
        break;  

    case 'view_build_car':
        $parts = [];
        $steps = [
            'Chassis', 'Body and Exterior', 'Engine System', 'Drivetrain',
            'Electrical System', 'Suspension System', 'Steering System',
            'Brake System', 'Fuel System', 'Exhaust System', 'Interior Components', 'Wheels and Tires'
        ];

        foreach ($steps as $step) {
            $parts[$step] = fetchPartsByType($conn, $step); // Fetch parts by step type
        }
        include "../car/build_car.php"; // Build car page
        break;
    case 'add_to_cart_build':

        if (!isset($_SESSION['user'])) {
            // Redirect to login page if user is not logged in
            header("Location: ../User/login.php?message=login_required");
            exit;
        }
    
        $selected_parts = $_POST['parts'];

        // Validate all steps
        foreach ($selected_parts as $step => $partID) {
            if (empty($partID)) {
                $error_message = "Please select an option for '$step'.";
                include "../car/build_car_view.php";
                exit;
            }
        }

        // Calculate total price
        $total_price = calculateBuildPrice($conn, $selected_parts);

        // Generate a unique name for the custom build (e.g., "Custom Car #1")
        $custom_car_name = "Custom Build - " . date("Y-m-d H:i:s");

        // Build the custom car array
        $custom_car = [
            'id' => '1', // Generate a unique ID for the custom build
            'name' => $custom_car_name,
            'price' => $total_price,
            'details' => $selected_parts // Store selected parts as details
        ];

        // Add the custom car to the cart
        addToCart($custom_car);




        // Fetch updated cart items and total
        $cart_items = getCartItems();
        $cart_total = getCartTotal();

        $partdetails = [];
        foreach ($cart_items as $car_id => $item) {
            if (!empty($item['details'])) {
                foreach ($item['details'] as $partID) {
                    $part = fetchpartsdetails($conn, $partID);
                    $partdetails[$part['partName']] = $part['price'];
                }
            }
        }

        // Redirect to cart view
        include "../car/cart_view.php";

        break;
    
    default:
        $categories = getCategories($conn);
        include "../car/car_view.php";
        break;
}
?>