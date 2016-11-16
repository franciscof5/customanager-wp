<?php
	include "database.php";
		
    if ( !empty($_POST)) {
    	
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $mobile = trim($_POST['mobile']);
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Por favor coloque um nome';//'Please enter Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Por favor preencha o email';//'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Por favor preencha o email corretamente';//'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Por favor informar telefone';//'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
        	
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (clien_nome,clien_email,clien_telefone) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile));
            Database::disconnect();
            //            
            {
		       header( 'HTTP/1.1 303 See Other' );
		       header( 'Location: customers.php?message=success' );
		       exit();
		    }
        } else {
        	echo '<div class="alert alert-danger">
				  <strong>Erro:</strong> '.$nameError.' '.$emailError.' '.$mobileError.'
				</div>';
        }
    }
?>
	
<?php
@include("header.php");
?>
	
	<?php
	if( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' )
	{
		echo '<div class="alert alert-success">
						<strong>Sucesso!</strong> Cliente '.$name.' adicionado no banco de dados.
				</div>';
	}
	?>
	<script type="text/javascript">
		jQuery( document ).ready(function($) {
			$( "#row-adc" ).hide();
			$( "#adc-btn" ).click(function() {
			 $(this).text(function(i, text){
		          return text === "ADICIONAR CLIENTE" ? "CANCELAR" : "ADICIONAR CLIENTE";
		      });
			 
			 //btn-success
				$( "#row-adc" ).slideToggle( "slow", function() {
				    // Animation complete.
				    $ ( "#input_name" ).val("");
		    		$ ( "#input_email" ).val("");
		    		$ ( "#input_mobile" ).val("");
				});

			});

		    $("[rel='tooltip']").tooltip();

		    //
		    $(".btn-customer-delete").click(function(){
		        bootbox.confirm("Tem certeza que deseja remover esse cliente?", function(result) {
				  if(result) {
				  	bootbox.alert("Cliente removido com sucesso!"); 
				  }
				}); 
		    });
		    $(".btn-customer-edit").click(function(){
		    	var nomedb = $(this).parent().parent().parent().parent().parent().parent().find(".cust_db_nome").text();
		    	var emaildb = $(this).parent().parent().parent().parent().parent().parent().find(".cust_db_email").text();
		    	var telefonedb = $(this).parent().parent().parent().parent().parent().parent().find(".cust_db_telefone").text();
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
		});
	</script>

	
		<div class="row">
			<h4 class="pull-left">CLIENTES</h4>
			<p class="text-right"><btn class="btn-sm btn-primary text-right" id="adc-btn" style="cursor: pointer;">ADICIONAR CLIENTE</btn></p>
		</div>
		
		<div class="row" id="row-adc" style="background-color:#EEE; padding:10px 10px;">
			<form class="form-horizontal" action="customers.php" method="post">

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
			   <label for="email">EMAIL</label>
			  	<div class="controls">
                    <input id="input_email" name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="mobile">TELEFONE</label>
			   <div class="controls">
                    <input id="input_mobile" name="mobile" type="text"  placeholder="Telefone" value="<?php echo !empty($mobile)?$mobile:'';?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
			 </div>

                <div class="form-actions">
                  <br />
                  <button type="submit" class="btn btn-sm btn-success">SALVAR</button>
                </div>
            </form>
		</div>
		<div class="row">
			
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>NOME</th>
				  <th>EMAIL</th>
				  <th>TELEFONE</th>
				  <th>PEDIDOS</th>
				  <th>AÇÕES</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM customers ';
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td class="cust_db_id">'. $row['clien_id'] . '</td>';
						echo '<td class="cust_db_nome">'. $row['clien_nome'] . '</td>';
						echo '<td class="cust_db_email">'. $row['clien_email'] . '</td>';
						echo '<td class="cust_db_telefone">'. $row['clien_telefone'] . '</td>';
						echo '<td>'. "." . '</td>';
						echo '<td>
								<table style="width:100%;">
								<tr>
									<td align="center">
					                	<button type="button" class="btn btn-default btn-customer-edit" data-toggle="tooltip" data-placement="top" title="EDITAR CLIENTE" rel="tooltip"><i class="glyphicon glyphicon-edit"></i></button>
					                </td>
					                <td align="center">
					                	<button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default btn-customer-delete" type="button" data-original-title="REMOVER CLIENTE" rel="tooltip"><i class="glyphicon glyphicon-remove-circle"></i></button>
					                </td>
				                </tr>
				                </table>
							  </td>';
						echo '</tr>';
			   }
			   Database::disconnect();
			  ?>
			  </tbody>
			</table>
		</div>

<?php
	@include("footer.php");
?>
  
