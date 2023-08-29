<!DOCTYPE html>
<html>

<head>
    <title>All orders</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    $dummyPosts = array(
        array(
            'id' => 1,
            'title' => 'Post 1 Title',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'price' => 19.99
        ),
        array(
            'id' => 2,
            'title' => 'Post 2 Title',
            'content' => 'Pellentesque ac ligula in tellus feugiat lacinia.',
            'price' => 29.99
        ),
        array(
            'id' => 3,
            'title' => 'Post 20 Title',
            'content' => 'Vivamus vel tortor in ligula feugiat placerat.',
            'price' => 49.99
        )
    );
    ?>

    <div class="container">
        <h1>All orders</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dummyPosts as $post): ?>
                    <tr>
                        <td>
                            <?php echo $post['id']; ?>
                        </td>
                        <td>
                            <?php echo $post['title']; ?>
                        </td>
                        <td>
                            <?php echo $post['content']; ?>
                        </td>
                        <td><a href="/demo/getOrder/<?php echo $post['id']; ?>">See more</a></td>
                        <td><a href="/demo/editOrder/<?php echo $post['id']; ?>">Edit product</a></td>
                        <td><a href="/demo/deleteOrder/<?php echo $post['id']; ?>">Delete product</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-light" href="/demo/createProduct">
            Create order
        </a>
    </div>

</body>

</html>