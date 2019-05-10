/*
Please refer to readme.html for full Instructions

Text[...]=[title,text]

Style[...]=[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,TextTextAlign, TitleFontFace, TextFontFace, TipPosition, StickyStyle, TitleFontSize, TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY, TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]
*/

var FiltersEnabled = 1 // if your not going to use transitions or filters in any of the tips set this to 0

//page title=====================
Text[1]=["<TABLE><TR><TD><img src='images/logo_popup_help.jpg'></TD><TD id='ques'>Form login</TD></TR></TABLE>","Silahkan masukkan Username & Password, anda akan diarahkan ke halaman yang sesuai dengan hak akses anda. Untuk mendapatkan Username & Password hubungi Admin"]

//content button===================
//Text[2]=["<TABLE><TR><TD><img src='images/logo_popup_help.jpg'></TD><TD id='ques'>Form login</TD></TR></TABLE>","<ul><li>Daftar ini adalah daftar tahun dan bulan SPP jatuh tempo yang belum terbayarkan oleh siswa</li><li>Pilihlah tahun dan bulan pembayaran sesuai daftar ini</li><li>Jika ada bulan dan tahun pembayaran SPP yang tidak sesuai, hubungi admin</li></ul>"]
Text[2]=["<TABLE><TR><TD><img src='images/logo_popup_help.jpg'></TD><TD id='ques'>Form login</TD></TR></TABLE>","<li>Daftar ini adalah daftar tahun dan bulan SPP jatuh tempo yang belum terbayarkan oleh siswa </li><li>Pilihlah tahun dan bulan pembayaran sesuai daftar ini </li><li>Jika ada bulan dan tahun pembayaran SPP yang tidak sesuai, hubungi admin</li>"]

//content button===================
Text[3]=["<TABLE><TR><TD><img src='images/logo_popup_help.jpg'></TD><TD id='ques'>Jumlah hari catering & antar jemput</TD></TR></TABLE>","<li>Seluruh field harus diisi </li><li>Duplikasi bulan dan tahun ajaran yang bersamaan tidak akan diproses oleh system</li>"]

//content button===================
Text[4]=["<TABLE><TR><TD><img src='images/logo_popup_help.jpg'></TD><TD id='ques'>Keterangan School Support</TD></TR></TABLE>","<li>Anda dapat mengisi lebih dari satu keterangan</li><li>Setiap keterangan dipisahkan dengan tanda koma (,)</li>"]

//right button=====================
Text[9]=["<TABLE><TR><TD><img src='images/logo_small.gif'></TD><TD id='ques'>Log out</TD></TR></TABLE>","Gunakan tombol ini untuk keluar dari sistem penilaian online Qalam Education"]

//content button===================
Text[0]=["<TABLE><TR><TD><img src='images/logo_small.gif'></TD><TD id='ques'>Form login guru tidak aktif</TD></TR></TABLE>","<ul><li>Kondisi ini menunjukkan bahwa admin belum memasukan data guru, kelas ataupun mata pelajaran, dengan kata lain sistem ini belum dapat digunakan</li><BR><li>Silahkan hubungi admin untuk mendaftarkan diri</li></ul>"]

//style====[darbi use style 12]
Style[0]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,1,0,"",""]
Style[1]=["white","black","#000099","#E8E8FF","","","","","","","center","","","",200,"",2,2,10,10,"","","","",""]
Style[2]=["white","black","#000099","#E8E8FF","","","","","","","left","","","",200,"",2,2,10,10,"","","","",""]
Style[3]=["white","black","#000099","#E8E8FF","","","","","","","float","","","",200,"",2,2,10,10,"","","","",""]
Style[4]=["white","black","#000099","#E8E8FF","","","","","","","fixed","","","",200,"",2,2,1,1,"","","","",""]
Style[5]=["white","black","#000099","#E8E8FF","","","","","","","","sticky","","",200,"",2,2,10,10,"","","","",""]
Style[6]=["white","black","#000099","#E8E8FF","","","","","","","","keep","","",200,"",2,2,10,10,"","","","",""]
Style[7]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,40,10,"","","","",""]
Style[8]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,50,"","","","",""]
Style[9]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,0.5,75,"simple","gray"]
Style[10]=["white","black","black","white","","","right","","Impact","cursive","center","",3,5,200,150,5,20,10,0,50,1,80,"complex","gray"]
Style[11]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,0.5,45,"simple","gray"]
Style[12]=["white","black","#333333","#ffffff","","","","","","","","","","",400,"",2,2,10,10,"","","","",""]

applyCssFilter()

