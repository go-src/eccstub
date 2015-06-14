package main

import (
	//"bytes"
	"encoding/binary"
	"fmt"
)

/*
func pkghead() []byte {

}

func pkgheadex() []byte {

}

func pkgbody(json string) []byte {

}
*/

type ByteStream struct {
	pkg       []byte
	buflen    int
	offset    int
	isgood    bool
	realwrite bool
}

func main() {
	//pkg := bytes.NewBufferString("")
	//pkg.WriteByte(c)
	var a uint16 = 0x55AA
	b := make([]byte, 2)
	binary.BigEndian.PutUint16(b, a)
	fmt.Println(b)
}

// body = Hello
