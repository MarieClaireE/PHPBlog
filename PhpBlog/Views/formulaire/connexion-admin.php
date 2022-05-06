if (isset($cnx_html)) {
    $sql = "SELECT * FROM users WHERE email=:email AND password=:password AND statut=:statut";
    $req = $cnx->prepare($sql);
    $req->execute(array('email' => filter_input(INPUT_POST, 'email'), 'password' => filter_input(INPUT_POST, 'password'), 'statut'=> 0));

    $count = $req->rowCount();
    
    // si le couple pseudo password est trouvé
    if ($count > 0) {
        $_SESSION['email'] = filter_input(INPUT_POST, 'email');

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom'] = $data['name'];
        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];

        header('location: homePage-admin.php');
    } else {
        $message = 'Accès refusé';
    }
}