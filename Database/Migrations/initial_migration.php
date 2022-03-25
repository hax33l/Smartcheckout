<?php

require_once "Database\db_credentials.php";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully \n";

$sql = "CREATE DATABASE $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($db_name);

$sql_create_table_queries = [
    "Users" => "CREATE TABLE Users (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(16) NOT NULL,
        email VARCHAR(254) NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        country VARCHAR(50) NOT NULL,
        city VARCHAR(50) NOT NULL,
        address VARCHAR(50) NOT NULL,
        postal_code VARCHAR(11) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
    )",
    "Products" => "CREATE TABLE Products (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description VARCHAR(255),
        image VARCHAR(255),
        price NUMERIC(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
    )",
    "Shipping" => "CREATE TABLE Shipping (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255),
        price NUMERIC(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
    )",
    "Payment" => "CREATE TABLE Payment (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
    )",
    "Shipping_Payment" => "CREATE TABLE Shipping_Payment (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        shipping_id INT(10) UNSIGNED NOT NULL,
        payment_id INT(10) UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (shipping_id) REFERENCES Shipping(id),
        FOREIGN KEY (payment_id) REFERENCES Payment(id)
    )",
    "Orders" => "CREATE TABLE Orders (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(254) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        billing_country VARCHAR(50) NOT NULL,
        billing_city VARCHAR(50) NOT NULL,
        billing_address VARCHAR(50) NOT NULL,
        billing_postal_code VARCHAR(11) NOT NULL,
        shipping_country VARCHAR(50) NOT NULL,
        shipping_city VARCHAR(50) NOT NULL,
        shipping_address VARCHAR(50) NOT NULL,
        shipping_postal_code VARCHAR(11) NOT NULL,
        comment VARCHAR(255),
        shipping_id INT(10) UNSIGNED NOT NULL,
        payment_id INT(10) UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (shipping_id) REFERENCES Shipping(id),
        FOREIGN KEY (payment_id) REFERENCES Payment(id)
    )",
    "Order_product" => "CREATE TABLE Order_product (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        order_id INT(10) UNSIGNED NOT NULL,
        product_id INT(10) UNSIGNED NOT NULL,
        quantity INT(10) UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES Orders(id),
        FOREIGN KEY (product_id) REFERENCES Products(id)
    )",
    "Newsletter" => "CREATE TABLE Newsletter (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(254) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
    )",
    "User_order" => "CREATE TABLE User_order (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(10) UNSIGNED NOT NULL,
        order_id INT(10) UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES Users(id),
        FOREIGN KEY (order_id) REFERENCES Orders(id)
    )",
];

$sql_default_insert_queries = [
    "INSERT INTO shipping (name, image, price) VALUES ('Paczkomaty 24/7','Assets/Shipping/Paczkomaty.jpg','10.99')",
    "INSERT INTO shipping (name, image, price) VALUES ('Kurier DPD','Assets/Shipping/Dpd.jpg','18.00')",
    "INSERT INTO shipping (name, image, price) VALUES ('Kurier DPD pobranie','Assets/Shipping/Dpd.jpg','22.00')",
    "INSERT INTO payment (name, image) VALUES ('PayU','Assets/Payment/PayU.jpg')",
    "INSERT INTO payment (name, image) VALUES ('Płatność przy odbiorze','Assets/Payment/Odbior.jpg')",
    "INSERT INTO payment (name, image) VALUES ('Przelew bankowy - zwykły','Assets/Payment/Przelew.jpg')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('1','1')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('1','2')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('1','3')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('2','1')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('2','3')",
    "INSERT INTO shipping_payment (shipping_id, payment_id) VALUES ('3','2')",
    "INSERT INTO products (name, description, image, price) VALUES ('Testowy produkt','Testowy opis','Assets/Product/TestowyProdukt.jpg','115.00')",
];

foreach($sql_create_table_queries as $tableName => $sql_query){
    if ($conn->query($sql_query) === TRUE) {
        echo "Table '$tableName' created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }
}

foreach($sql_default_insert_queries as $sql_query){
    if ($conn->query($sql_query) === TRUE) {
        echo "Insert successful\n";
    } else {
        echo "Insert failed: " . $conn->error . "\n";
    }
}

$conn->close();
