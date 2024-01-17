<?php

if (isset($_POST['add_to_wishlist'])) {
    //recuperare i dati dalla richiesta AJAX
    $user_id = (isset($_POST['id_user']))? $_POST['id_user']:"";
    $pid = (isset($_POST['product_id']))? $_POST['product_id']:"";
    $name_product = (isset($_POST['name_product']))? $_POST['name_product']:"";
    $price = (isset($_POST['price']))? $_POST['price']:"";    
    $image= (isset($_POST['image']))? $_POST['image']:"";

    //controllo se il prodotto è già presente nel carello
    $connessione = db();
    $select_product = $connessione->prepare("SELECT * FROM wishlist WHERE pid=:pid AND user_id =:user_id");
    $select_product->bindParam(':pid', $pid);
    $select_product->bindParam(':user_id', $user_id);
    $select_product->execute();

    if($select_product -> rowCount()>0){
        $message[] = 'Il prodotto " '.$name_product.'" è stato già inserito nella tua lista dei preferiti!';
    }
    else{
        //connettersi al database
        $connessione = db();

        // preparare la query per l'inserimento di un prodotto nella wishlist
        $insert_wishlist_items = $connessione->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES (:user_id, :pid, :name , :price, :image)");
        $insert_wishlist_items->bindParam(':user_id', $user_id);
        $insert_wishlist_items->bindParam(':pid', $pid);
        $insert_wishlist_items->bindParam(':name', $name_product);
        $insert_wishlist_items->bindParam(':price', $price);
        $insert_wishlist_items->bindParam(':image', $image);
        
        $insert_wishlist_items->execute(); // eseguire la query
        // restituire una risposta
        $message[] = 'Il prodotto " '.$name_product.'" è stato aggiunto nella tua lista dei preferiti!';  
    }
}


if (isset($_POST['add_to_cart'])) {
    $pid = (isset($_POST['product_id']))? $_POST['product_id']:"";
    $name_product = (isset($_POST['name_product']))? $_POST['name_product']:"";
    $price = (isset($_POST['price']))? $_POST['price']:"";
    $image= (isset($_POST['image']))? $_POST['image']:"";
    $quantity= (isset($_POST['quantity']))? $_POST['quantity']:"";

    //controllo se il prodotto è già presente nel carello
    $connessione = db();
    $select_product = $connessione->prepare("SELECT * FROM cart WHERE name=:name AND user_id =:user_id");
    $select_product->bindParam(':name', $name_product);
    $select_product->bindParam(':user_id', $user_id);
    $select_product->execute();

    if($select_product -> rowCount()>0){
        //aggiorno la quantità se il prodotto è già nel carrello
        $connessione = db();
        $update_product = $connessione->prepare("UPDATE cart SET quantity=quantity+:quantity WHERE name=:name AND user_id=:user_id");
        $update_product->bindParam(':name', $name_product);
        $update_product->bindParam(':user_id', $user_id);
        $update_product->bindParam(':quantity', $quantity);
        $update_product->execute();

        $message[] = 'Aggiornata quantità del prodotto: '.$name_product.' !';
    
    }
    else{
        //inserisco il prodotto nel carrello se non è già presente
        $connessione = db();
        $insert_cart = $connessione->prepare("INSERT INTO cart (user_id, pid, image, name, price,quantity)
        VALUES (:user_id, :pid, :image, :name, :price, :quantity)");
        $insert_cart->bindParam(':user_id', $user_id);
        $insert_cart->bindParam(':pid', $pid);
        $insert_cart->bindParam(':image', $image);
        $insert_cart->bindParam(':name', $name_product);
        $insert_cart->bindParam(':price', $price);
        $insert_cart->bindParam(':quantity', $quantity);
        $insert_cart->execute();

        $message[] = 'Inserito ' .$name_product. ' nel carrello:  !';
    }
}

?>
