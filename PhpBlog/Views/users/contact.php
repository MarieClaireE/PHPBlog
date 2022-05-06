<!DOCTYPE html>
<html lang='fr'>
    <?php include '../include/header.html'; ?>
    <body>
        <?php include '../include/nav-users.html'; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                   <div class="card mb-4 mt-5 border-0">
                       <?php include '../include/horloge.html'; ?>
                   </div> 
                </div>
                <div class="col-lg-8">
                    <div class="card mb-5 mt-5">
                        <h4 class="text-center mb-3 mt-3">Formulaire de contact</h4>
                        <?php include '../formulaire/contact.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../include/footer.html'; ?>
    </body>
</html>