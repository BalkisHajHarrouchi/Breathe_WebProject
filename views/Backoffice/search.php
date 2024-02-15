<table>
                                                    <thead>
                                                        <tr>
                                                            
                                                        <th>Nom de produit</th>
                                                            <th>Type de produit</th>
                                                            <th>Prix</th>
                                                            <th>Stock</th>
                                                            <th>Code_Barre</th>
                                                            <th>Status de produit</th>
                                                            <th>Delete</th>
                                                            <th>update</th>

                                                            
            
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        
                                                    <?php 
                                                    $input=null;
                                                    if(isset($_POST["input"]))
                                                    {
                                                    $input=$_POST["input"];
                                                    }
                                                    include ('../controlers/produitsC.php');
                                                         $produitC= new produitsC();
                                                         $list=$produitC->afficherproduit($input);
                                                         foreach($list as $pr){
                                                         ?>
                                                    
                                                        <tr>
                                                           
                                                            <td><?=$pr['nomproduit']?></td>
                                                            <td><?=$pr['typeprod']?></td>
                                                            <td id='prix<?=$pr['idProduit']?>'><?=$pr['prix']?></td>
                                                            <td ><?=$pr['stock']?></td>
                                                            <td ><?=$pr['codeBarre']?></td>
                                                            <td ><?=$pr['status']?></td>
                                                            <td><a href="../views/deleteproduct.php?idProduit=<?=$pr['idProduit']?>"><i class="fas fa-trash"></i></a></td>
                                                            <td><a href="../views/updateproduct.php?idProduit=<?=$pr['idProduit']?>"><i class="fas fa-sync-alt"></i></a></td>                                                           
                                                        </tr>
                                                        <?php
                                                         }
                                                        ?>
                                                    </tbody>
                                                </table>