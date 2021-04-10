<div class="container-fluid d-flex justify-content-center mt-5">
    <form class="col-4" method="post">
        <p class="col-6 text-warning"><?= $_SESSION['message']; ?></p>
        <p><input class="col-4 form-control" name="username" placeholder="Username" type="text"></p>
        <p><input class="col-4 form-control" name="password" placeholder="Password" type="text"></p>
        <p><input class="col-4 form-control" name="repeatPassword" placeholder="Please, repeat the password" type="text"></p>
        <p><input class="col-4 form-control" name="name" placeholder="Name" type="text"></p>
        <p><input class="col-4 form-control" name="surname" placeholder="Surname" type="text"></p>
        <p><input class="col-4 form-control" name="url" placeholder="Avatar URL" type="text"></p>
        <p><input class="col-4 form-control" type="date" id="date" name="date"/></p>
        <p><input class="col-4 btn btn-success" type="submit" value="Sign up"></p>
    </form>
</div>

