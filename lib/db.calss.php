<?php
	class Db{
		private $dbhost;
		private $dbname;
		private $dbpwd;
		private $dbuser;
		private $character;
        private $dsn;
		public $link;
        private $dbtype;
		public static $ins=null;
		protected  $err;
		/*
		 * 初始化
		 */
		
		private function __construct(){
			$this->dbhost    = C('dbhost');
			$this->dbpwd     = C('dbpwd');
			$this->dbname    = C('dbname');
			$this->dbuser    = C('dbuser');
			$this->character = C('character');
            $this->dbtype    = C('dbtype');
            $this->dsn ="mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->character";
			$this->conn();
		}
		/*
		 * 获取单列对象
		 */
		public static function getIns(){
			if(self::$ins === null){
				self::$ins = new self();
			}
			
			return self::$ins;
		}
		/*
		 * 链接数据库
		 */
		private function conn(){
		    try{
                $pdo = new PDO($this->dsn,$this->dbuser,$this->dbpwd);
                if($pdo){
                    $this->link = $pdo;
                }
            }catch (PDOException $e){
                $this->err = $e->getMessage();
                if(DEBUG){
                    echo $this->err;
                }
                errlog($this->err);
            }

		}
		/*
		 *返回错误信息
		 */
		public function ErrorInfo(){
			return $this->err;
		}

		
		
		
		
	}
?>