<?php
require './template/header.php';
require './connection.php';
$action = null;
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM person WHERE id='$id'";
    $query = $con->query($sql);
    if (!$query) {
        echo "Error " . $con->error;
    } else {
        $_SESSION['action'] = "Delete PersonID:<b>" . $_GET['id'] . "</b> Successfully";
        $_SESSION['display'] = 1;
        return header('Location:./');
    }
}
?>

<div class="col-md-3"></div>
<div class="col-md-6">
    <h4 class="text-center mb-3">PHP CRUD MYSQL<a href="create.php" class="float-end btn btn-success">Create</a></h4>
    <?php
    if (isset($_SESSION['action'])) {
        echo '<div style="display:none"id="action"class="alert alert-success">' . $_SESSION['action'] . '</div>';
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $con->query("SELECT * FROM person");
            if (!$query) {
                echo "Error " . $con->error;
            } elseif ($query->num_rows >= 1) {
                foreach ($query->fetch_all(MYSQLI_ASSOC) as $key => $value) {
            ?>
                    <tr>
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['firstname'] ?></td>
                        <td><?= $value['lastname'] ?></td>
                        <td>
                            <a href="update.php?id=<?= $value['id'] ?>" class="btn btn-warning">Update</a>
                            <a href="?action=delete&id=<?= $value['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="text-center text-info">not found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="col-md-3"></div>

<?php
require './template/footer.php';
?>