<?php if (!$_SESSION['user'] ?? null): ?>
    <div class="container-fluid d-flex justify-content-center mt-5 text-white">
        <div>
            <h5 class="text-danger">Sorry, but you can't view this page before login!</h5>
            <p><a class="text-decoration-none text-danger" href="/signup">Login</a></p>
        </div>
    </div>
<?php else: ?>
    <div class="container-fluid d-flex justify-content-center mt-5 text-white">
        <div>
            <label>Profile:</label>
            <img class="rounded-circle img-thumbnail" width="50" height="50" src="<?= $_SESSION['user']['avatar']; ?>"
                 alt="">
        </div>
        <div>
            <ul>
                <li>Nickname: <?= $_SESSION['user']['username']; ?></li>
                <li>Name: <?= $_SESSION['user']['name']; ?></li>
                <li>Surname: <?= $_SESSION['user']['surname']; ?></li>
                <li>Age: <?= $_SESSION['user']['age']; ?></li>
            </ul>
            <p><a class="text-decoration-none text-danger" href="/logout">Logout</a></p>
        </div>
    </div>
<?php endif; ?>
