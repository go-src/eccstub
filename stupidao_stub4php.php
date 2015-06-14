<?php
// source idl: com.paipai.common.agent.idl.StupidAo.java
require_once "stupidao_xxo.php";

class getDataReq {
	var $source;
	var $machineKey;
	var $sceneId;
	var $jsonInput;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->jsonInput = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化来源，传客户端IP或者__FILE__，必须 类型为std::string
		$bs->pushString($this->machineKey); // 序列化传用户的VisitKey，必须 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必须 类型为uint32_t
		$bs->pushString($this->jsonInput); // 序列化请求内容 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return $this->sceneId;
	}
}

class getDataResp {
	var $result;
	var $jsonOutput;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->jsonOutput = $bs->popString(); // 反序列化回包内容 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x87ab8001;
	}
}

class getData2Req {
	var $source;
	var $machineKey;
	var $sceneId;
	var $jsonInput;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->jsonInput = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化来源，传客户端IP或者__FILE__，必须 类型为std::string
		$bs->pushString($this->machineKey); // 序列化传用户的VisitKey，必须 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必须 类型为uint32_t
		$bs->pushString($this->jsonInput); // 序列化请求内容 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x87ab1002;
	}
}

class getData2Resp {
	var $result;
	var $jsonOutput;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->jsonOutput = $bs->popString(); // 反序列化回包内容 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x87ab8002;
	}
}
?>