<?php
class Database
{
    private static $dbName = 'customanager' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'teste123';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          return ($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
/*
create schema customanager;

use customanager;


create table products (prod_id int not null auto_increment, prod_nome varchar(255), prod_desc text, prod_preco decimal(8.2), primary key (prod_id));

create table customers (clien_id int not null auto_increment, clien_nome varchar (255), clien_email varchar(255), clien_telefone varchar(255), primary key (clien_id));

create table orders (pedido_numero int not null auto_increment, pedido_prod_id int, pedido_clien_id int, primary key(pedido_numero));
*/
?>