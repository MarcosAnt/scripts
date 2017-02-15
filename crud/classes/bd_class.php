<?php
	class conectaBanco{
		//inicio atributos
		public    $server          = "localhost";
		public    $port            = 5432;
		private   $user            = "";
		private   $passwd          = "";
		private   $database        = "";
		private   $conexao         = NULL;
		public    $query_return    = NULL;
		public    $query_string    = NULL;
		private   $method_request  = "POST";
		protected $query_return    = NULL;
		//fim atributos

		//inicio metodos
		public function __construct(){
			
			if ( !isset($_POST["host"]) || !isset($_POST["bd_port"]) || !isset($_POST["bd_user"]) || !isset($_POST["bd_passwd"]) || !isset($_POST["database"]) || !isset($_POST["string_sql"]) ) {
				die("<h1>Erro! há campos vazios!</h1>");
			}

			$this->server   = clearString($_POST["host"]);
			$this->port     = clearString($_POST["bd_port"]);
			$this->user     = clearString($_POST["bd_user"]);
			$this->passwd   = clearString($_POST["bd_passwd"]);
			$this->database = clearString($_POST["database"]);

			$this->conecta();

			$this->query_string = clearString($_POST["string_sql"]);
		}//fim_construct

		public function __descontruct(){
			
			if($this->conexao != NULL) {
				pg_close($this->conexao);
				$this->server   = NULL;
		    	$this->port     = NULL;
		    	$this->user     = NULL;
		    	$this->passwd   = NULL;
		    	$this->database = NULL;
		    }

		}//fim_destruct

		public function conecta(){
			
			$connection_string="host={$this->server} port={$this->port} user={$this->user} password={$this->passwd} dbname={$this->database}";

			$this->conexao=pg_connect($connection_string) 
				or die ($this->tratamento_erro(__FILE__,__FUNCTION__,pg_last_error($this->conexao),TRUE));

		}//fim_conecta

		public function tratamento_erro($arqv=NULL, $rotina=NULL, $msg_erro=NULL, $die=FALSE){

			if($arqv == NULL) $arqv="Não Informado";
			if($rotina==NULL) $rotina="Não Informado";
			$msg_erro=pg_last_error($this->conexao);

			$notifica_erro=" Um erro ocorreu:<br>
				<strong>Arquivo: </strong>{$arqv}<br>
				<strong>Rotina: </strong>{$rotina}<br>
				<strong>Detalhes: </strong>{$msg_erro}";

			if(!$die)
				echo $notifica_erro;
			else
				die($notifica_erro);

		}//fim_tratamento_erro

		//inicio clearString()
		public function clearString($string) {

			$string = trim($string);
			$string = stripslashes($string);
			$string = htmlspecialchars($string);
			return $string;

		}//fim clearString()

		public function query() {

			$this->query_return = pg_query($this->conexao, $this->query_string) 
				or die ($this->tratamento_erro(__FILE__,__FUNCTION__,pg_last_error($this->conexao),TRUE));

		}

		//fim metodos
	}//fim classe
?>