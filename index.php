<?php
    include_once 'header.php';
    include_once 'navbar.php';

    require_once 'classes/Database.php';
    require_once 'classes/User.php';

    session_start();

    if(!$_SESSION['userLogged']){
        header('Location: login.php');
    }

    use DB_PDO\Database as DB;
    use UserDTO\User as U;

    $config = require_once 'config.php';
    $PDOConn = DB::getInstance($config);
    $conn = $PDOConn->getConnection();

    $userDTO = new U($conn);

?>
<div class="container-fluid p-5">
    <h1>Home</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name </th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $res = $userDTO->getAllUsers();
                if($res){
                    foreach($res as $row) {?>
                <tr>
                    <th scope="row"><?=$row['id'] ?></th>
                    <td><?=$row['firstname'] ?></td>
                    <td><?=$row['lastname'] ?></td>
                    <td><?=$row['email'] ?></td>
                </tr>
                <?php }
                }; ?>
        </tbody>
    </table>

</div>




<?php  include_once 'footer.php'; ?>









<!-- 

Creare un pannello di amministrazione dati ad accesso riservato

Si richiede di sviluppare un'applicazione web in PHP che permetta agli utenti autorizzati di accedere 
a un pannello di amministrazione per gestire dati sensibili in un database. L'applicazione dovrà essere 
sviluppata utilizzando il paradigma di programmazione orientata agli oggetti.


Requisiti Funzionali

Autenticazione Utente: 
    - Gli utenti dovranno poter accedere al pannello di amministrazione inserendo un nome utente e una password. 
    - Il sistema dovrà autenticare gli utenti rispetto alle credenziali memorizzate in un database. 
Gestione dei Dati: 
    - Una volta autenticati, gli utenti potranno eseguire operazioni CRUD (Create, Read, Update, Delete) 
    sui dati sensibili presenti nel database. 
    - Le operazioni CRUD dovranno essere gestite tramite appositi form o interfaccia utente. 
Accesso Riservato: 
    - L'accesso al pannello di amministrazione e alle operazioni CRUD dovrà essere riservato agli utenti autorizzati. 
    - Gli utenti non autorizzati che tentano di accedere al pannello di amministrazione 
    dovranno essere reindirizzati ad una pagina di login.


Struttura dell'Applicazione 

Classe Utente (User): 
    Deve gestire l'autenticazione degli utenti e le relative informazioni (nome utente, password). 
Classe Database: 
    Deve gestire la connessione al database e le operazioni CRUD sui dati sensibili. 
    Le operazioni CRUD dovranno essere gestite tramite appositi form o interfaccia utente.

 -->