<?php
class Model{	
	//数据库对象
	protected $db;
	
	//实例对象
	static public $ins =null;

    //表的真名
    protected $true_tableName;
	
	//表前缀
	protected $table_prefix;
	
	//最后一条执行的sql语句
	protected $last_sql;
	
	//执行sql动作形式
	protected $active;
	
	//错误信息
	protected $err;

    //逻辑表达式
    protected $expt=array(
        'or',
        'and',
        '||',
        '&&'
    );

	//limit条件
	protected $limit="";

	//order语句
    protected $order="";

    //查询表达式
	protected $_logic=array(
		'BETWEEN',
		'NOT BETWEEN',
		'LIKE',
        'IN',
        'NOT IN',
		'NOT LIKE',
		'eq'=>'=',
		'neq'=>'!=',
		'gt'=>'>',
		'lt'=>'<',
		'egt'=>'>=',
		'elt'=>'<='
	);
    /*
     * 查询条件
     */
    public $options = array(
        'where'=>'',
        'limit'=>'',
        'order'=>''
    );

    protected $sql ="SELECT%feilds%from%table%%where%%order%%limit%";
	/*
	 * 组合数据库类
	 */
	protected function __construct(){
        $this->table_prefix = C('table_prefix');
        $this->db = Db::getIns();
    }
    /*
     * 初始化类环境
     */
    public function init(){
        $this->options['table'] = $this->true_tableName;
        $this->options['feilds'] = $this->get_table_feilds();
    }
	
	/*
	 * 实现单列
	 */
	public static function getIns(){
		if(self::$ins === null){
			self::$ins = new self();
		}
		return self::$ins;
	}
	/*
	 * 获取最后一条执行的sql语句
	 */
	public function getLastSql(){
		return $this->last_sql;
	}
	/*
	 * 自动生成sql语句
	 */
	public function autoSql($data){
		$n = 0;
		if(!is_array($data)){
			$this->err = '数据传输错误，自动生成sql失败';
			errlog($this->err);
			return false;
		}	
		$sql = '';
		switch ($this->active){
			case 'add':
				$sql = 'insert into '.$this->table;
				$coulms = array_keys($data);
				$coulms = $this->splid_coulms($coulms);
				if($coulms){
					$sql .= ' '.$coulms.' values(';
				}
				foreach($data as $v){
					$n++;
					if($n ==count($data)){
						$sql .="'".$v."')";
					}else{
						$sql .= "'".$v."',";
					}
				}
			case 'upd':
				$sql = 'update '.$this->true_tableName.' set ';
				foreach ($data as $key =>$val){
                    $n++;
					if($n == count($data)){
						$sql .=$key."='".$val."'";
					}else{
                        $sql .= $key."='".$val."',";
                    }

				}						
				
		}

		return $sql;
		
	}
	/*
	 * 查询结果集
	 */
	public function select(){

        foreach ($this->options as $key =>$val){
            $this->sql = str_replace('%'.$key.'%'," ".$val." ",$this->sql);
        }
        $this->last_sql = $this->sql;
        try{
                $sth = $this->db->link->prepare($this->sql);
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $pdoerr){
                errlog($pdoerr->errorInfo);
            return false;
        }


    }
    /*
     * 数据的更新
     */
    public function save($data){
        if(!is_array($data)) {
                $this->err = __FUNCTION__ . 'need a array param,string give';
                if (DEBUG) {
                    echo $this->err;
                }
                errlog($this->err);
                return false;
            }
            $this->active = 'upd';
            $this->sql = $this->autoSql($data);
            if($this->options['where'] != ''){
                $this->sql .=" ".$this->options['where']." ";
            }
            if($this->options['limit'] != ''){
                $this->sql .= " ".$this->options['limit'];
            }
            $this->last_sql = $this->sql;
            try{
                $in = $this->db->link->exec($this->sql);
                if($in){
                    return $in;
                }else{
                    return false;
                }
            }catch (PDOException $e){
                if(DEBUG){
                    echo $e->errorInfo;
                }
                $this->err = $e->errorInfo;
                errlog($this->err);
                return false;
            }


    }

    /*
     * 删除数据
     */

    public function delete($id=null){
        $this->sql = 'delete from '.$this->true_tableName;
        if($id !== null && $this->options['where'] == ''){
            $this->sql .= ' where id='.$id;
        }else{
            if($this->options['where'] != ''){
                $this->sql .= ' '.$this->options['where'].' ';
            }
            if($this->options['limit'] != ''){
                $this->sql .= ' '.$this->options['limit'];

            }
        }
        try{
            $this->last_sql=$this->sql;
            $in = $this->db->link->exec($this->sql);
            if($in){
                return $in;
            }else{
                return false;
            }
        }catch (PDOException $e){
            if(DEBUG){
                echo $e->errorInfo;
            }
            $this->err = $e->errorInfo;
            errlog($this->err);
        }
        return false;

    }

    public function find($id=null){
        $this->limit(1);
        if($id !== null && $this->options['where'] == ''){
            if(is_array($id)){
                $map = $id;
            }else{
                $map['id'] = $id;
            }
            $res = $this->where($map)->select();
            if($res){
                return $res[0];
            }
        }else{
            $res = $this->select();
            if($res){
                return $res[0];
            }
        }
        return false;

    }
    public function feilds($feilds){
        $this->options['feilds']=$feilds;
        return $this;
    }
    /*
	 * 生成where条件
	 */
	public function where($condition){
	    if(!$condition){
	        return null;
        }
		$this->options['where'] = "where ";
		$n =0; 
		//是否是数组
		if(is_array($condition)){
            if(isset($condition['_logic'])){
                if(in_array(strtolower($condition['_logic']),$this->expt)){
                    $condition['_logic'] =  strtoupper($condition['_logic']);
                }else{
                    $this->err = "where 条件语句逻辑参数传递错误，'".$condition['_logic']."'不合法";
                    errlog($this->err);
                    return FALSE;
                }
            }else{
                $condition['_logic'] = 'AND';
            }
			//判断是否是多维数组
			$b = $this->is_two_array($condition);
			if($b){
				//是多维数组
				foreach ($condition as $key=>$val){
					if(is_array($val) && $this->is_two_array($val)){
						//是三维数组
						if(isset($val[2])) {
                            if (in_array(strtolower($val[2]), $this->expt)) {
                                $val[2] = strtoupper($val[2]);
                            } else {
                                $this->err = "where 条件语句逻辑参数传递错误,'" . $val[2] . "'不合法";
                                errlog($this->err);
                                return FALSE;
                            }
                        }else{
                            $val[2] ="AND";
                        }
                            //以数组的形式给between传参 $map['id'] = array('between',array(4,5));
                            if(!is_array($val[1])){
                                $this->err = '以数组形式传参错误，$argument[1] need a array,but '.$val[1].'is not';
                                errlog($this->err);
                                return false;
                            }
                            if(strtolower($val[0]) == 'between' || strtolower($val[0]) == 'not between'){
                                $this->options['where'] .= $key." ".strtoupper($val[0])." '".$val[1][0] ."' and '".$val[1][1]."' ".$condition['_logic']." ";
                            }elseif(strtolower($val[0]) == 'in' || strtolower($val[0]) == 'not in'){
                                $this->options['where'] .= $key." ".strtoupper($val[0])." (";
                                foreach ($val[1] as $va){
                                    $n++;
                                    if($n == count($val[1])){
                                        $this->options['where'] .= "'".$va."') ".$condition['_logic'];
                                    }else{
                                        $this->options['where'] .= "'".$va."',";
                                    }
                                }
                              //  $this->options['where'] .= $key." ".strtoupper($val[0])." '".$val[1][0] ."' and '".$val[1][1]."' ".$condition['_logic']." ";
                            }else{

                                if(isset($this->_logic[$val[0]])){
                                    $logic = $this->_logic[$val[0]];
                                }elseif(in_array(strtoupper($val[0]),$this->_logic)){
                                        $logic = $val[0];
                                }else{
                                        $this->err = $val[0] .'不合法';
                                        errlog($this->err);
                                        return false;
                                }
                                $this->options['where'] .= '(';
                                $k = 0;
                                foreach ($val[1] as $v){
                                    $k++;
                                    if($k == count($val[1])){
                                        $this->options['where'] .=$key." ".strtoupper($logic)." '".$v."') ".$condition['_logic']." ";
                                    }else{
                                        $this->options['where'] .=key." ".strtoupper($logic)." '".$v."' ".$val[2]." ";
                                    }
                                }
                            }



					}else{	
						/*$map['id'] = 1;
						$map['catname'] =array('like',"%nvc");*/
						//是二维数组	
						if(is_array($val)){
							if(isset($this->_logic[$val[0]])){
								$this->options['where'] .= $key.$this->_logic[$val[0]]."'".$val[1]."' ".$condition['_logic']." ";
							}elseif(in_array(strtoupper($val[0]),$this->_logic)){
								if(strtolower($val[0]) =="like"){
									$this->options['where'] .= $key." LIKE "."'".$val[1]."' ".$condition['_logic']." ";
								}elseif(strtolower($val[0]) =="not like"){
									$this->options['where'] .=$key." NOT LIKE "."'".$val[1]."' ".$condition['_logic'];
								}elseif(strtolower($val[0]) =="between" || strtolower($val[0]) == 'not between'){
                                    $value = explode(',',$val[1]);
                                    $this->options['where'] .=$key." ".strtoupper($val[0])." '".$value[0]."' and '".$value[1]."' ".$condition['_logic']." ";
                                }elseif(strtolower($val[0]) =="in" || strtolower($val[0]) == 'not in'){
                                    $value = explode(',',$val[1]);
                                    $this->options['where'] .= $key." ".strtoupper($val[0])." (";
                                    foreach ($value as $va){
                                        $n++;
                                        if($n == count($value)){
                                            $this->options['where'] .= "'".$va."') ".$condition['_logic'];
                                        }else{
                                            $this->options['where'] .= "'".$va."',";
                                        }
                                    }
                                }
							}else{
								$this->err = "where 条件语句逻辑参数传递错误，'".$val[0]."'不合法";
								errlog($this->err);
								return FALSE;
							}
								
						}else if($key !="_logic"){
							$this->options['where'] .=$key."='".$val."' ".$condition['_logic']." ";
						}
						
					}
				}
			}else{
			    //是一维数组
				foreach ($condition as $key =>$val){
					$n++;
					if($key =="_logic"){
						continue ;
					}
					if($n ==count($condition)-1){
						$this->options['where'] .= $key."='".$val."'";
					}else{
						$this->options['where'] .= $key."='".$val."' ".$condition['_logic']." ";
					}
					
				}
			}
			//去掉后面多余的逻辑符号
            $this->filter_expt($condition['_logic']);
		}else{
			//是字符串表达式
			$this->options['where'] .=$condition;
		}
		return $this;
	}
	
	/*
	 * 生成limit条件
	 */
	
	public function limit($start,$end=null){
		if(strpos(',',$start)){
		    $this->options['limit'] = "LIMIT ".$start;
        }else{
            if($end != null){
                $this->options['limit'] = "LIMIT ".intval($start).",".intval($end);
            }else{
                $this->options['limit'] = "LIMIT ".intval($start);
            }
        }
        return $this;
	}

	public function order($expt){
        $this->options['order'] = "ORDER BY ".$expt;
        return $this;
    }
	/*
	 * 获取错误信息
	 */
	public function ErrorInfo(){
		return $this->err;
	}
	/*
	 * 拆分字段
	 */
	protected function splid_coulms($coulms){
		if(!is_array($coulms)){
			$this->err = "拆分数据字段失败";
			errlog($this->err);
			return false;
		}
		$coulms_string =implode(',',$coulms);
		return $coulms_string;
		
	}
	/*
	 * 判断是否是多维数组
	 */
	protected  function is_two_array($arr){
		$b = false;
		foreach ($arr as $v){
			if(is_array($v)){
				$b = true;
			}
		}
		return $b;
	}

    /*
     * 去掉where条件语句末尾多余的逻辑语句
     */
    public function filter_expt($expt){
        if(trim($this->options['where']) != ""){
            $this->options['where'] = trim($this->options['where']);
            $expt = trim($expt);
            $start = strlen($this->options['where'])-strlen($expt);
           $end_str =  substr($this->options['where'],$start);
            if(in_array(strtolower($end_str),$this->expt)){
                $this->options['where'] = substr($this->options['where'],0,$start);
            }
        }
    }
    /*
     * 设置表的真名字
     */
    public function tableTrueName($table_name){
        $this->true_tableName = $table_name;
        $this->init();
    }

    /*
     * 设置不带前缀的表名
     */
    public function setTable($table_name){
        $this->true_tableName = $this->table_prefix.$table_name;
    }

    /*
     * 获取表的字段
     */
    public function get_table_feilds(){
        $fields=array();
        $sql = 'SHOW FULL COLUMNS FROM '.$this->true_tableName;
        $this->last_sql =$sql;
        try{
            $sth = $this->db->link->prepare($sql);
            $sth->execute();
            $res = $sth->fetchAll();
            foreach ($res as $val){
                $fields[] = $val['Field'];
            }
            return $this->splid_coulms($fields);
        }catch (PDOException $e){
            errlog($e->errorInfo);
            return false;
        }

    }
	
}
?>