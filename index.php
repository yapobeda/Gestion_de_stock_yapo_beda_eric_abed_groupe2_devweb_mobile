<?php
//CONNEXION
try {
    $bdd = new PDO('mysql:host=localhost;dbname=geekshop;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}

//AJOUTER LES INFORMATIONS
if (isset($_POST['ajout'])) {
   
    $lib = $_POST['libelle'];
    $qm = $_POST['quantite_minimale'];
    $qes = $_POST['quantite_en_stock'];

    $requete = $bdd->prepare('INSERT INTO produit(libelle, quantite_minimale, quantite_en_stock) 
                                VALUES(?, ?, ?)');
    $requete->execute(array($lib, $qm, $qes));
}



// LIRE DES INFORMATIONS
$requete = $bdd->query('SELECT * FROM produit');

echo '<table border>
    
            <tr>
                <th>Libellé</th>
                <th>Quantité minimale</th>
                <th>Quantité en stock</th>
                <th>Action</th>
            </tr>';

while ($donnees = $requete->fetch() ) {
   
    echo'<tr>
            <td>'.$donnees['libelle'].'</td>
            <td>'.$donnees['quantite_minimale'].'</td>
            <td>'.$donnees['quantite_en_stock'].'</td>
            <td><a href="" class="list-group-item-danger"><i class="far fa-trash-alt"></a></i> / <a href="modifier.php" class="list-group-item-info"><i class="far fa-edit"></i></a></td>
         </tr>';
}
            $requete->closeCursor();
        echo'</table>'; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <section class="ajout">
            <form action="index.php" method="post">
                    <h4 class="display-4 text-center">Ajouter</h4><hr><br>
                        <aside class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" 
                            class="form-control" 
                            name="libelle" 
                            id="libelle" 
                            placeholder="Enter a product">
                        </aside>

                        <aside class="form-group">
                            <label for="quantite_minimale">Quantité minimale</label>
                            <input type="number" 
                            class="form-control" 
                            name="quantite_minimale" 
                            id="quantite_minimale" 
                            placeholder="Enter a minimum amount">
                        </aside> 
                        <aside class="form-group">

                            <label for="quantite_en_stock">Quantité en stock</label>
                            <input type="number" 
                            class="form-control" 
                            name="quantite_en_stock" 
                            id="quantite_en_stock" 
                            placeholder="Enter a quantity in stock">
                        </aside>
                        <button type="submit" class="btn btn-primary" name="ajout">Ajouter</button>
                </form>
        </section>

    </main>
</body>
</html>