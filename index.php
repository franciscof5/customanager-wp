<?php
	//
	if ( !empty($_POST)) {
    	
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = trim($_POST['name']);
        $descricao = trim($_POST['desc']);
        $preco = trim($_POST['price']);
        
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Por favor coloque um nome';//'Please enter Name';
            $valid = false;
        }
         
        if (empty($descricao)) {
            $descricaoError = 'Por favor preencha o email';//'Please enter Email Address';
            $valid = false;
        }
         
        if (empty($preco)) {
            $precoError = 'Por favor informar o preço';//'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $new_post = array(
	            'post_title'    => "$name",
	            'post_content'   => $descricao,
	            'post_type' 	=> $_POST['post_type'],
	            'post_status' 	=> "publish"
	        );
	        
	        $pid = wp_insert_post($new_post);                           
	        
	        if( $pid ) { 
	            add_post_meta( $pid, 'preco', $preco, true );
	            //
	            {
			       header( 'HTTP/1.1 303 See Other' );
			       header( 'Location: products?message=success' );
			       exit();
			    }
			}
        } else {
	       header( 'HTTP/1.1 303 See Other' );
	       header( 'Location: products?message=error' );
	       exit();
	    }
    }
?>
<?php get_header(); ?>
		
<h4>Bem vindo ao sistema WP CUSTOMANAGER</h4>

<?php get_footer(); ?>
  
