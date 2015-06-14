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

func (bs *ByteStream) pushByte(b byte) {
	binary.BigEndian.PutUint16(bs.pkg, b)
}

func main() {
	var enc encoder
	fmt.Println(b)
}

// body = Hello
