<?php
$id = (isset($_POST['id']))? $_POST['id'] : "";
$name = (isset($_POST['name_product']))? $_POST['name_product']:"";
$details =(isset($_POST['details']))? $_POST['details']: "";
$quantity = (isset($_POST['quantity']))? $_POST['quantity']: "";
$price = (isset($_POST['price']))? $_POST['price']: "";
$image =(isset($_FILES['image']['name']))?$_FILES['image']['name']: "";
$categoria =(isset($_POST['txtCategoria']))? $_POST['txtCategoria']: "";

$azione =(isset($_POST['azione']))? $_POST['azione']: "";

switch ($azione){
    case 'Aggiungi':
        $fname = $_FILES['image']['name'];
        $tr = explode('.', $fname);
        $ext = strtolower(end($tr));
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
            $newfname = $name . '.' . $ext; /*name passato dal nome del prodotto */
            $image_path = "./../../img/prodotti/".$newfname;
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

            $connessione = db();
            $insert_product = $connessione -> prepare("INSERT INTO product (name, details, quantity , price, categoria_nome, image) VALUES (:name, :details, :quantity, :price, :categoria_nome, :image);");
            $insert_product -> bindParam(':name', $name);
            $insert_product -> bindParam(':details', $details);
            $insert_product -> bindParam(':quantity', $quantity);
            $insert_product -> bindParam(':price', $price);
            $insert_product -> bindParam(':categoria_nome', $categoria);
            $insert_product -> bindParam(':image', $newfname); /*le passo l'immagine*/
            $insert_product ->execute();

            $message[] = 'Il prodotto " '.$name.'" è stato aggiunto!';
            
        }
        else {
            echo 'You have choosen ' . $ext . ' file. Please choose png or jpg or jpeg file.';
        }
        
        echo "<script> location.href='prodotti.php' </script>";
    break;

    case 'Seleziona':
            $connessione = db();
            $select_products = $connessione -> prepare("SELECT * FROM product WHERE id=:id");
            $select_products -> bindParam(':id', $id);
            $select_products -> execute();
            $prodotto = $select_products ->fetch(PDO::FETCH_LAZY);

            $name = $prodotto['name'];
            $quantity=$prodotto['quantity'];
            $price=$prodotto['price'];
            $details=$prodotto['details'];
            $categoria=$prodotto['categoria_nome'];
            $image = $prodotto['image'];

            $message[] = 'Il prodotto " '.$name.'" è stato selezionato!';
            //echo "Pulsante schiacciato: Seleziona";
            /*exit('Prodotto selezionato!');*/
        break;

    case 'Modifica':
            $connessione = db();
            $edit_product = $connessione -> prepare("UPDATE product SET name=:name, details=:details, quantity=:quantity, price=:price WHERE id=:id");
            $edit_product -> bindParam(':id', $id);
            $edit_product -> bindParam(':name', $name);
            $edit_product -> bindParam(':details', $details);
            $edit_product -> bindParam(':quantity', $quantity);
            $edit_product -> bindParam(':price', $price);
            $edit_product -> execute();

            $message[] = 'Il prodotto " '.$name.'" è stato modificato!';

        
            if($categoria!="----"){//caso categoria
                $connessione = db();
                $edit_product = $connessione -> prepare("UPDATE product SET categoria_nome=:categoria_nome WHERE id=:id");
                $edit_product -> bindParam(':id', $id);
                $edit_product -> bindParam(':categoria_nome', $categoria);
                $edit_product -> execute();
            }
            /*gestione immagine update */
            if ($image != '') {
                $fname = $_FILES['image']['name'];
                $dd = explode('.', $fname);
                $ext = strtolower(end($dd));
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                    $newfname = $name . '.' . $ext; /*name passato dal nome del prodotto */
                    $image_path = "./../../img/prodotti/".$newfname;
                    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
                    $connessione = db();
                    $edit_product = $connessione -> prepare("UPDATE product SET image=:image WHERE id=:id");
                    $edit_product -> bindParam(':id', $id);
                    $edit_product -> bindParam(':image', $newfname);
                    $edit_product -> execute();
                }
                else {
                    echo 'You have choosen ' . $ext . ' file. Please choose png or jpg or jpeg file.';
                }
            }
        echo "<script> location.href='prodotti.php' </script>";
        break;

    case 'Elimina':
        $connessione = db();
        $delete_product = $connessione -> prepare("DELETE FROM product WHERE id=:id");
        $delete_product -> bindParam(':id', $id);
        $delete_product -> execute();

        $message[] = 'Il prodotto è stato eliminato!';
        //echo "Pulsante schiacciato: Elimina";
        break;

    case 'Annulla':
        echo "<script> location.href='prodotti.php' </script>";
        break;
}
?>