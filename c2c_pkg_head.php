<?php

class BSPkgHead {

    var $dwLength = 0;
    var $dwSerialNo = 0;
    var $wVersion = 2;
    var $wCommand = 0;
    var $dwUin = 0;

    var $dwFlag = 0;
    var $dwResult = 0;
    var $dwClientIP = 0;
    var $wClientPort = 0;
    var $dwAccessServerIP = 0;
    var $wAccessServerPort = 0;
    var $dwAppInterfaceIP = 0;
    var $wAppInterfacePort = 0;
    var $dwAppServerIP = 0;
    var $wAppServerPort = 0;

    var $dwOperatorId = 0;
    var $sPassport = "1234567890";

    var $wSeconds = 0;
    var $dwUSeconds = 0;

    var $wCookie2Length = 35;
    var $cLegacy = 0;
    var $iSockfd = 0;
    var $dwSockChannel = 0;
    var $wPeerPort = 0;
    var $dwCommand = 0;
    var $wSvrLevelIndex = 0;
    var $bCookie2 = "123456789012345678";

    var $PASSPORT_LEN = 10;
    var $COOKIE2_LEN = 18;

    var $iPkgHeadLength = 105;

    function BSPkgHead() {
    }

    function getDwSerialNo() {
        return $this->dwSerialNo;
    }

    function setDwSerialNo($dwSerialNo) {
        $this->dwSerialNo = $dwSerialNo;
    }

    function getDwResult() {
        return $this->dwResult;
    }

    function setDwResult($dwResult) {
        $this->dwResult = $dwResult;
    }

    function Serialize(&$bs) {

        $bs->pushUint32_t($this->dwLength);
        $bs->pushUint32_t($this->dwSerialNo);
        $bs->pushUint16_t($this->wVersion);
        $bs->pushUint16_t($this->wCommand);
        $bs->pushUint32_t($this->dwUin);
        $bs->pushUint32_t($this->dwFlag);
        $bs->pushUint32_t($this->dwResult);
        $bs->pushUint32_t($this->dwClientIP);
        $bs->pushUint16_t($this->wClientPort);
        $bs->pushUint32_t($this->dwAccessServerIP);
        $bs->pushUint16_t($this->wAccessServerPort);
        $bs->pushUint32_t($this->dwAppInterfaceIP);
        $bs->pushUint16_t($this->wAppInterfacePort);
        $bs->pushUint32_t($this->dwAppServerIP);
        $bs->pushUint16_t($this->wAppServerPort);
        $bs->pushUint32_t($this->dwOperatorId);
        $bs->pushBytes($this->sPassport, $this->PASSPORT_LEN);
        $bs->pushUint16_t($this->wSeconds);
        $bs->pushUint32_t($this->dwUSeconds);
        $bs->pushUint16_t($this->wCookie2Length);
        $bs->pushByte($this->cLegacy);
        $bs->pushUint32_t($this->iSockfd);
        $bs->pushUint32_t($this->dwSockChannel);
        $bs->pushUint16_t($this->wPeerPort);
        $bs->pushUint32_t($this->dwCommand);
        $bs->pushUint16_t($this->wSvrLevelIndex);
        $bs->pushBytes($this->bCookie2, $this->COOKIE2_LEN);

        return $bs->isGood();
    }

    function UnSerialize(&$bs) {
        $this->dwLength = $bs->popUint32_t();
        $this->dwSerialNo = $bs->popUint32_t();
        $this->wVersion = $bs->popUint16_t();
        $this->wCommand = $bs->popUint16_t();
        $this->dwUin = $bs->popUint32_t();
        $this->dwFlag = $bs->popUint32_t();
        $this->dwResult = $bs->popUint32_t();
        $this->dwClientIP = $bs->popUint32_t();
        $this->wClientPort = $bs->popUint16_t();
        $this->dwAccessServerIP = $bs->popUint32_t();
        $this->wAccessServerPort = $bs->popUint16_t();
        $this->dwAppInterfaceIP = $bs->popUint32_t();
        $this->wAppInterfacePort = $bs->popUint16_t();
        $this->dwAppServerIP = $bs->popUint32_t();
        $this->wAppServerPort = $bs->popUint16_t();
        $this->dwOperatorId = $bs->popUint32_t();
        $this->sPassport = $bs->popBytes($this->PASSPORT_LEN);
        $this->wSeconds = $bs->popUint16_t();
        $this->dwUSeconds = $bs->popUint32_t();
        $this->wCookie2Length = $bs->popUint16_t();
        $this->cLegacy = $bs->popByte();
        $this->iSockfd = $bs->popUint32_t();
        $this->dwSockChannel = $bs->popUint32_t();
        $this->wPeerPort = $bs->popUint16_t();
        $this->dwCommand = $bs->popUint32_t();
        $this->wSvrLevelIndex = $bs->popUint16_t();
        $this->bCookie2 = $bs->popBytes($this->COOKIE2_LEN);

        return $bs->isGood();
    }

    function getDwClientIP() {
        return $this->dwClientIP;
    }

    function setDwClientIP($dwClientIP) {
        $this->dwClientIP = $dwClientIP;
    }

    function getDwCommand() {
        return $this->dwCommand;
    }

    function setDwCommand($dwCommand) {
        $this->dwCommand = $dwCommand;
        $this->wCommand = $dwCommand / 0x10000;
    }

    function getDwOperatorId() {
        return $this->dwOperatorId;
    }

    function setDwOperatorId($dwOperatorId) {
        $this->dwOperatorId = $dwOperatorId;
    }

    function getSPassport() {
        return $this->sPassport;
    }

    function setSPassport($passport) {
        $this->sPassport = $passport;
    }

    function getWClientPort() {
        return $this->wClientPort;
    }

    function setWClientPort($clientPort) {
        $this->wClientPort = $clientPort;
    }

    function getDwLength() {
        return $this->dwLength;
    }

    function setDwLength($dwLength) {
        $this->dwLength = $dwLength;
    }

    function dump() {
        echo "dwLength = ".$this->dwLength."\n";
        echo "dwSerialNo = ".$this->dwSerialNo."\n";
        echo "wVersion = ".$this->wVersion."\n";
        echo "wCommand = 0x".dechex($this->wCommand)."\n";
        echo "dwUin = ".$this->dwUin."\n";
        echo "dwResult = 0x".dechex($this->dwResult)."\n";
        echo "dwClientIP = 0x".dechex($this->dwClientIP)."\n";
        echo "wClientPort = 0x".dechex($this->wClientPort)."\n";
        echo "dwOperatorId = ".$this->dwOperatorId."\n";
        echo "sPassport = ".$this->sPassport."\n";
        echo "dwCommand = 0x".dechex($this->dwCommand)."\n";
    }

    function getDwUin() {
        return $this->dwUin;
    }

    function setDwUin($dwUin) {
        $this->dwUin = $dwUin;
    }

    function getWVersion() {
        return $this->wVersion;
    }

    function setWVersion($version) {
        $this->wVersion = $version;
    }
}


