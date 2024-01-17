<?php session_start();
include("../../db/connect.php");
include ("../section/function.php");

if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}
?> 

<?php include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
<?php include '../components/adminProduct.php'; ?>


    <!--Admin products section starts-->
    <section class="admin_products">
         <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
        <div class="box-container-products">
            <div class="add_products">
                <h2 class="heading-title">Aggiungi prodotti</h2>

                <form id="formProduct" class="formProduct" action="prodotti.php" method="POST" enctype="multipart/form-data">
                    <div class="flex">
                        <div class = "inputBox">
                            <span>Id</span>
                            <input type="text" readonly class="box" value="<?php echo $id?>"
                            name="id" id="id" placeholder="Inserire ID">
                        </div>

                        <div class="inputBox">
                            <span>Nome</span>
                            <input type="text" placeholder="Inserire il nome del prodotto" 
                            value="<?php echo $name?>" name="name_product" id="name_product" maxlength="100" class="box">
                        </div>

                        <div class="inputBox">
                            <span>Quantità</span>
                            <input type="number" min="0" placeholder="Inserire la quantità" 
                            value="<?php echo $quantity?>" name="quantity" id="quantity" maxlength="100" class="box">
                        </div>

                        <div class="inputBox">
                            <span>Prezzo</span>
                            <input type="number" step="0.01" min="0" placeholder="Inserire il prezzo" 
                            value="<?php echo $price?>" name="price" id="price" maxlength="100" class="box">
                        </div>

                        <div class="inputBox">
                            <span>Descrizione del prodotto</span>
                            <textarea type="text" placeholder="Aggiungere la descrizione del prodotto" 
                            name="details" id="details" maxlength="200" class="box" cols="30"><?php echo $details?></textarea>
                        </div>

                        <div class="inputBox">
                            <span>Categoria</span>
                            <label><?php echo $categoria?></label>
                            <select id="txtCategoria" name="txtCategoria" class="form-controller">
                                <option type="text" name="txtCategoria" selected>----</option>
                                <option type="text" name="txtCategoria" value="Shampoo">Shampoo</option>
                                <option type="text" name="txtCategoria" value="Skincare">Skincare</option>
                                <option type="text" name="txtCategoria" value="Balsamo">Balsamo</option>
                                <option type="text" name="txtCategoria" value="Maschera per capelli">Maschera per capelli</option>
                                <option type="text" name="txtCategoria" value="Mani e corpo">Mani e corpo</option>
                                <option type="text" name="txtCategoria" value="Viso">Viso</option>
                                <option type="text" name="txtCategoria" value="Occhi">Occhi</option>
                                <option type="text" name="txtCategoria" value="Labbra">Labbra</option>
                                <option type="text" name="txtCategoria" value="Accessori e pennelli">Accessori e pennelli</option>
                                <option type="text" name="txtCategoria" value="Mani">Mani</option>
                            </select>
                        </div>

                        <div id="gallery"></div><div style="clear:both;"></div><br /><br /> 

                        <div class="inputBox">
                            <span>Immagine</span>
                            <?php if($image!=""){?>
                                    <!-- MI FA VEDERE L'IMMAGINE SELEZIONATA -->
                                    <img class="img-thumbnail rounded" src="./../../img/prodotti/<?php echo $image;?>" 
                                    width="100" alt="" srcset="">

                                <?php }?>
                            <input type="file" name="image" id="image" class="box" multiple>
                        </div>
                    </div>  

                    <div class="btn-group" role="group">
                        <!-- echo ($azione =="Seleziona") se ho premuto il pulsante seleziona non posso più aggiungere nulla -->
                        <input type="submit" name="azione" <?php echo ($azione =="Seleziona")?"disabled":"";?>  id="azione" value="Aggiungi" class="butn btn-add">
                        <!-- echo ($azione !="Seleziona") se non ho premuto il pulsante seleziona, vuol dire che posso solo aggiungere un prodotto nuovo-->
                        <input type="submit" name="azione" <?php echo ($azione !="Seleziona")?"disabled":"";?> id="azione" value="Modifica" class="butn btn-modifica">
                        <input type="submit" name="azione" <?php echo ($azione !="Seleziona")?"disabled":"";?> id="azione" value="Annulla" class="butn btn-info">


                    </div>
                    <div style="clear:both"></div> 
                </form>
            </div>

            <div class="show-products">
                <table class="box-container">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>qt</th>
                            <th>Prezzo</th>
                            <th>Categoria</th>
                            <th>Immagine</th>
                            <th>Pulsanti</th>
                        </tr>
                    </thead>
                    <?php
                    $connessione = db();
                    $show_products = $connessione -> prepare("SELECT * FROM product");
                    $show_products ->execute();
                    if($show_products ->rowCount() > 0){
                        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
                    
                    /*$listaprodotti = $show_products ->fetchAll(PDO::FETCH_ASSOC);*/
                    ?>
                    <tbody>
                        <tr>
                            <td><strong><?=$fetch_products['id'];?></strong></td>
                            <td><?=$fetch_products['name'];?></td>
                            <td><?=$fetch_products['details'];?></td>
                            <td><?=$fetch_products['quantity'];?></td>
                            <td><?=$fetch_products['price']. ' €';?></td>
                            <td><?=$fetch_products['categoria_nome'];?></td>
                            <td><img src="../../img/prodotti/<?=$fetch_products['image']?>" alt=""></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" id="id" value="<?=$fetch_products['id'];?>"/>
                                    <input type="submit" name="azione" value="Seleziona" class="butn btn-select" />
                                    <input type="submit" name="azione" value="Elimina" class="butn btn-danger" />
                                </form>
                            </td>
                        </tr>

                    </tbody><?php
                        }
                    }?>
                </table>
            </div>
        </div>
    </section>
    <!--Admin products section ends-->

<?php include("./template/footer.html"); ?>