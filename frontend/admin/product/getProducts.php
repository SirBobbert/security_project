<!DOCTYPE html>
<html>

<head>
    <title>All products</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once('api/Class/products.php');
    require_once('api/config/database.php');

    $database = new Database();
    $db = $database->getConnection();
    $items = new Product($db);
    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {

        $productArray = array();
        $productArray["body"] = array();
        $productArray["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $e = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "price" => $row['price'],
                "description" => $row['description']
            );
            array_push($productArray["body"], $e);
        }
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
    ?>

    <div class="container">
        <h1>All products</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productArray["body"] as $post): ?>
                    <tr>
                        <td>
                            <?php echo isset($post['id']) ? $post['id'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['name']) ? $post['name'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['price']) ? $post['price'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['description']) ? $post['description'] : ''; ?>
                        </td>
                        <td><a href="/demo/getProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">See more</a>
                        </td>
                        <td><a href="/demo/editProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">Edit
                                product</a></td>
                        <td>
                            <form method="post"
                                action="/demo/handleDelete/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                <input type="hidden" name="id" value="<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                <input type="submit" value="Delete Product">
                            </form>

                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <a class="btn btn-light" href="/demo/createProduct">
            Create product
        </a>
    </div>

</body>

</html>