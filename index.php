<?php include("db.php"); ?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                session_unset();
            }
            ?>

            <div class="card text-white bg-dark card-body">
                <form action="save_task.php" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="title" class="form-control text-white bg-dark" placeholder="Title" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="description" class="form-control text-white bg-dark" placeholder="Description" rows="2"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" name="save_task" class="btn btn-success btn-block" value="Save Task">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-borderless table-dark">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM task";

                    $result_tasks = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['createdAt'] ?></td>
                            <td style="text-align: center;">
                                <a href="edit_task.php?id=<?= $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>