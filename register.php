<?php

include_once 'header.php';
include_once 'navbar.php';
?>


<div class="container-fluid p-5">
    <h1>Register</h1>

    <form action="controller.php?action=addUser" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="firstname" placeholder="nome..." required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="lastname" placeholder="cognome..." required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="email..." required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="password..." required>
        </div>
        <button type="submit" class="btn btn-secondary">Registrati</button>
    </form>
</div>

<?php  include_once 'footer.php'; ?>