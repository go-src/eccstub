<?php
/*require_once "web_stub_cntl.php";
require_once "stupidao_stub4php.php";

$cntl = new WebStubCntl();
$cntl->setPeerIPPort('10.12.197.237', 53101);

$req = new getDataReq();
$req->sceneId = $arg[1];

$resp = new getDataResp();
$ret = $cntl->invoke($req, $resp);

var_dump(dechex($ret), $resp);*/

for ($i =0; $i< 1000; $i++) {
	bcmod(bcmul("22939296725642118827540023027802402892661708801", $i), 368934881);
}

var_dump($i);