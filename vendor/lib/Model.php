<?php
namespace vendor;
class Model
{
	//成员属性   哪些要写成成员属性呢
	//主机名
	protected $host;
	//用户名
	protected $user;
	//密码
	protected $pwd;
	//数据库名
	protected $dbname;
	//字符集
	protected $charset;
	//前缀
	protected $prefix;
	
	//数据表名
	protected $tableName;
	//缓存的字段存放的数组
	protected $fields = [];
	
	//用来保存查询时候条件函数的数组
	protected $options = [];
	
	//连接资源
	protected $link;
	//sql语句
	protected $sql;
	
	//成员方法   哪些作为成员方法呢
	
	public function __construct($config = null)
	{
		if (empty($config)) {
			$config = $GLOBALS['config'];
		}
		
		$this->host = $config['DB_HOST'];
		$this->user = $config['DB_USER'];
		$this->pwd = $config['DB_PWD'];
		$this->dbname = $config['DB_NAME'];
		$this->charset = $config['DB_CHARSET'];
		$this->prefix = $config['DB_PREFIX'];
		
		//连接数据库
		$this->link = $this->connect();
		//获取数据表名函数
		$this->tableName = $this->getTableName();
		//缓存该表的字段
		$this->fields = $this->cacheFields();
		//var_dump($this->fields['PRI']);
		
		//将options数组中所有的值清空
		$this->initOptions();
	}
	
	//初始化函数，将所有条件初始化为空
	protected function initOptions()
	{
		$array = ['field', 'table', 'where', 'group', 'having', 'order', 'limit'];
		foreach ($array as $value) {
			$this->options[$value] = '';
		}
		//将table这个字段，默认初始为你的表名
		$this->options['table'] = $this->tableName;
		//将field字段默认设置为所有字段
		$this->options['field'] = join(',', array_unique($this->fields));
	}
	
	//连接数据库函数
	protected function connect()
	{
		$link = mysqli_connect($this->host, $this->user, $this->pwd);
		if (!$link) {
			die('数据库连接失败');
		}
		mysqli_select_db($link, $this->dbname);
		mysqli_set_charset($link, $this->charset);
		return $link;
	}
	
	//获取数据表名
	protected function getTableName()
	{
		//看用户是否设置了成员属性tableName ,如果设置了，以设置的为准，否则表名从类名中获取
		if (!empty($this->tableName)) {
			return $this->prefix . $this->tableName;
		}
		
		//从类名中获取   UserModel
		//获取类名很有可能获取到的是带有命名空间的类名  model\UserModel
		//自己实现
		$name = get_class($this);
		//$name有没有/,有的话先截取/后面一部分
		if (strstr($name,'\\')) {
			//name中最后一次出现/的位置
			$pos = strrpos($name, '\\');
			$name = substr($name, $pos + 1);
		}
		
		$table = strtolower(substr($name, 0, -5));
		return $this->prefix . $table;
	}
	
	//获取缓存字段的函数
	protected function cacheFields()
	{

		//思想是什么
		//判断这个缓存文件是否存在，如果存在，直接include进来
		$fileName = 'cache/cacheField/' . $this->tableName . '.php';

		//echo $fileName;
		if (file_exists($fileName)) {
			return include $fileName;
		}
		//如果不存在，生成这个文件
		//查询该表所有字段，然后写入到文件中
		$sql = 'desc ' . $this->tableName;
		$result = $this->query($sql);
		//var_dump($result);
		//提取每一行数据里面的第一个值，键是Field
		$fields = [];
		foreach ($result as $value) {
			$fields[] = $value['Field'];
			//将主键单独的保存起来
			if ($value['Key'] == 'PRI') {
				$fields['PRI'] = $value['Field'];
			}
		}
		//var_dump($fields);
		//将这个数组写入到文件中
		$str = "<?php \n return " . var_export($fields, true) . ';';
		//echo $str;

		file_put_contents($fileName, $str);
		return $fields;
	}
	
	//执行查询语句，将结果集以二维数组的形式返回给我
	protected function query($sql)
	{
		//将sql语句保存一份
		$this->sql = $sql;
		$result = mysqli_query($this->link, $sql);
		$newData = [];
		if ($result && mysqli_affected_rows($this->link)) {
			while ($data = mysqli_fetch_assoc($result)) {
				$newData[] = $data;
			}
		}
		//将options数组进行初始化到最原始的状态，每一次查询都应该在最原始状态上进行
		$this->initOptions();
		return $newData;
	}
	
	//外部获取sql语句的方法
	public function __get($name) 
	{
		if ($name == 'sql') {
			return $this->sql;
		}
		return false;
	}
	
	//释放数据库连接资源
	public function __destruct()
	{
		mysqli_close($this->link);
	}
	
	public function select()
	{
		//将完整的sql语句准备好
		$sql = 'select %field% from %table% %where% %group% %having% %order% %limit%';
		$sql = str_replace(
			['%field%', '%table%', '%where%', '%group%', '%having%', '%order%', '%limit%'],
			[$this->options['field'], $this->options['table'], $this->options['where'], $this->options['group'], $this->options['having'], $this->options['order'], $this->options['limit']],
			$sql
		);
		return $this->query($sql);
	}
	
	//传递字段的函数，兼容数组和字符串
	public function field($field)
	{
		if (is_array($field)) {
			$this->options['field'] = join(',', $field);
		} else if (is_string($field)) {
			$this->options['field'] = $field;

		}
		return $this;
	}
	
	public function table($table)
	{
		$this->options['table'] = $table;
		return $this;
	}
	
	public function where($where)
	{
		if (empty($where)) {
			return $this;
		}
		$this->options['where'] = ' where ' . $where;
		return $this;
	}
	
	public function group($group)
	{
		$this->options['group'] = ' group by ' . $group;
		return $this;
	}
	
	public function having($having)
	{
		$this->options['having'] = ' having ' . $having;
		return $this;
	}
	
	public function order($order)
	{
		$this->options['order'] = ' order by ' . $order;
		return $this;
	}
	
	public function limit($limit)
	{
		if (is_array($limit)) {
			$this->options['limit'] = ' limit ' . join(',', $limit);
		} else if (is_string($limit)) {
			$this->options['limit'] = ' limit ' . $limit;
		}
		return $this;
	}
	
	//插入函数  $data是一个关联数组
	public function insert($data)
	{
		//处理data中值为字符串的问题
		$data = $this->parseString($data);
		//过滤掉无效的字段
		$data = array_intersect_key($data, array_flip(array_unique($this->fields)));
		
		//取出所有的键和值
		$keys = join(',', array_keys($data));
		$values = join(',', array_values($data));
		
		$sql = 'insert into %table%(%fields%) values(%values%)';
		$sql = str_replace(
			['%table%', '%fields%', '%values%'],
			[$this->options['table'], $keys, $values],
			$sql
		);
		return $this->exec($sql, true);
	}

	protected function exec($sql, $isInsert = false)
	{
		$this->sql = $sql;
		$result = mysqli_query($this->link, $sql);
		//var_dump(mysqli_affected_rows($this->link));
		if ($result && mysqli_affected_rows($this->link)) {
			if ($isInsert) {
				return mysqli_insert_id($this->link);
			}
			return mysqli_affected_rows($this->link);
		}
		return false;
	}
	
	protected function parseString($data)
	{
		$newData = [];
		//遍历所有的值，如果值为字符串，添加引号即可
		foreach ($data as $key => $value) {
			if (is_string($value)) {
				$value = '\'' . $value . '\'';
			}
			$newData[$key] = $value;
		}
		return $newData;
	}
	
	//删除函数
	public function delete()
	{
		$sql = 'delete from %table% %where%';
		$sql = str_replace(['%table%', '%where%'], [$this->options['table'], $this->options['where']], $sql);
		return $this->exec($sql);
	}
	
	//$data是一个关联数组，更新的字段和值
	public function update($data)
	{
		//先处理值是字符串的问题
		$data = $this->parseString($data);
		//过滤字段
		$data = array_intersect_key($data, array_flip(array_unique($this->fields)));

		//在处理data   update user set name=goudan,age=100 where id=3
		$updateString = $this->parseUpdate($data);
		//写sql语句
		$sql = 'update %table% set %field% %where%';
		$sql = str_replace(
			['%table%', '%field%', '%where%'], 
			[$this->options['table'], $updateString, $this->options['where']],
			$sql);
		return $this->exec($sql);
	}
	
	// $data = ['name' => '狗蛋', 'age' => 100, 'height' => 180];
	// name='狗蛋',age=100,height=180
	protected function parseUpdate($data)
	{
		foreach ($data as $key => $value) {
			$arr[] = $key . '=' . $value;
		}
		return join(',', $arr);
	}
	
	//getByName('李文星');   getByAge   getByEmail   getByMoney
	public function __call($name, $args)
	{
		if (strstr($name, 'getBy')) {
			//取出字段名，取出字段值
			$field = strtolower(substr($name, 5));
			//var_dump($field);
			$value = $args[0];
			$result = $this->where($field . '="' . $value . '"')->select();
			if (empty($result)) {
				return $result;
			}
			return $result[0];
		}
		return false;
	}
	
	//统计函数   字段可以不传递，默认为主键
	public function max($field = null)
	{
		if (empty($field)) {
			$field = $this->fields['PRI'];
			
		}
		//var_dump($field);
		$sql = 'select max(' . $field . ') as m from ' . $this->options['table'];
		$result = $this->query($sql);
		return $result[0]['m'];
	}

	//统计总数,字段可以不传递，默认为主键
	public function counts($field = null)
	{
		if (empty($field))
		{
			$field = $this->fields['PRI'];
		}
		$sql = 'select count(' . $field .') as count from ' .$this->options['table'];
		$result = $this->query($sql);
		return $result[0]['count'];
	}
	
	//avg   sum   count
}










