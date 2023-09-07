<!DOCTYPE html>
<html>

<head>
    <title>Create Product</title>
</head>

<body>
    <form method="post" action="/demo/handleCreateProduct">
        <input type="text" name="productName" placeholder="Product Name" required>
        <input type="number" name="productPrice" step="0.01" placeholder="Price" required>
        <textarea name="productDescription" placeholder="Description" required></textarea>
        <button type="submit">Create Product</button>
    </form>
</body>

</html>