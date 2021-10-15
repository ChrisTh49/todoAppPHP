<?php include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM task WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "UPDATE task set title = '$title', description = '$description' WHERE id = $id";

    mysqli_query($conn, $query);

    $_SESSION['message'] = "Task updated!";
    $_SESSION['message_type'] = "info";

    header('Location: index.php');
}

?>

<?php include('includes/header.php'); ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card text-white bg-dark card-body">
                <form action="edit_task.php?id=<?= $_GET['id'] ?>" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="title" value="<?= $title ?>" class="form-control text-white bg-dark" placeholder="Update title">
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="description" rows="2" class="form-control text-white bg-dark" placeholder="Update Description"><?= $description ?></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success" name="update">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>