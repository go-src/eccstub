<?php
///////////////////////////////////////////////
// 基本类型重写
// 有Bug、建议可以联系mikeliang

// 无符号整数，8位
class uint8_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 1;
	}
	
	function getBytes() {
		$n = intval($this->value);
		$b = pack('C', $n);
		return $b;
	}	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint8_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('C', $b);
		$i = $unpacked[1];
		$this->value = $i;
	}
}

// 有符号整数，8位
class int8_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 1;
	}
	
	function getBytes() {
		$n = intval($this->value);
		$b = pack('c', $n);
		return $b;
	}	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint8_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('c', $b);
		$i = $unpacked[1];
		$this->value = $i;
	}
}

// 无符号整数，16位
class uint16_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 2;
	}
	
	function getBytes() {
		$i = intval($this->value);
		$c1 = intval($i / 256);
		$c2 = intval($i % 256);
		$b = pack('C2', $c1, $c2);
		//echo bin2hex($b);
		return $b;
	}
	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint16_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('C2', $b);
		$i = $unpacked[1] * 256 + $unpacked[2];
		$this->value = $i;
	}
}

// 有符号整数，16位
class int16_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 2;
	}
	
	function getBytes() {
		$i = intval($this->value);
		$c1 = intval($i / 256);
		$c2 = intval($i % 256);
		$b = pack('c2', $c1, $c2);
		//echo bin2hex($b);
		return $b;
	}
	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint16_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('c2', $b);
		$i = $unpacked[1] * 256 + $unpacked[2];
		$this->value = $i;
	}
}

// 无符号整数，32位
class uint32_t {
	var $value = 0;
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 4;
	}
	
	function getBytes() {
		$i = $this->value;
		$c1 = intval(bcdiv($i, 16777216, 0));
		$c2 = intval(bcmod($i, 16777216) / 65536);
		$c3 = intval(bcmod($i, 65536) / 256);
		$c4 = intval(bcmod($i, 256));
		$b = pack('C4', $c1, $c2, $c3, $c4);
		return $b;
	}
	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint32_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('C4', $b);
		list(, $c1, $c2, $c3, $c4) = $unpacked;
		$i = $c4;
		$i = bcadd($i, $c3 * 256);
		$i = bcadd($i, $c2 * 65536);
		$i = bcadd($i, bcmul($c1, 16777216));
		$this->value = $i;
	}
}

// 有符号整数，32位
class int32_t {
	var $value = 0;
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 4;
	}
	
	function getBytes() {
		$i = sprintf("%u", $this->value);
		$c1 = intval(bcdiv($i, 16777216, 0));
		$c2 = intval(bcmod($i, 16777216) / 65536);
		$c3 = intval(bcmod($i, 65536) / 256);
		$c4 = intval(bcmod($i, 256));
		$b = pack('C4', $c1, $c2, $c3, $c4);
		return $b;
	}
	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint32_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('C4', $b);
		list(, $c1, $c2, $c3, $c4) = $unpacked;
		$i = $c4;
		$i = bcadd($i, $c3 * 256);
		$i = bcadd($i, $c2 * 65536);
		$i = bcadd($i, bcmul($c1, 16777216));

        $bin = decbin($i);
        if (strlen($bin) == 32 && $bin[0] == '1') {
            $i = -1 * (0xFFFFFFFF - $i + 1);
        }
		$this->value = $i;
	}
}

// int 是32位有符号整数的一个别名
class int extends int32_t {};

// 无符号整数，64位
class uint64_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 17;
	}
	
	function getBytes() {
		$i = $this->value;
		$c1 = intval(bcdiv($i, '72057594037927936'));
		$c2 = intval(bcdiv(bcmod($i, '72057594037927936'), '281474976710656'));
		$c3 = intval(bcdiv(bcmod($i, '281474976710656'), '1099511627776'));
		$c4 = intval(bcdiv(bcmod($i, '1099511627776'), '4294967296'));
		$c5 = intval(bcdiv(bcmod($i, '4294967296'), 16777216));
		$c6 = intval(bcmod($i, 16777216) / 65536);
		$c7 = intval(bcmod($i, 65536) / 256);
		$c8 = intval(bcmod($i, 256));
		//$b = pack('C8', $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
        $b = "";
        for ($i=1; $i<=8; $i++) {
            $var = "c$i";
            $b .= str_pad(dechex($$var), 2, '0', STR_PAD_LEFT);
        }
        $b .= "\0";
		return $b;
	}	
	
	/**
	 * 赋值函数，32位机器下，可用字符串表示数字，免得精度丢失
	 *
	 * @param uint or string $v
	 * @return boolean
	 */
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint64_t )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = array_pop(unpack('a*', $b));
        if ($unpacked == "") {
            $this->value = 0;
            return true;
        }
        $chunks = chunk_split($unpacked, 2, ',');
		list($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8) = explode(',', $chunks);
        //var_dump($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
        for ($i=1; $i<=8; $i++) {
            $var = "c$i";
            $$var = hexdec($$var);
        }
		$i = $c8;
		$i = bcadd($i, $c7 * 256);
		$i = bcadd($i, $c6 * 65536);
		$i = bcadd($i, $c5 * 16777216);
		$i = bcadd($i, bcmul($c4, '4294967296'));
		$i = bcadd($i, bcmul($c3, '1099511627776'));
		$i = bcadd($i, bcmul($c2, '281474976710656'));
		$i = bcadd($i, bcmul($c1, '72057594037927936'));
		$this->value = $i;
	}
}

// 有符号整数，64位, TODO
class int64_t {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 17;
	}
	
	function getBytes() {
		$i = $this->value;
        $i = sprintf("%u", $i);
		$c1 = intval(bcdiv($i, '72057594037927936'));
		$c2 = intval(bcdiv(bcmod($i, '72057594037927936'), '281474976710656'));
		$c3 = intval(bcdiv(bcmod($i, '281474976710656'), '1099511627776'));
		$c4 = intval(bcdiv(bcmod($i, '1099511627776'), '4294967296'));
		$c5 = intval(bcdiv(bcmod($i, '4294967296'), 16777216));
		$c6 = intval(bcmod($i, 16777216) / 65536);
		$c7 = intval(bcmod($i, 65536) / 256);
		$c8 = intval(bcmod($i, 256));
		//$b = pack('C8', $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
        $b = "";
        for ($i=1; $i<=8; $i++) {
            $var = "c$i";
            $b .= str_pad(dechex($$var), 2, '0', STR_PAD_LEFT);
        }
        $b .= "\0";
        
        echo ("getBytes: $b,  strlen = ".strlen($b).";<hr />");
		return $b;
	}	
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) ) {
            // 先强行转换成无符号
			$this->value = $v;
        }
		else if( is_null($v) ) {
			$this->value=0;
        }
		else if( $v instanceof uint64_t ) {
			$this->value=$v->value;
        }
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = array_pop(unpack('a*', $b));
        $chunks = chunk_split($unpacked, 2, ',');
		list($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8) = explode(',', $chunks);
        //var_dump($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
        for ($i=1; $i<=8; $i++) {
            $var = "c$i";
            $$var = hexdec($$var);
        }
		$i = $c8;
		$i = bcadd($i, $c7 * 256);
		$i = bcadd($i, $c6 * 65536);
		$i = bcadd($i, $c5 * 16777216);
		$i = bcadd($i, bcmul($c4, '4294967296'));
		$i = bcadd($i, bcmul($c3, '1099511627776'));
		$i = bcadd($i, bcmul($c2, '281474976710656'));
		$i = bcadd($i, bcmul($c1, '72057594037927936'));
		$this->value = $i;
	}
}

// long 是64位有符号整数的一个别名
class long extends int64_t {};


class uint64_t_raw {
	var $value = "";
	
	function __construct($v = 0) {
	    $this->setValue($v);
	}
	
	function getValue()	{
		return $this->value;
	}
	
	function getSize() {
		return 17;
	}
	
	function getBytes() {
		$i = $this->value;
		$c1 = intval(bcdiv($i, '72057594037927936'));
		$c2 = intval(bcdiv(bcmod($i, '72057594037927936'), '281474976710656'));
		$c3 = intval(bcdiv(bcmod($i, '281474976710656'), '1099511627776'));
		$c4 = intval(bcdiv(bcmod($i, '1099511627776'), '4294967296'));
		$c5 = intval(bcdiv(bcmod($i, '4294967296'), 16777216));
		$c6 = intval(bcmod($i, 16777216) / 65536);
		$c7 = intval(bcmod($i, 65536) / 256);
		$c8 = intval(bcmod($i, 256));
		$b = pack('C8', $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
		return $b;
	}
	
	function setValue($v) {	//toxot change 2011-09-06
		if( is_numeric($v) )
			$this->value = $v;
		else if( is_null($v) )
			$this->value=0;
		else if( $v instanceof uint64_t_raw )
			$this->value=$v->value;
		else 
			return false;
	}
	
	function setBytes($b) {
		$unpacked = unpack('C8', $b);
		list(, $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8) = $unpacked;
		$i = $c8;
		$i = bcadd($i, $c7 * 256);
		$i = bcadd($i, $c6 * 65536);
		$i = bcadd($i, $c5 * 16777216);
		$i = bcadd($i, bcmul($c4, '4294967296'));
		$i = bcadd($i, bcmul($c3, '1099511627776'));
		$i = bcadd($i, bcmul($c2, '281474976710656'));
		$i = bcadd($i, bcmul($c1, '72057594037927936'));
		$this->value = $i;
	}
}

/////////////////////////////////////////////////
// 可序列化接口
/**
 * 可序列化对象的公共基类
 */
interface ICanSerializeObject {
	/**
	 * 序列化
	 * 
	 * @param $bs
	 * @return int
	 * @throws Exception
	 */
	public function serialize($bs);
	
	/**
	 * 反序列化
	 * 
	 * @param $bs
	 * @return int
	 * @throws Exception
	 */
	public function unserialize($bs);
}

//////////////////////////////////////////////////
// STL容器包装
class stl_list extends ArrayIterator implements ICanSerializeObject {
	var $element_type;
	var $size;
	var $value = array();


	function  __construct($arr_value=null){

		if($arr_value&&is_array($arr_value)){
			parent::__construct($arr_value);
			$this->setValue($arr_value);
		}
	}



	function size() {
		return $this->size;
	}

	function getSize() {
		return $this->size;
	}

	function getValue() {
		return $this->value;
	}

	function setType($type) {
		return $this->element_type = $type;
	}

	function setValue($arr_value) {
		if (count($arr_value) < 1) {
			return false;
		}
		$this->size = count($arr_value);
		$this->value = $arr_value;
		foreach ($arr_value as $v) {
			if (is_object($v)) {
				$this->element_type = get_class($v);
			}
			// run once
			break;
		}

		//清空数据
		for($this->rewind();$this->valid();$this->next()){
			$this->offsetUnset($this->key());
		}
		//赋值新数据至ArrayIterator
		for($i=0;$i<count($arr_value);$i++){
			$this[$i]=$arr_value[$i];
		}
	}

	function serialize($bs) {
		$bs->pushUint32_t($this->size);
		for ($i=0; $i<$this->size; $i++) {
			$bs->pushObject($this->value[$i], $this->element_type);
		}
	}

	function unserialize($bs) {
		$size = $bs->popUint32_t();
		//var_dump('vector size='.$this->size);
		$value = array();
		for ($i=0; $i<$size; $i++) {
			$value[] = $bs->popObject($this->element_type);
		}
		$this->setValue($value);
		return $this;
		//return $this->value;
	}


}

/*
// 兼容php < 5.3
if (!function_exists('class_alias')) {
    function class_alias($original, $alias) {
        eval('abstract class ' . $alias . ' extends ' . $original . ' {}');
    }
}
*/

// 用继承的方法代替类别名
class stl_vector extends stl_list{};
class stl_set extends stl_list{};
//class stl_bitset extends stl_list{};

// bitset 特殊处理
class stl_bitset implements ICanSerializeObject {
    var $size = 0;

    var $value = array();

    function __construct($size) {
        $this->size = intval($size);
    }

    function size() {
        return $this->size;
    }

    function getSize() {
        return $this->size;
    }
	
	function getValue() {
		return $this->value;
	}
	
	function setValue($arr_value) {
		if (!is_array($arr_value) || count($arr_value) < 1) {
			return false;
		}
		$this->size = count($arr_value);
		$this->value = array();
		foreach ($arr_value as $k => $v) {
			$this->value[$k] = $v ? 1 : 0;
		}
	}
	
	function serialize($bs) {
		$bs->pushUint32_t($this->size);
		foreach ($this->value as $k=>$v) {
			$bs->pushUint8_t($v);
		}
	}
	
	function unserialize($bs) {
		$this->size = $bs->popUint32_t();
        //var_dump('stl_bitset.size()='.$this->size);
		$this->value = array();
		for ($i=0; $i<$this->size; $i++) {
			$v = $bs->popUint8_t();
			$this->value[$i] = $v;
            //var_dump("value[$i]=".$v);
		}
		return $this->value;
	}
}

class stl_map extends ArrayIterator implements ICanSerializeObject {
	var $key_type;
	var $element_type;
	var $size;
	/**
	 * 原始值，原型如下：
	 * array(
	 * 	$key => $value,
	 * 	$key => $value,
	 * 	$key => $value,
	 * )
	 *
	 * @var stl_map_value
	 */
	var $value = array();


	public function __construct($arr_value=NULL){
		if($arr_value&&is_array($arr_value)){
			parent::__construct($arr_value);
			$this->setValue($arr_value);
		}
	}


	function size() {
		return $this->size;
	}

	function getSize() {
		return $this->size;
	}

	function setType($key_type, $value_type) {
		$this->key_type = $key_type;
		$this->element_type = $value_type;
	}

	function getValue() {
		return $this->value;
	}

	function setValue($arr_value) {
		if (count($arr_value) < 1) {
			return false;
		}
		$this->size = count($arr_value);
		$this->value = $arr_value;
		foreach ($arr_value as $k => $v) {
			if (is_object($k)) {
				$this->key_type = get_class($k);
			}
			if (is_object($v)) {
				$this->element_type = get_class($v);
			}
			// run once
			break;
		}

		//清空数据
		for($this->rewind();$this->valid();$this->next()){
			$this->offsetUnset($this->key());
		}
		foreach ($this as $key=>$value){
			unset($this[$key]);
		}
		
		//赋值新数据至ArrayIterator
		foreach ($arr_value as $k=>$v){			
			$this[$k]=$v;
		}



	}

	function serialize($bs) {
		$bs->pushUint32_t($this->size);
		foreach ($this->value as $k=>$v) {
			$bs->pushObject($k, $this->key_type);
			$bs->pushObject($v, $this->element_type);
		}
	}

	function unserialize($bs) {
		$size = $bs->popUint32_t();
		$value = array();
		//var_dump('stl_map unserialize: '.$this->key_type.
		//	' -> '.$this->element_type.
		//	', size='.$this->size);
		for ($i=0; $i<$size; $i++) {
			$k = $bs->popObject($this->key_type);
			$v = $bs->popObject($this->element_type);
			//var_dump('key='.$k.', value='.$v);
			$value[$k] = $v;
		}
		$this->setValue($value);		
		return $this;
	}
}

class stl_multimap implements ICanSerializeObject {
	var $key_type;
	var $element_type;
	var $size;
	
	/**
	 * $value原型：$key可以重复
	 * 	array(
	 * 		array($key, $value),
	 * 		array($key, $value),
	 * 		array($key, $value)
	 * )
	 *
	 * @var stl_multimap_value
	 */
	var $value = array();
	
	function size() {
		return $this->size;
	}
	
	function getSize() {
		return $this->size;
	}
	
	function setType($key_type, $value_type) {
		$this->key_type = $key_type;
		$this->element_type = $value_type;
	}
	
	function getValue() {
		return $this->value;
	}
	
	function setValue($arr_value) {
		if (count($arr_value) < 1) {
			return false;
		}
		$this->size = count($arr_value);
		$this->value = $arr_value;
		foreach ($arr_value as $element) {
			if (count($element) != 2) {
				return false;
			}
			list($k, $v) = $element;
			if (is_object($k)) {
				$this->key_type = get_class($k);
			}
			if (is_object($v)) {
				$this->element_type = get_class($v);
			}
			// run once
			break;
		}
		
		
	}
	
	function serialize($bs) {
		$bs->pushUint32_t($this->size);
		foreach ($this->value as $element) {
			list($k, $v) = $element;
			$bs->pushObject($k, $this->key_type);
			$bs->pushObject($v, $this->element_type);
		}
	}
	
	function unserialize($bs) {
		$this->size = $bs->popUint32_t();
		$this->value = array();
		for ($i=0; $i<$this->size; $i++) {
			$k = $bs->popObject($this->key_type);
			$v = $bs->popObject($this->element_type);
			$this->value[] = array($k, $v);
		}
		return $this->value;
	}
}

