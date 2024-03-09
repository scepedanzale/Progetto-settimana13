<?php
    include_once 'header.php';
    include_once 'navbar.php';

    require_once 'classes/Database.php';
    require_once 'classes/User.php';

    session_start();

    if(!$_SESSION['userLogged']){
        header('Location: login.php');
    }

    use DB_PDO\Connection as Conn;
    use DB_PDO\Database as DB;

    $config = require_once 'config.php';
    $PDOConn = Conn::getInstance($config);
    $conn = $PDOConn->getConnection();

    $userDTO = new DB($conn);

    if(isset($_REQUEST['action']) && $_REQUEST['action']==='updateUser'){
        $res = $userDTO->getUserByID($_REQUEST['id']);
        foreach($res as $row){
            $user = $row;
        }
    }

?>


<div class="container my-4">
    <h1>Modifica utente</h1>
    <form action="controller.php?action=updateUser&id=<?=$user['id']?>" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" value="<?=$user['firstname']?>" name="firstname" placeholder="nome..." required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" value="<?=$user['lastname']?>" name="lastname" placeholder="cognome..." required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" value="<?=$user['email']?>" name="email" placeholder="email..." required>
        </div>
        <button type="submit" class="btn btn-secondary">Modifica dati</button>
    </form>
</div>



<?php  include_once 'footer.php'; ?>