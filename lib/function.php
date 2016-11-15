<?php
	/*
	 * 获取配置参数
	 */
	function C($conf_key){
		static $conf_arr = array();
		$conf_dir = CONFIG_PATH;
		$arr = load($conf_dir);
		foreach ($arr as $val){
			$arr = include_once $val;
			if(is_array($arr) && count($arr)>=1){
				$conf_arr = array_merge($arr,$conf_arr);
			}
		}
		if($conf_key ==""){
			return $conf_arr;
		}else{
			return $conf_arr[$conf_key];
		}
	}
	/*
	 * 加载目录或文件
	 * @param load_dir string 目录或文件名
	 * @param is_auto_loaad int 是否自动加载，0则不是，返回数组，1则是
	 */
	function load($load_dir,$is_auto_load=0){
		static $arr =array();
		if($load_dir[strlen($load_dir)-1] == DIRECTORY_SEPARATOR){
			$load_dir = substr($load_dir,0,strlen($load_dir)-1);
		}
		if(is_dir($load_dir) && $load_dir !="." && $load_dir != ".."){
			$hand = opendir($load_dir);
			while(false !==($file = readdir($hand))){
				if(is_dir($load_dir.DIRECTORY_SEPARATOR.$file) and $file !="." and $file != '..'){
					load($load_dir.DIRECTORY_SEPARATOR.$file,$is_auto_load);
				}elseif(is_file($load_dir.DIRECTORY_SEPARATOR.$file) && file_exists($load_dir.DIRECTORY_SEPARATOR.$file) && $file != "." && $file !=".."){
					
						if(in_array($load_dir.DIRECTORY_SEPARATOR.$file,$arr)){
							continue;
						}
						$arr[] = $load_dir.DIRECTORY_SEPARATOR.$file;
						if($is_auto_load ==1)
							include_once $load_dir.DIRECTORY_SEPARATOR.$file;
				}
			}
		}elseif($load_dir == ""){
			errlog("load err:加载配置失败，目录或文件是空的");
			return false;
		}elseif(is_file($load_dir)&& file_exists($load_dir)){
			if(!in_array($load_dir,$arr))
				$arr[] = $load_dir;
			if($is_auto_load ==1){
				include_once $load_dir;
			}
		}
		return $arr;
	}
	/*
	 * 生成错误日志
	 */
	function errlog($msg){
		$string = $msg .' '.date("Y-m-d H:i:s",time()).PHP_EOL;
        if(DEBUG){
            echo $string;
        }
		file_put_contents(C('LOG_PATH').DIRECTORY_SEPARATOR.'errlog.txt',$string,FILE_APPEND);
	}
	/*
	 * 模型生成函数
	 */
	function D($table,$is_trueName=0){
		$mode = Model::getIns();
		if(trim($table) == ''){
			errlog('模型名称不能为空');
			return false;
		}
		if($is_trueName ===0){
			$mode->setTable($table);
		}else{
			$mode->tableTrueName($table);
		}
		$mode->init();
		return $mode;
	}
	/*
	 * 空模块处理函数
	 */
	function __empty(){
		echo '404 This page not found!';
	}


	/*
	 * 设置与获取session
	 */
	function session($name,$value=null,$timeout=0){
		if($value === null && trim($name) !=''){
			return $_SESSION[$name];
		}else if($value !== null && trim($name) != ''){
			$_SESSION[$name] = $value;
		}
	}
	/*
	 * 获取参数
	 */
	function I($name,$default=null,$filter=null,$type=null){
		if(strpos($name,'/')){
			list($type,$name) = explode('/',$name,2);
		}
		if(strpos($name,'.')){
			list($source,$name) = explode('.',$name,2);
		}else{
			$source = 'param';
		}
		$input = '';
		switch (trim($source)){
			case 'post':
				$input = &$_POST;
				break;
			case 'get':
				$input = &$_GET;
				break;
			case 'session':
				$input = &$_SESSION;
				break;
			case 'request':
				$input = &$_REQUEST;
				break;
			case 'cookie':
				$input = &$_COOKIE;
				break;
			case 'param':
				$method = $_SERVER['REQUEST_METHOD'];
				switch ($method){
					case 'POST':
						$input = &$_POST;
						break;
					case 'PUT':
						parse_str(file_get_contents('php://input'),$input);
					default:
						$input = &$_GET;
				}
		}
		//开始取值
		if(trim($name) != ''){
			if(isset($input[$name])){
				$data = $input[$name];
			}else{
				$data = $default;
			}
			if(is_array($filter)){
				foreach ($filter as $f){
					if(function_exists($f)){
						$data = filter($data,$f);
					}
				}
			}else{
				if(function_exists($filter))
					$data = filter($data,$filter);
			}
			if(!is_null($type)){
				switch ($type){
					case 'b':
						$data = (bool)$data;
						break;
					case 's':
						$data = (string)$data;
						break;
					case 'o':
						$data =(object)$data;
						break;
					case 'a':
						$data = (array)$data;
						break;
					case 'n':
						$data = (int)$data;
						break;
				}
			}
			return $data;

		}
		return $default;

	}

	function filter($data,$filter){
		$data = is_array($data)?
			array_map('filter',$data):
			$filter($data);
		return $data;
	}

	/*
	 * https请求
	 */
	function https_request($url,$args){
	    if(trim($url) == ''){
	        error_log('https request error,the url is required');
            return false;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($args)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /*
     * 将数组转换为json格式字符串
     */
    function jsEcode($data,$is_ecode_data=false){
        if(count($data) <=0){
            errlog('jsEcode Error,the data is null');
            return false;
        }
        if(!is_array($data)){
            errlog('jsEcode Error,need a array,other giveing');
            return false;
        }
        if($is_ecode_data){
            return json_encode($data);
        }
        $enc_arr = enc_val($data);
        $jsdata = json_encode($data);
        foreach ($enc_arr as $key=>$val){
            $jsdata = str_replace($key,$val,$jsdata);
        }
        return $jsdata;
    }

    function enc_val($val){
        static $enc_array = array();
        if(is_array($val)){
            array_map('enc_val',$val);
        }else{
            $enc_array[trim(json_encode($val),'"')] = $val;
        }
        return $enc_array;

    }







