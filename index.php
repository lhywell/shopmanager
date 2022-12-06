<?php
require("./database.php");

session_start();
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">商品名称</th>
                <th scope="col">商品价格</th>
                <th scope="col">商品数量</th>
                <th scope="col">商品备注</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $db = new DB("product");
            // $conn = $db->getConn();
            $result = $db->query("");
            ?>

            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['pname']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['pcount']; ?></td>
                    <td><?php echo $row['remark']; ?></td>
                    <td>
                        <!-- <button  type="submit" formaction="/shop/edit.php?id=<?php echo $row['id']; ?>">编辑</button> -->
                        <a href="edit.php?id=<?php echo $row['id']; ?>">编辑</a>
                        <a href="del.php?id=<?php echo $row['id']; ?>">删除</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td><a href="" target="_self" rel="noopener noreferrer">删除</a></td>

            </tr> -->
        </tbody>
    </table>
    <div style="text-align:center;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            添加商品
        </button>
    </div>

    <!-- 编辑Modal -->
    <div class="modal fade" id="editModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">编辑商品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="update.php?id=<?php echo $_SESSION['id']; ?>" method="post">
                        <div class="mb-3">
                            <label for="pname" class="form-label">商品名称</label>
                            <input type="text" class="form-control" id="pname" name="pname" value="<?php echo $_SESSION['pname']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">商品价格</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $_SESSION['price']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pcount" class="form-label">商品数量</label>
                            <input type="number" class="form-control" id="pcount" name="pcount" value="<?php echo $_SESSION['pcount']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">商品备注</label>
                            <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $_SESSION['remark']; ?>" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <input type="submit" class="btn btn-primary" value="提交"></input>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- 新增Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">添加商品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="add.php" method="post">
                        <div class="mb-3">
                            <label for="pname" class="form-label">商品名称</label>
                            <input type="text" class="form-control" id="pname" name="pname" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">商品价格</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="pcount" class="form-label">商品数量</label>
                            <input type="number" class="form-control" id="pcount" name="pcount" required>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">商品备注</label>
                            <input type="text" class="form-control" id="remark" name="remark" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <input type="submit" class="btn btn-primary" value="提交"></input>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                }, false)
            })
    })()
</script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('editModel'), {
        keyboard: false
    })
    if (window.location.href.indexOf('#editModel') != -1) {
        myModal.show();
    }
</script>

</html>