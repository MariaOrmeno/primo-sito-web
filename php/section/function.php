<?php 
function displayMessages($message){
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
            </div>
            ';
        }
    }
}
/**
   * Metodo per controllare l'esistenza di un utente associato
   * ad una determinato username durante la registrazione.
   */
function userExists($name,$lastname,$email,$pass,$cpass){   
    $connessione = db();
    $select_user = $connessione->prepare("SELECT * FROM `users` WHERE email=?");
    $select_user -> execute([$email]);

    if($select_user->rowCount()> 0){
        exit ('Questa email è stata già utilizzata!');
    }

    if($pass != $cpass){
        exit('la password confermata è diversa da quella sopra!');
    }
    else{
        $connessione = db();
        $insert_users =$connessione->prepare("INSERT INTO `users` (name,lastname, email, password,cpassword) VALUES (?,?,?,?,?)");
        if($insert_users -> execute([$name,$lastname,$email,md5($pass),md5($cpass)])){
            exit('Utente registrato!');
        }
    }
}

/**
   * Metodo per controllare l'esistenza in fase di login di un determinato utente.
   * @param String $name username dell'utente
   * @param String $pass Password dell'utente
   */ 
function verifyUser($name, $pass){
    $connessione = db();
    $select_user = $connessione->prepare("SELECT * FROM `users` WHERE name=? AND password=?");
    $select_user -> execute(array($name, md5($pass)));

    $checkuser = $select_user -> rowCount();
    $user = $select_user -> fetch();

    if($checkuser > 0){
        $_SESSION['loggedIN'] = '1';
        $_SESSION['name'] = $name;
        $_SESSION['type'] = $user['type'];
        $_SESSION['id'] = $user['id'] ;

        exit('login success!');
    }
    else{
        exit('Username o password sbagliate!');
    }
}

/*ADMIN home starts*/
function TotalPendings(){/*ordini in sospeso */
    $total_pendings = 0; /*Ordini in sospeso */
    $connessione = db();
    $select_pendings = $connessione ->prepare("SELECT * FROM `orders` WHERE payment_status =?");
    $select_pendings -> execute(['in sospeso']);
    if($select_pendings->rowCount() > 0){
        while ($fetch_pendings = $select_pendings ->fetch(PDO::FETCH_ASSOC)){
        $total_pendings += $fetch_pendings['total_price'];

        return  $total_pendings;
        }
    }
}

function TotalCompletes(){
    $total_completes = 0;
    $connessione = db();
    $select_completes = $connessione ->prepare("SELECT * FROM `orders` WHERE payment_status =?");
    $select_completes -> execute(['completato']);
    if($select_completes->rowCount() > 0){
        while ($fetch_completes = $select_completes ->fetch(PDO::FETCH_ASSOC)){
        $total_completes += $fetch_completes['total_price'];

        return  $total_completes;
        }
    }
}

function selectOrders(){
    $connessione = db();
    $select_orders = $connessione ->prepare("SELECT * FROM `orders`");
    $select_orders -> execute();
    
    $numbers_of_orders = $select_orders ->rowCount();
    return $numbers_of_orders;
}  

function selectProducts(){
    $connessione = db();
    $select_products = $connessione ->prepare("SELECT * FROM `product`");
    $select_products -> execute();
    
    $numbers_of_products = $select_products ->rowCount();
    return $numbers_of_products;
}  

function selectNumberUsers(){
    $connessione = db();
    $select_users = $connessione ->prepare("SELECT * FROM `users` WHERE type='0'");/* Clienti */
    $select_users -> execute();
    
    $numbers_of_users = $select_users ->rowCount();
    return $numbers_of_users;
}  

function selectNumberAdmins(){
    $connessione = db();
    $select_admins = $connessione ->prepare("SELECT * FROM `users` WHERE type='1'");/* admins*/
    $select_admins -> execute();
    
    $numbers_of_admins = $select_admins ->rowCount();
    return  $numbers_of_admins;
}  

function selectMessages(){
    $connessione = db();
    $select_messages = $connessione ->prepare("SELECT * FROM `messages`");
    $select_messages -> execute();
    
    $numbers_of_messages = $select_messages ->rowCount();
    return  $numbers_of_messages;
}  

/*accounts in generale pagina admin */
function selectAccounts(){
    $connessione = db();
    $select_account = $connessione -> prepare("SELECT * FROM users");
    $select_account ->execute();
    return $select_account;
}  

/*select admin */
function selectAdmins(){
    $connessione = db();
    $select_admins = $connessione ->prepare("SELECT * FROM `users` WHERE type='1'");/* admins*/
    $select_admins -> execute();
    return $select_admins;
} 

function gestisciAdmin (){   
    if (isset($_POST['azione'])){ /**TRUE ENTRA */
        $azione = $_POST['azione'];
        if (isset($_POST['id'])) {
            $id = (isset($_POST['id']))?$_POST['id'] : "";

            switch($azione){
                case 'Aggiungi':
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $tipo = $_POST['tipo'];

                    $connessione = db();
                    $insert_users = $connessione -> prepare("INSERT INTO `users` (name, lastname, email, password, type) VALUES (:name, :lastname, :email, :password, :type);");
                    $insert_users -> bindParam(':name', $name);
                    $insert_users -> bindParam(':lastname', $lastname);
                    $insert_users -> bindParam(':email', $email);
                    $insert_users -> bindParam(':password', $password);
                    $insert_users -> bindParam(':type', $tipo);
                    $insert_users ->execute();
                            
                    echo "<script> location.href='admins.php' </script>";
                    /*exit('Prodotto aggiunto!');*/
                    break;

                case 'Modifica':
                    echo "<script> location.href='update-accounts.php' </script>";
                    break;

                case 'Elimina':
                    $id = $_POST['id'];
                    $connessione = db();
                    $delete_users = $connessione -> prepare("DELETE FROM `users` WHERE id=:id");
                    $delete_users -> bindParam(':id', $id);
                    $delete_users -> execute();
                    echo "<script> location.href='admins.php' </script>";
                    break;

            }
        }
        else {
            echo "Errore: la chiave 'id' non è presente nei dati inviati.";
            exit();
        }
    }
}

/**client accounts */
function selectUsers(){
    $connessione = db();
    $select_users = $connessione ->prepare("SELECT * FROM `users` WHERE type='0'");/* Clienti */
    $select_users -> execute();
    return $select_users;
} 

function gestisciUser(){
    if (isset($_POST['azione'])){
        $azione = $_POST['azione'];

        if (isset($_POST['id'])) {
            $id = (isset($_POST['id']))?$_POST['id'] : "";

            if ($azione == "Modifica") {
                echo "<script> location.href='update-accounts.php' </script>";
            } 
            else if ($azione == "Elimina") { 
                $id = $_POST['id'];

                $connessione = db();
                $delete_users = $connessione -> prepare("DELETE FROM `users` WHERE id=:id");
                $delete_users -> bindParam(':id', $id);
                $delete_users -> execute();
                if ($delete_users -> execute()) {
                    echo "<script> location.href='users.php' </script>";
                    exit('Utente eliminato con successo!');
                }
                else {
                    echo "Errore nell'eliminazione dell'utente.";
                }
            }
        } 
        else {
            echo "Errore: la chiave 'id' non è presente nei dati inviati.";
            exit();
        }
    }
}

/*PRODUCTS ADMIN */

/*END PRODUCTS ADMIN */


/*GESTINE WISHLIST*/
function numFav(){
    $connessione = db();
        $count_wishlist_items = $connessione -> prepare("SELECT * FROM `wishlist` WHERE user_id = :user_id ");
        $count_wishlist_items -> bindParam(':user_id', $user_id);
        $count_wishlist_items -> execute();
        $total_wishlist_items = $count_wishlist_items ->rowCount();
}

/*CONTATTACI*/
function contactUs($name,$email,$telefono,$messaggio,$user_id){
    $connessione = db();
    $select_message = $connessione ->prepare("SELECT * FROM `messages` WHERE user_id =:user_id");
    $select_message -> bindParam(':user_id', $user_id);
    $select_message -> execute();
    if($select_message -> rowCount() >0){
         $message[] = 'hai già inviato un messaggio!';
         return $message;
    }
    else{
        $connessione = db();
        $send_message = $connessione ->prepare("INSERT INTO `messages` (user_id,name,email,number,message ) 
                                                VALUES (:user_id,:name, :email, :number, :message)");
        $send_message -> bindParam(':user_id', $user_id);
        $send_message -> bindParam(':name', $name);
        $send_message -> bindParam(':email', $email);
        $send_message -> bindParam(':number', $telefono);
        $send_message -> bindParam(':message', $messaggio);
        $send_message -> execute();
        $message[] = 'messaggio inviato con successo!';
        return $message;
    }
}

/*CARRELLO */
function cart($user_id){
    if(isset($_POST['azione'])){
        $azione = $_POST['azione'];
        $name_product = (isset($_POST['name_product']))?$_POST['name_product'] : "";
        $quantity = (isset($_POST['quantity']))?$_POST['quantity'] : "";
    
        if (isset($_POST['product_id'])) {
            $product_id = (isset($_POST['product_id']))?$_POST['product_id'] : "";
    
             switch($azione){
                case 'Continua lo shopping':
                    echo "<script> location.href='prodotti.php' </script>";
                    break;

                case 'Elimina':
                    $product_id = $_POST['product_id'];
                    $connessione = db();
                    $delete_product = $connessione -> prepare("DELETE FROM `cart` WHERE pid=:pid");
                    $delete_product -> bindParam(':pid', $product_id);
                    $delete_product -> execute();

                    $message[] = 'Prodotto  eliminato dal carrello!';
                    break;
        
                case 'edit':
                    $connessione = db();
                    $update_product = $connessione->prepare("UPDATE cart SET quantity=:quantity WHERE name=:name AND user_id=:user_id");
                    $update_product->bindParam(':name', $name_product);
                    $update_product->bindParam(':user_id', $user_id);
                    $update_product->bindParam(':quantity', $quantity);
                    $update_product->execute();
        
                    $message[] = 'La quantità del prodotto " '.$name_product.'" è stato aggiornata!';
                    break;    

                case 'Procedi al checkout':
                    echo "<script> location.href='checkout.php' </script>";
                    break;
        
                case 'Elimina tutto':
                    $connessione = db();
                    $delete_all_wishlist = $connessione->prepare("DELETE FROM cart WHERE user_id=:user_id");
                    $delete_all_wishlist->bindParam(':user_id', $user_id);
                    $delete_all_wishlist->execute();
        
                    $message[] = 'I prodotti del tuo carrello sono stati eliminati!';
                    break;
        
            }
            return $message;
        }    
    }
}

function wishlist($user_id){
    if(isset($_POST['azione'])){
        $azione = $_POST['azione'];
        $name_product = (isset($_POST['name_product']))?$_POST['name_product'] : "";
        $product_id = (isset($_POST['product_id']))?$_POST['product_id'] : "";
        $quantity = (isset($_POST['quantity']))?$_POST['quantity'] : "";
        $price = (isset($_POST['prezzo']))?$_POST['prezzo'] : "";
        $image = (isset($_POST['image']))?$_POST['image'] : "";
        $name_product = (isset($_POST['name_product']))?$_POST['name_product'] : "";

        switch($azione){
            case 'Elimina':
                $connessione = db();
                $delete_product = $connessione -> prepare("DELETE FROM `wishlist` WHERE pid=:pid");
                $delete_product -> bindParam(':pid', $product_id);
                $delete_product -> execute();

                $message[] = 'Prodotto  eliminato dalla tua lista dei preferiti!';
                return $message;
                break;

            case 'Aggiungi al carrello':
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

                    $delete_wishlist = $connessione->prepare("DELETE FROM `wishlist` WHERE pid =:pid");
                    $delete_wishlist->bindParam(':pid', $product_id);
                    $delete_wishlist->execute();
                    $message[] = 'La quantità del prodotto " '.$name_product.'" è stata aggiornata perchè è già 
                                presente nel carrello ed è stata pure eliminata dalla tua lista dei preferiti';
                    return $message;
                }
                else{
                    //inserisco il prodotto nel carrello se non è già presente
                    $connessione = db();
                    $insert_cart = $connessione->prepare("INSERT INTO cart (user_id, pid, image, name, price,quantity)
                    VALUES (:user_id, :pid, :image, :name, :price, :quantity)");
                    $insert_cart->bindParam(':user_id', $user_id);
                    $insert_cart->bindParam(':pid', $product_id);
                    $insert_cart->bindParam(':image', $image);
                    $insert_cart->bindParam(':name', $name_product);
                    $insert_cart->bindParam(':price', $price);
                    $insert_cart->bindParam(':quantity', $quantity);
                    $insert_cart->execute();

                    $delete_wishlist = $connessione->prepare("DELETE FROM `wishlist` WHERE pid =:pid");
                    $delete_wishlist->bindParam(':pid', $product_id);
                    $delete_wishlist->execute();

                    $message[] = 'Il prodotto " '.$name_product.'" è stato eliminato dalla tua lista perchè è stato aaggiunto al carrello!';
                    return $message;
                }
                break;

            case 'Continua lo shopping':
                echo "<script> location.href='prodotti.php' </script>";
                break;
            
            case 'Elimina tutto':
                $connessione = db();
                $delete_all_wishlist = $connessione->prepare("DELETE FROM wishlist WHERE user_id=:user_id");
                $delete_all_wishlist->bindParam(':user_id', $user_id);
                $delete_all_wishlist->execute();
                
                $message[] = 'I prodotti della tua lista dei preferiti è stata eliminata';
                return $message;
                break;
        }  
    }
}

/**UPDATE PROFILO CLIENT */
function updateProfile($user_id){
$azione = (isset($_POST['azione']))? $_POST['azione']: "";
    switch($azione){
        case "Aggiorna ora":
            $name = (isset($_POST['name']))?$_POST['name'] : "";
            $email = (isset($_POST['email']))?$_POST['email'] : "";
            
            $connessione = db();
            
            $update_profile = $connessione->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
            $update_profile->execute([$name, $email, $user_id]);

            $pass_vuota= '';
            $pass_attuale = (isset($_POST['pass_attuale']))?$_POST['pass_attuale'] : "";    
            $old_pass = (isset($_POST['old_pass']))?$_POST['old_pass'] : "";  
            $new_pass = (isset($_POST['new_pass']))?$_POST['new_pass'] : "";  
            $confirm_pass =(isset($_POST['confirm_pass']))?$_POST['confirm_pass'] : "";  

            if($old_pass == $pass_vuota){
                $message[] = 'inserisci la tua vecchia password ';
                return $message;

            }elseif(md5($old_pass) != $pass_attuale){
                $message[] = 'la vecchia password non coincide con quella attuale!';
                return $message;

            }elseif($new_pass != $confirm_pass){
                $message[] = 'la password confermata è diversa dalla nuova!';
                return $message;

            }else{
                if($new_pass != $pass_vuota){
                    $connessione = db();

                $update_pass = $connessione->prepare("UPDATE `users` SET password = ?, cpassword =? WHERE id = ?");
                $update_pass->execute([md5($new_pass),$confirm_pass, $user_id]);
                $message[] = 'Password aggiornata con successo!';
                return $message;

                }else{
                    $message[] = 'Inserire una nuova password';
                    return $message;
                }
            }
            break;

    }

}

/*ORDINI ADMINS */
function orders(){
    $azione =(isset($_POST['azione']))? $_POST['azione']: "";
    switch ($azione){
        case 'Modifica':
            $ordine = (isset($_POST['ordine']))? $_POST['ordine']: "";
            $payment_status = (isset($_POST['payment_status']))? $_POST['payment_status']: "";
            $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
        
            $connessione = db();
            $update_payment = $connessione->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
            $update_payment->execute([$payment_status, $ordine]);
    
            $message[] = 'Lo stato di pagamento è stato modificato!';
            return $message;
            break;
    
        case 'Elimina':
            $ordine = (isset($_POST['ordine']))? $_POST['ordine']: "";
            $connessione = db();
            $delete_order = $connessione->prepare("DELETE FROM `orders` WHERE id = ?");
            $delete_order->execute([$ordine]);
    
            $message[] = 'Lo ordine è stato eliminato!';
            return $message;
            break;
    }
}

/**UPDATE-ACCOUNTS ADMIN */
function updateAccounts($id){

    $azione = (isset($_POST['azione']))? $_POST['azione']: "";
    switch($azione){
        case "Aggiorna ora":
            $name = (isset($_POST['name']))?$_POST['name'] : "";
            $email = (isset($_POST['email']))?$_POST['email'] : "";
            
            $connessione = db();
            
            $update_profile = $connessione->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
            $update_profile->execute([$name, $email, $id]);

            $pass_vuota= '';
            $pass_attuale = (isset($_POST['pass_attuale']))?$_POST['pass_attuale'] : "";    
            $old_pass = (isset($_POST['old_pass']))?$_POST['old_pass'] : "";  
            $new_pass = (isset($_POST['new_pass']))?$_POST['new_pass'] : "";  
            $confirm_pass =(isset($_POST['confirm_pass']))?$_POST['confirm_pass'] : "";  

            if($old_pass == $pass_vuota){
                $message[] = 'inserisci la tua vecchia password ';
                return $message;

            }elseif(md5($old_pass) != $pass_attuale){
                $message[] = 'la vecchia password non coincide con quella attuale!';
                return $message;

            }elseif($new_pass != $confirm_pass){
                $message[] = 'la password confermata è diversa dalla nuova!';
                return $message;

            }else{
                if($new_pass != $pass_vuota){
                    $connessione = db();

                $update_pass = $connessione->prepare("UPDATE `users` SET password = ?, cpassword =? WHERE id = ?");
                $update_pass->execute([md5($new_pass),md5($confirm_pass), $id]);
                $message[] = 'Password aggiornata con successo!';
                return $message;

                }else{
                    $message[] = 'Inserire una nuova password';
                    return $message;
                }
            }
            break;

    }
}

/**MESSAGGI ADMIN */
function messaggiAdmin(){
$id = (isset($_POST['id']))? $_POST['id'] : "";
$azione = (isset($_POST['azione']))? $_POST['azione']: "";

    switch($azione){
        case "Elimina":
            $connessione = db();
            $delete_users = $connessione -> prepare("DELETE FROM `messages` WHERE id=:id");
            $delete_users -> bindParam(':id', $id);
            $delete_users -> execute();
            
            $message[] = 'Il messaggiato è stato eliminato!';
            return $message;
            break;

    }
}
?>


