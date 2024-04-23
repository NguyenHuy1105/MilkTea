<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm Soda</title>
</head>
<body>
    <div style="margin-left: 5px;">
        <div class="container-content-list-product">
            <div class="list-product-all-item">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "z9milktea";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Kết nối không thành công: " . $conn->connect_error);
                }

                $sql = "SELECT products.*, product_sizes.product_price
                        FROM products
                        INNER JOIN product_sizes ON products.product_id = product_sizes.product_id
                        WHERE products.category_id IN (SELECT category_id FROM categorys WHERE category_name = 'Soda')";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product-item">';
                        echo '<a href="show-detail.php?product_id=' . $row['product_id'] . '" class="container-img">';
                        echo "<img class='product-img' src='admin/productAD/uploads/" . htmlspecialchars($row['product_img']) . "' alt='Image of " . htmlspecialchars($row["product_name"]) . "'>";
                        echo '</a>';
                        echo '<p class="product-name">' . $row['product_name'] . '</p>';
                        echo '<div class="product-des">' . $row['product_des'] . '</div>';

                        echo '<div class="product-price">' . $row['product_price'] . '</div>';
                        echo '<div class="action-add">';
                        echo '<button type="submit" class="add-to-cart">';
                        echo '<i class="fa-solid fa-cart-shopping"></i>';
                        echo '</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Không có sản phẩm Soda.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
