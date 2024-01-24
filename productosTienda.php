<div class="row mt-2">
                    <?php 
                        
                        $where=" where 1=1 ";
                        $nombre= mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');
                        if( empty($nombre)==false ){
                            $where="where nombre like '%".$nombre."%'";
                        }
                        $queryCuenta="SELECT COUNT(*) as cuenta FROM productos  $where ;";
                        $resCuenta=mysqli_query($conexion,$queryCuenta);
                        $rowCuenta=mysqli_fetch_assoc($resCuenta);
                        $totalRegistros=$rowCuenta['cuenta'];
    
                        $elementosPorPagina=6;
    
                        $totalPaginas=ceil($totalRegistros/$elementosPorPagina);
    
                        $paginaSel=$_REQUEST['pagina']??false;
    
                        if($paginaSel==false){
                            $inicioLimite=0;
                            $paginaSel=1;
                        }else{
                            $inicioLimite=($paginaSel-1)* $elementosPorPagina;
                        }
                        $limite=" limit $inicioLimite,$elementosPorPagina ";
                       

                        $query="SELECT id,nombre,precio,stock,imagenes FROM productos $where $limite";
                        $res=mysqli_query($conexion,$query);                            
                        while ($row=mysqli_fetch_assoc($res)) {

                            $path= "admin/".$row['imagenes']; //ubicacion de las imagenes
                        ?>
                        <div class="col-4 text-dark">
                            <div class="card border-primary">
                              <img class="card-img-top img-thumbnail" src="<?php echo $path?>" alt="">
                              <div class="card-body">
                                <h4 class="card-title "><?php echo $row ['nombre'] ?> </h4>
                                <p class="card-text"><strong>Precio: </strong><?php echo $row ['precio'] ?></p>
                                <p class="card-text"><strong>Stock: </strong><?php echo $row ['stock'] ?> </p>
                                <a class="btn btn-primary" href="index.php?modulo=detalleproducto&id=<?php echo $row['id']?>" role="button" >Ver</a>
                              </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                     ?>
                    
                </div>
                <?php
                if($totalPaginas>0){
                ?>
                    <nav aria-label="Page navigation ">
                      <ul class="pagination d-flex justify-content-center">
                        <?php
                            if( $paginaSel!=1 ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel-1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <?php
                        }
                        ?>

                        <?php
                        for($i=1;$i<=$totalPaginas;$i++){
                        ?>
                        <li class="page-item <?php echo ($paginaSel==$i)?" active ":" "; ?>">
                            <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php
                            if( $paginaSel!=$totalPaginas ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel+1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <?php
                            }
                        ?>
               
                <?php
                }
                 ?>
            </div>