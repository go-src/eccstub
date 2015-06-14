<?php
include "lang_util.php";

class ByteStream {

    var $m_byPackage = null;
    var $m_iBufLen = 0;
    var $m_iOffset = 0;
    var $m_bGood = true;
    var $m_bRealWrite = true;

    function ByteStream() {
        $this->m_iBufLen = 0;
        $this->m_iOffset = 0;
        $this->m_bGood = true;
        $this->m_bRealWrite = true;
    }

    function setBuffer4Unserialze(&$byBuffer) {
        $this->m_byPackage = $byBuffer;
        $this->m_iBufLen = strlen($this->m_byPackage);
        $this->m_iOffset = 0;
        $this->m_bGood = true;
        $this->m_bRealWrite = true;
    }

    function setRealWrite($bRealWrite) {
        $this->m_bRealWrite = $bRealWrite;
    }

    function getWrittenBuffer()    {
        return $this->m_byPackage;
    }

    function getWrittenLength()    {
        return $this->m_iOffset;
    }

    function getReadLength()    {
        return $this->m_iOffset;
    }

    function isGood()    {
        return $this->m_bGood;
    }

    /*
     * bool
     */
    function pushBool($b) {
        $v = 0;
        if($b)
            $v = 1;

        $this->pushByte($v);
    }

    function popBool() {
        $v = $this->popByte();
        if($v != 0)
            return true;

        return false;
    }

    /*
     * uint8_t
     */
    function pushUint8_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset++;
            return;
        }
        
    	$o = new uint8_t();
    	$o->setValue($v);
    	$this->m_byPackage .= $o->getBytes();
    	++$this->m_iOffset;
    }
    
    function popUint8_t() {
        if (!$this->m_bGood || ($this->m_iOffset + 1) > $this->m_iBufLen) {
            $this->m_bGood = false;
            return;
        }
        $o = new uint8_t();
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 1);
        $o->setBytes($bytes);
    	++$this->m_iOffset;
        return $o->getValue();
    }

    function pushUByte($v) {
    	return $this->pushUint8_t($v);
    }
    
    function popUByte() {
    	return $this->popUint8_t();
    }
    
    /**
     * int8_t
     **/
    function pushInt8_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset++;
            return;
        }
        
    	$o = new int8_t();
    	$o->setValue($v);
    	$this->m_byPackage .= $o->getBytes();
    	++$this->m_iOffset;
    }
    
    function popInt8_t() {
        if (!$this->m_bGood || ($this->m_iOffset + 1) > $this->m_iBufLen) {
            $this->m_bGood = false;
            return;
        }
        $o = new int8_t();
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 1);
        $o->setBytes($bytes);
    	++$this->m_iOffset;
        return $o->getValue();
    }

    function pushByte($v)    {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset++;
            return;
        }

        if(!is_int($v))
            $byte = pack("a", $v);
        else
            $byte = pack("i", $v);

        $this->m_byPackage .= $byte[0];
        ++$this->m_iOffset;
    }

    function popByte() {
        if (!$this->m_bGood || ($this->m_iOffset + 1) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        list($v) = array_values(unpack("C", substr($this->m_byPackage, $this->m_iOffset, 1)));
        ++$this->m_iOffset;
        return $v;
    }
    
    /*
     * uint16_t
     */
    function pushUint16_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 2;
            return;
        }

        $o = new uint16_t();
        $o->setValue($v);
        $this->m_byPackage .= $o->getBytes();
        
        $this->m_iOffset += 2;
    }

    function popUint16_t() {
        if (!$this->m_bGood || ($this->m_iOffset + 2) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 2);
        $this->m_iOffset += 2;
        $o = new uint16_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }
    
    /*
     * int16_t
     */
    function pushInt16_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 2;
            return;
        }

        $o = new int16_t();
        $o->setValue($v);
        $this->m_byPackage .= $o->getBytes();
        
        $this->m_iOffset += 2;
    }

    function popInt16_t() {
        if (!$this->m_bGood || ($this->m_iOffset + 2) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 2);
        $this->m_iOffset += 2;
        $o = new int16_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }
    
    /**
     * Short: alias of int16_t
     **/
    function pushShort($v) {
        return $this->pushInt16_t($v);
    }
    
    function popShort() {
        return $this->popInt16_t();
    }

    /*
     * uint32_t
     */
    function pushUint32_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 4;
            return;
        }

        $o = new uint32_t();
        $o->setValue($v);
        $this->m_byPackage .= $o->getBytes();
        
        $this->m_iOffset += 4;
    }

    function popUint32_t()    {
        if (!$this->m_bGood || ($this->m_iOffset + 4) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 4);
        $this->m_iOffset += 4;
        $o = new uint32_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }

    /**
     * int32_t
     **/
    function pushInt32_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 4;
            return;
        }

        $o = new int32_t();
        $o->setValue($v);
        $this->m_byPackage .= $o->getBytes();
        
        $this->m_iOffset += 4;
    }

    function popInt32_t()    {
        if (!$this->m_bGood || ($this->m_iOffset + 4) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 4);
        $this->m_iOffset += 4;
        $o = new int32_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }
    
    /**
     * Int代表int32_t
     **/
    function pushInt($v) {
        return $this->pushInt32_t($v);
    }
    
    function popInt() {
        return $this->popInt32_t();
    }
    
    /*
     * uint64_t
     */
    function pushUint64_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 17;
            return;
        }

        $o = new uint64_t();
        $o->setValue($v);
        $this->m_byPackage .= $o->getBytes();
        
        $this->m_iOffset += 17;
    }

    function popUint64_t()    {
        if (!$this->m_bGood || ($this->m_iOffset + 17) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 17);
        $this->m_iOffset += 17;
        $o = new uint64_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }
    
    /*
     * int64_t
     */
    function pushInt64_t($v) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 17;
            return;
        }

        $o = new int64_t();
        $o->setValue($v);
        $bytes = $o->getBytes();
        echo ( 'uint64_t length='. strlen($bytes)."<hr />" );
        $this->m_byPackage .= $bytes;
        
        $this->m_iOffset += 17;
    }

    function popInt64_t()    {
        if (!$this->m_bGood || ($this->m_iOffset + 17) > $this->m_iBufLen)    {
            $this->m_bGood = false;
            return;
        }
        
        $bytes = substr($this->m_byPackage, $this->m_iOffset, 17);
        $this->m_iOffset += 17;
        $o = new int64_t();
        $o->setBytes($bytes);
        return $o->getValue();
    }
    
    /**
     * Long是64位 int64_t
     **/
    function pushLong($v) {
        return $this->pushInt64_t($v);
    }
    
    function popLong() {
        return $this->popInt64_t();
    }

    /*
     * string
     */
    function pushString($v)    {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += 4;
            $this->m_iOffset += strlen($v);
            return;
        }

        $len = strlen($v);
        $this->pushUint32_t($len);

        $str = pack("a*", $v);
        $this->m_byPackage .= $str;
        $this->m_iOffset += $len;
    }

    function popString() {
        $len = $this->popUint32_t();
        if (!$this->m_bGood || ($this->m_iOffset + $len) > $this->m_iBufLen) {
            $this->m_bGood = false;
            return;
        }
        
        list($v) = array_values(unpack("a*", substr($this->m_byPackage, $this->m_iOffset, $len)));
        $this->m_iOffset += $len;
        return $v;
    }

    function pushBytes($v, $len) {
        if (!$this->m_bRealWrite)    {
            $this->m_iOffset += $len;
            return;
        }
        for($i = 0; $i < $len; ++$i)
            $this->pushByte($v[$i]);
    }

    function popBytes($len)    {
        if (!$this->m_bGood || ($this->m_iOffset + $len) > $this->m_iBufLen) {
            $this->m_bGood = false;
            return;
        }
        $result = null;
        for($i = 0; $i < $len; ++$i)
            $result .= chr($this->popByte());

        return $result;
    }
    
    function pushObject($object, $type = 'uint32_t') {
    	$base_types = explode(',', 'uint8_t,uint16_t,uint32_t,uint64_t');
    	if (in_array($type, $base_types)) {
    		//var_dump("push base type $type");
    		$obj = new $type();
    		if (!is_object($object)) {
    			$obj->setValue($object);
    		} else if (method_exists($object, 'getValue')) {
    			$obj->setValue($object->getValue());
    		} else {
    			$obj->setValue(0);
    		}
    		$b = $obj->getBytes();
    		$len = $obj->getSize();
    		
    		// 若是统计长度，则不做实质操作，只增加长度
	        if (!$this->m_bRealWrite)    {
	            $this->m_iOffset += $len;
	            return;
	        }
	        
    		$this->m_byPackage .= $b;
    		$this->m_iOffset += $len;
    		return true;
    	//} elseif ($object instanceof ICanSerializeObject) {
    	} elseif (method_exists($object, 'serialize')) {
    		//var_dump("push object $type");
    		// 递归解析
    		//return call_user_method('serialize', $object, $this);
            return call_user_func(array($object, 'serialize'), $this);
    	} elseif (is_int($object)) {
    		//var_dump("push int $object");
    		return $this->pushUint32_t($object);
    	} elseif (is_string($object)) {
    		//var_dump("push string $object");
    		return $this->pushString($object);
    	} else {
    		return false;
    	}
    }
    
    /**
     * 通用的pop，由参数$type来调用各反序列化
     * $type 的可能值：
     * 1. uint8_t, uint16_t, uint32_t, uint64_t
     * 2. int, short, string
     * 3. stl_map<uint32_t,string>, stl_vector<stl_map<uint32_t,string>>
     * 4. class name which implements ICanSerializeObject
     *
     * @param string $type
     * @return mixed $object
     */
    function popObject($type = 'uint8_t') {
    	// 扩展的数字类型
        $type = strtolower($type);
    	if (substr($type, 0, 4) == 'uint' && class_exists($type)) {
    		//var_dump('pop extended numbers');
    		$obj = new $type();
    		$len = $obj->getSize();
    		
    		$bytes = substr($this->m_byPackage, $this->m_iOffset, $len);
    		$obj->setBytes($bytes);
	        
    		$object_value = $obj->getValue();
    		
    		//var_dump('len='.$len);
    		$this->m_iOffset += $len;
    		//var_dump('pop object='.$object_value);
    		return $object_value;
    	}
    	// stl_map容器
    	elseif (substr($type, 0, 7) == 'stl_map') {
    		//var_dump('pop stl_map');
    		$type = str_replace(' ', '', $type);
    		$lt_pos = strpos($type, '<');
    		$gt_pos = strrpos($type, '>');
    		$comma_pos = strpos($type, ',');
    		
    		if ($lt_pos === false || $gt_pos === false || $comma_pos === false) {
    			//var_dump("Invalid stl_map type $type");
    			return false;
    		}
    		
    		$key_type = substr($type, $lt_pos + 1, $comma_pos - $lt_pos - 1);
    		$value_type = substr($type, $comma_pos + 1, $gt_pos - $comma_pos - 1);
    		
    		//var_dump($key_type, $value_type);
    		
    		$map = new stl_map();
    		$map->setType($key_type, $value_type);
    		$object_value = $map->unserialize($this);
    		//var_dump('pop object=');
    		//print_r($object_value);
    		return $object_value;
    	}
        elseif (substr($type, 0, 10) == 'stl_bitset') {
    		$type = str_replace(' ', '', $type);
    		$lt_pos = strpos($type, '<');
    		$gt_pos = strrpos($type, '>');
    		
    		$bitset_size = intval(substr($type, $lt_pos + 1, $gt_pos - $lt_pos - 1));
    		
            //var_dump('bitset_size='.$bitset_size);
    		$vec = new stl_bitset($bitset_size);
    		$object_value = $vec->unserialize($this);
    		//var_dump('pop object='.$object_value);
    		return $object_value;
        }
    	// stl_vector, stl_list, stl_set, stl_bitset
    	elseif (substr($type, 0, 4) == 'stl_' && $type!='stl_string') {
    		//var_dump('pop stl_vector');
    		$type = str_replace(' ', '', $type);
    		$lt_pos = strpos($type, '<');
    		$gt_pos = strrpos($type, '>');
    		
    		if ($lt_pos === false || $gt_pos === false) {
    			//var_dump("Invalid stl_vector type $type");
    			return false;
    		}
    		
    		$value_type = substr($type, $lt_pos + 1, $gt_pos - $lt_pos - 1);
    		
    		$vec = new stl_list();
    		$vec->setType($value_type);
    		$object_value = $vec->unserialize($this);
    		//var_dump('pop object='.$object_value);
    		return $object_value;
    	}
    	// ICanSerializeObject
    	elseif (class_exists($type) && method_exists($type, 'unserialize')) {
    		//var_dump('class_exists($type) && method_exists($type, unserialize)');
    		$object = new $type();
    		$object_value = $object->unserialize($this);
    		//var_dump('pop object='.$object_value);
    		return $object_value;
    	} elseif ($type=='int') {
    		return $this->popInt();
    	} elseif ($type=='string' || $type=='stl_string') {
    		$object_value = $this->popString();
    		//var_dump('pop object='.$object_value);
    		return $object_value;
    	} else {
    		return false;
    	}
    }
}


