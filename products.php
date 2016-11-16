<?php
/**
 * Template Name: Products
 */
?>

<?php get_header(); ?>

	<?php
	//var_dump($_GET);
	if( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' )
	{
		echo '<div class="alert alert-success">
					<strong>Sucesso!</strong> Produto '.$name.' adicionado no banco de dados.
				</div>';
	} elseif ($_GET[ 'message' ] == 'error') {
		echo '<div class="alert alert-danger">
			 	 <strong>Erro: problema ao salvar o produto, verifique os dados e tente novamente</strong>
			</div>';
	}
	?>
	<script type="text/javascript">
		jQuery( document ).ready(function($) {
			$( "#row-adc" ).hide();
			$( "#adc-btn" ).click(function() {
				$(this).text(function(i, text){
				  return text === "ADICIONAR PRODUTO" ? "CANCELAR" : "ADICIONAR PRODUTO";
				});

				//btn-success
				$( "#row-adc" ).slideToggle( "slow", function() {
				    // Animation complete.
				    $ ( "#input_name" ).val("");
					$ ( "#input_descricao" ).val("");
					$ ( "#input_preco" ).val("");
				});
			});

		    $("[rel='tooltip']").tooltip();

		    //
		    $(".btn-customer-delete").click(function(){
		        bootbox.confirm("Tem certeza que deseja remover esse produto?", function(result) {
				  if(result) {
				  	bootbox.alert("Produto removido com sucesso!"); 
				  }
				}); 
		    });
		    
		    //
		    $(".btn-customer-edit").click(function(){
		    	var nomedb = $(this).parent().parent().parent().parent().parent().parent().find(".prod_db_nome").text();
		    	var emaildb = $(this).parent().parent().parent().parent().parent().parent().find(".prod_db_preco").text();
		    	var telefonedb = $(this).parent().parent().parent().parent().parent().parent().find(".prod_db_telefone").text();
		    	$( "#row-adc" ).slideDown( "slow", function() {
		    		$ ( "#input_name" ).val(nomedb);
		    		$ ( "#input_email" ).val(emaildb);
		    		$ ( "#input_mobile" ).val(telefonedb);
		    	});

		    	//if(("#adc-btn" ).text!="CANCELAR")
		    	//$("#adc-btn" ).text="CANCELAR";
		    		
		    	$( "#adc-btn" ).text(function(i, text){
		          return "CANCELAR";
		      	});
		    });

		    //
		    $(".btn-save").click(function(){

		    });
		});
	</script>

	
		<div class="row">
			<h4 class="pull-left">PRODUTOS</h4>
			<p class="text-right"><btn class="btn-sm btn-primary text-right" id="adc-btn" style="cursor: pointer;">ADICIONAR PRODUTO</btn></p>
		</div>
		
		<div class="row" id="row-adc" style="background-color:#EEE; padding:10px 10px;">
			<form class="form-horizontal" method="POST" action="">
			<input type="hidden" name="post_type" value="product">
			 <div class="form-group col-md-4">
			   <label for="name">NOME</label>
			   <div class="controls">
                    <input id="input_name" name="name" type="text"  placeholder="Nome" value="<?php echo !empty($name)?$name:'';?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="desc">DESCRIÇÃO</label>
			  	<div class="controls">
                    <input id="input_desc" name="desc" type="text" placeholder="Descrição" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($descricaoError)): ?>
                        <span class="help-inline"><?php echo $descricaoError;?></span>
                    <?php endif;?>
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="price">PREÇO</label>
			   <div class="controls">
                    <input id="input_price" name="price" type="text"  placeholder="Preço" value="<?php echo !empty($mobile)?$mobile:'';?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
			 </div>

                <div class="form-actions">
                  <br />
                  <button id="btn-save" type="submit" class="btn btn-sm btn-success">SALVAR</button>
                </div>
            </form>
		</div>
		<div class="row">
			
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>NOME</th>
				  <th>DESCRIÇÃO</th>
				  <th>PREÇO</th>
				  <th>PEDIDOS</th>
				  <th>AÇÕES</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   
			  	global $post;
				$args = array( 'posts_per_page'   => -1, 'post_type' => 'product');
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : 
				    setup_postdata( $post ); 					
					
						echo '<tr>';
						echo '<td class="cust_db_id">'. get_the_id() . '</td>';
						echo '<td class="cust_db_nome">'. get_the_title() . '</td>';
						echo '<td class="cust_db_email">'. get_the_content() . '</td>';
						echo '<td class="cust_db_telefone">'. "123" . '</td>';
						echo '<td>'. "." . '</td>';
						echo '<td>
								<table style="width:100%;">
								<tr>
									<td align="center">
					                	<button type="button" class="btn btn-default btn-customer-edit" data-toggle="tooltip" data-placement="top" title="EDITAR PRODUTO" rel="tooltip"><i class="glyphicon glyphicon-edit"></i></button>
					                </td>
					                <td align="center">
					                	<button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default btn-customer-delete" type="button" data-original-title="REMOVER PRODUTO" rel="tooltip"><i class="glyphicon glyphicon-remove-circle"></i></button>
					                </td>
				                </tr>
				                </table>
							  </td>';
						echo '</tr>';
				endforeach;
				   
			    wp_reset_postdata();
		  	    ?>
			  </tbody>
			</table>
		</div>

<?php get_footer(); ?>
  
