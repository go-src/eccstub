package main

import (
	"bufio"
	"bytes"
	"encoding/binary"
	"fmt"
	"net"
)

func makePkgHead(cmd uint32, bodylen uint32) *bytes.Buffer {
	buf := new(bytes.Buffer)
	headlen := uint32(105)
	total := uint32(1 + headlen + bodylen + 1)
	passport := make([]byte, 10)
	cookie := make([]byte, 18)
	var data = []interface{}{
		uint32(total), //Length
		uint32(0),     //Serial No
		uint16(2),     //version
		uint16(0),     //wCommand
		uint32(0),     //uin
		uint32(0),     //flag
		uint32(0),     //result
		uint32(0),     //client ip
		uint16(0),     //client port
		uint32(0),     //server ip
		uint16(0),     //server port
		uint32(0),     //interface ip
		uint16(0),     //interface port
		uint32(0),     //app server ip
		uint16(0),     //app server port
		uint32(0),     //operator id
		passport,      //passport
		uint16(0),     //seconds
		uint32(0),     //useconds
		uint16(0),     //cookie length
		uint8(0),      //Legacy
		uint32(0),     //sockfd
		uint32(0),     //sock channel
		uint16(0),     //peer port
		uint32(9900),  //dwCommand
		uint16(0),     //server level index
		cookie,        //cookies
	}

	for _, v := range data {
		err := binary.Write(buf, binary.BigEndian, v)
		if err != nil {
			fmt.Println("binary write failed: ", err)
		}
	}
	return buf
}

func makebody() *bytes.Buffer {
	body := new(bytes.Buffer)
	source := "call_from_golang"
	mk := "empty_machine_key"
	sceneId := uint32(0x9000)
	json := "{\"banner1\":[{\"id\":1,\"url\":\"http://www.paipai.com/m2/2014/import/2940/index.shtml?ptag=20589.21.1&app=1\",\"title\":\"母亲节 让爱蔓延\",\"img\":\"1.jpg\",\"sImg\":\"http://pics0.paipaiimg.com/update/20150429/index_100-100.jpg\",\"sText\":\"这个母亲节，让爱蔓延整个拍拍\",\"sTitle\":\"母亲节 让爱蔓延\",\"iShare\":\"1\"},{\"id\":2,\"url\":\"http://www.paipai.com/m2/2014/import/2920/index.shtml?ptag=20526.1.1&app=1\",\"title\":\"登山季必游景点&装备\",\"img\":\"2.jpg\",\"sImg\":\"http://pics2.paipaiimg.com/update/20150428/baby_100-100.jpg\",\"sText\":\"登山季必游景点&必备装备\",\"sTitle\":\"今天你爬山了么？\",\"iShare\":\"1\"},{\"id\":3,\"url\":\"http://www.paipai.com/m2/2014/import/2888/index.shtml?ptag=20526.1.1&app=1\",\"title\":\"潮流轮回 时尚不死\",\"img\":\"3.jpg\",\"sImg\":\"http://pics0.paipaiimg.com/update/20150429/index_10183063.jpg\",\"sText\":\"一起来做弄潮人\",\"sTitle\":\"潮流轮回 时尚不死\",\"iShare\":\"1\"},{\"id\":4,\"url\":\"http://www.paipai.com/m2/2014/8700/index.shtml?ptag=20526.1.1&app=1\",\"title\":\"世界那么大 带上防晒装备去看看！\",\"img\":\"4.jpg\",\"sImg\":\"http://s.paipaiimg.com/ppms/img/20150429/index_100-100-11.jpg\",\"sText\":\"刚脱掉秋裤，夏天就华丽丽的来，没有白花花的皮肤，怎么好意思露大腿呢！美白，需要真正有效的防晒，夏日防晒看这里！\",\"sTitle\":\"夏日防晒攻略\",\"iShare\":\"1\"},{\"id\":5,\"url\":\"http://www.paipai.com/m2/2014/8696/index.shtml?ptag=20526.1.1&app=1\",\"title\":\"平阴玫瑰节\",\"img\":\"5.jpg\",\"sImg\":\"http://pics3.paipaiimg.com/update/20150429/index_172907833.jpg\",\"sText\":\"吃平阴玫瑰，享浪漫双人游！\",\"sTitle\":\"平阴玫瑰节\",\"iShare\":\"1\"},{\"id\":6,\"url\":\"http://www.paipai.com/m2/2014/8711/index.shtml?ptag=20526.1.1&app=1\",\"title\":\"凤凰涅 设计师品牌 \",\"img\":\"6.jpg\",\"sImg\":\"http://pics1.paipaiimg.com/update/20141226/index_153155701.png\",\"sText\":\"全场低至19.9元 限量秒杀 仅限4天\",\"sTitle\":\"凤凰涅 清凉盛惠\",\"iShare\":\"1\"}]}"

	binary.Write(body, binary.BigEndian, len(source))
	binary.Write(body, binary.BigEndian, []byte(source))
	binary.Write(body, binary.BigEndian, len(mk))
	binary.Write(body, binary.BigEndian, []byte(mk))
	binary.Write(body, binary.BigEndian, sceneId)
	binary.Write(body, binary.BigEndian, len(json))
	binary.Write(body, binary.BigEndian, []byte(json))

	return body
}

func main() {
	headlen := uint32(105)
	body := makebody()
	bodylen := uint32(body.Len())
	head := makePkgHead(0x9000, bodylen)
	fmt.Printf("HEAD=%x\n", head)

	pkg := new(bytes.Buffer)
	__STX__ := uint16(0x55aa)
	STX := uint16(0x02)
	ETX := uint16(0x03)
	total := bodylen + headlen + 1 + 1
	binary.Write(pkg, binary.BigEndian, __STX__)
	binary.Write(pkg, binary.BigEndian, total)
	binary.Write(pkg, binary.BigEndian, STX)
	binary.Write(pkg, binary.BigEndian, head.Bytes())
	binary.Write(pkg, binary.BigEndian, body.Bytes())
	binary.Write(pkg, binary.BigEndian, ETX)

	fmt.Printf("BODY=%x, LEN=%d\n", pkg, pkg.Len())

	conn, err := net.Dial("tcp", "10.12.197.237:53101")
	if err != nil {
		fmt.Println("net.Dial failed.", err)
	}
	conn.Write(pkg.Bytes())

	status, err := bufio.NewReader(conn).ReadBytes(0x55)
	if err != nil {
		fmt.Println("readbytes err, ", err)
	}
	fmt.Printf("%x\n", status)
}
