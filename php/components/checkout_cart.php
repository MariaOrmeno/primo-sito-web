<?php
if(isset($_POST['azione'])){
    $azione = $_POST['azione'];
    $name = $_POST['name'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address = $_POST['address'];
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    switch($azione){
        case 'Invia ordine':

            $connessione = db();
            $check_cart = $connessione->prepare("SELECT * FROM `cart` WHERE user_id =:user_id");
            $check_cart->bindParam(':user_id', $user_id);
            $check_cart->execute();

            if($check_cart -> rowCount() > 0){
            
            $connessione = db();
            $insert_order = $connessione->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) 
                                                        VALUES(:user_id, :name, :number, :email, :method, :address, :total_products, :total_price)");
            $insert_order->bindParam(':user_id', $user_id);
            $insert_order->bindParam(':name', $name);
            $insert_order->bindParam(':number', $numero);
            $insert_order->bindParam(':email', $email);
            $insert_order->bindParam(':method', $method);
            $insert_order->bindParam(':address', $address);
            $insert_order->bindParam(':total_products', $total_products);
            $insert_order->bindParam(':total_price', $total_price);
            $insert_order->execute();
            $message[] = 'Il tuo ordine è stato inviato con successo!';

            $delete_cart = $connessione->prepare("DELETE FROM `cart` WHERE user_id =:user_id");
            $delete_cart->bindParam(':user_id', $user_id);
            $delete_cart->execute();
            $message[] = 'Il tuo carrello è stato svuotato!';
            }
            else{
                $message[] = 'Error!';
            }
            break;
    }
}
?>