<div class="container-fluid d-flex justify-content-center mt-5">
    <form class="col-4" method="post">
        <p class="col-6 text-warning"><?= $_SESSION['message']; ?></p>
        <p><input class="col-4 form-control" name="username" placeholder="Username" type="text"></p>
        <p><input class="col-4 form-control" name="password" placeholder="Password" type="password"></p>
        <p><input class="col-4 btn btn-success" value="Sign in" type="submit"></p>
    </form>
</div>
