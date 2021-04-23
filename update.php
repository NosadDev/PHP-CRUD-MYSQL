<?php
require './template/header.php';
$action = null;
if (isset($_GET['id'])) {
    require './connection.php';
}
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sql = "UPDATE person SET firstname='$firstname',lastname='$lastname' WHERE id='$id'";
    $query = $con->query($sql);
    if (!$query) {
        echo "Error " . $con->error;
    } elseif ($query === true) {
        $_SESSION['action'] = 'Update PersonID:<b>' . $_GET['id'] . '</b> Successfully';
        $_SESSION['display'] = 1;
        return header('Location:./');
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM person WHERE id='$id' LIMIT 1";
    $query = $con->query($sql);
    if (!$query) {
        echo "Error " . $con->error;
    } else {
        $result = $query->fetch_assoc();
    }
}

?>

<div class="col-md-3"></div>
<div class="col-md-6">
    <h4 class="text-center mb-3">Update<a href="index.php" class="float-end btn btn-secondary">Back</a></h4>
    <form action="?id=<?= $_GET['id'] ?>" method="post">
        <div class="form-goup mb-2">
            <label for="firstname">firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="60" value="<?= $result['firstname'] ?>" required>
        </div>
        <div class="form-goup mb-2">
            <label for="lastname">lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" maxlength="60" value="<?= $result['lastname'] ?>" required>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
<div class="col-md-3"></div>

<?php

require './template/footer.php';
?>