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
		$bs->pushString($this->source); // ���л���Դ�����ͻ���IP����__FILE__������ ����Ϊstd::string
		$bs->pushString($this->machineKey); // ���л����û���VisitKey������ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����ID������ ����Ϊuint32_t
		$bs->pushString($this->jsonInput); // ���л��������� ����Ϊstd::string

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
		$this->jsonOutput = $bs->popString(); // �����л��ذ����� ����Ϊstd::string

	
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
		$bs->pushString($this->source); // ���л���Դ�����ͻ���IP����__FILE__������ ����Ϊstd::string
		$bs->pushString($this->machineKey); // ���л����û���VisitKey������ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����ID������ ����Ϊuint32_t
		$bs->pushString($this->jsonInput); // ���л��������� ����Ϊstd::string

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
		$this->jsonOutput = $bs->popString(); // �����л��ذ����� ����Ϊstd::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x87ab8002;
	}
}
?>