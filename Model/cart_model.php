<?php

// Add a car to the cart
function addToCart($car) {

    if (empty($_SESSION['cart'])) $_SESSION['cart'] = array();


    // Check if the car is already in the cart
    if (isset($_SESSION['cart'][$car['id']])) {
        $_SESSION['cart'][$car['id']]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$car['id']] = [
            'name' => $car['name'],
            'price' => $car['price'],
            'quantity' => 1,
            'details' => $car['details'] ?? []
        ];
    }
}

// Get all items in the cart
function getCartItems() {
    return $_SESSION['cart'] ?? [];
}

// Remove an item from the cart
function removeFromCart($carId) {

        unset($_SESSION['cart'][$carId]);
    
}

// Clear the cart
function clearCart() {
    unset($_SESSION['cart']);
}

// Calculate the total price
function getCartTotal() {
    $total = 0;
    foreach (getCartItems() as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
function getPastOrders($conn, $user_id) {
    $sql = "SELECT 
                o.orderID,
                o.total as total,
                o.created_at,
                oi.productID,
                c.Model AS product_name,
                oi.price AS product_price,
                oi.quantity
            FROM 
                orders o
            JOIN 
                order_items oi ON o.orderID = oi.orderID
            JOIN 
                car_model_list c ON oi.productID = c.id
            WHERE 
                o.userID = ?
            ORDER BY 
                o.created_at DESC, o.orderID ASC";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $orders;
    } else {
        echo "Error preparing query: " . $conn->error;
        return [];
    }
}

function addOrder($conn, $user_id, $total) {
    $sql = "INSERT INTO orders (userID, total) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("id", $user_id, $total);
        $stmt->execute();
        $order_id = $conn->insert_id;
        $stmt->close();
        return $order_id;
    } else {
        throw new Exception("Error adding order: " . $conn->error);
    }
}

// Add order items for a given order
function addOrderItems($conn, $order_id, $cart_items) {
    $sql = "INSERT INTO order_items (orderID, productID, price, quantity) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        foreach ($cart_items as $product_id => $item) {
            $price = $item['price'];
            $quantity = $item['quantity'];
            $stmt->bind_param("iidi", $order_id, $product_id, $price, $quantity);
            $stmt->execute();
        }
        $stmt->close();
    } else {
        throw new Exception("Error adding order items: " . $conn->error);
    }
}

function addCustomOrder($conn, $order_id, $selected_parts, $total_price) {
    $sql = "INSERT INTO custom_orders (orderID, parts, total_price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $parts_json = json_encode($selected_parts);
    $stmt->bind_param("isd", $order_id, $parts_json, $total_price);
    $stmt->execute();
    $custom_order_id = $stmt->insert_id; 
    $stmt->close();
    return $custom_order_id;
}



function calculateBuildPrice($conn, $selected_parts) {
    $total_price = 0;
    foreach ($selected_parts as $partID) {
        $sql = "SELECT price FROM parts WHERE partID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $partID);
            $stmt->execute();
            $stmt->bind_result($price);
            $stmt->fetch();
            $total_price += $price;
            $stmt->close();
        }
    }
    return $total_price;
}


?>
