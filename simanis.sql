/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.12-log : Database - simanis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `nis` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `absen` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` text COLLATE latin1_general_ci,
  `isisms` text COLLATE latin1_general_ci,
  `tglsms` datetime DEFAULT NULL,
  `tahun` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `smt` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`tanggal`,`jam_masuk`,`jam_keluar`,`nis`,`absen`,`keterangan`,`isisms`,`tglsms`,`tahun`,`smt`) values (1,'2012-01-11',NULL,NULL,'11408001','hadir',NULL,NULL,NULL,'2','1'),(2,'2012-01-11',NULL,NULL,'11408002','sakit',NULL,NULL,NULL,'2','1'),(3,'2012-01-12',NULL,NULL,'11408001','sakit',NULL,NULL,NULL,'2','1'),(4,'2012-01-12',NULL,NULL,'11408002','izin',NULL,NULL,NULL,'2','1'),(5,'2012-01-19',NULL,NULL,'11408005','hadir',NULL,NULL,NULL,'2','1'),(6,'2012-01-19',NULL,NULL,'11408004','hadir',NULL,NULL,NULL,'2','1'),(7,'2012-01-19',NULL,NULL,'11408001','hadir',NULL,NULL,NULL,'2','1'),(8,'2012-01-19',NULL,NULL,'11408002','izin',NULL,NULL,NULL,'2','1'),(9,'2012-01-19',NULL,NULL,'11408003','hadir',NULL,NULL,NULL,'2','1'),(10,'2012-01-20',NULL,NULL,'11408005','hadir',NULL,NULL,NULL,'2','1'),(11,'2012-01-20',NULL,NULL,'11408004','hadir',NULL,NULL,NULL,'2','1'),(12,'2013-04-19',NULL,NULL,'11408001','hadir',NULL,NULL,NULL,'1','1'),(13,'2013-04-19',NULL,NULL,'11408003','hadir',NULL,NULL,NULL,'1','1');

/*Table structure for table `daemons` */

DROP TABLE IF EXISTS `daemons`;

CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `daemons` */

/*Table structure for table `gammu` */

DROP TABLE IF EXISTS `gammu`;

CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gammu` */

insert  into `gammu`(`Version`) values (11);

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` varchar(10) DEFAULT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `TMPLHR` varchar(100) DEFAULT NULL,
  `TGLLHR` date DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `AGAMA` tinyint(1) DEFAULT NULL,
  `JABATAN` tinyint(1) DEFAULT NULL,
  `NOTLP` varchar(20) DEFAULT NULL,
  `FOTO` text,
  `JK` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`ID`,`NIP`,`NAMA`,`TMPLHR`,`TGLLHR`,`ALAMAT`,`AGAMA`,`JABATAN`,`NOTLP`,`FOTO`,`JK`) values (1,'13010201','Nana Juhana','Bandung','2007-09-01','Bandung',3,1,'0813334454','Ã¿Ã˜Ã¿Ã &#65533;JFIF&#65533;&#65533;`&#65533;`&#65533;&#65533;Ã¿Ã›&#65533;C&#65533;    		\n\n\n\Z\Z $.\' ',2),(2,'13010202','Hilman Juniawan','Bandung','1975-04-03','Bandung',3,2,'0814673539',NULL,1),(3,'13010203','Ina Kurniawati','Bandung','1975-04-03','Bandung',3,2,'0854383633',NULL,2),(4,'13010205','Lukman Jatnika','Bandung','1975-04-03','Bandung',3,2,'0862626523',NULL,1),(5,'13010209','Herawati','Cimahi','1975-04-03','Bandung',3,2,'081229384734',NULL,2),(6,'13010211','Sinta Lisnawati','Jakarta','1975-04-03','Bandung',3,2,'02270738367',NULL,2),(7,'13010215','Bambang Siswoyo','Bandung','1975-04-03','Bandung',3,2,'08124255244',NULL,1),(8,'13010223','Jajang Nurjaman','Bandung','1975-04-03','Bandung',3,2,'08147543636',NULL,1),(9,'13010243','Hari Lubis','Sumedang','1975-04-03','Bandung',3,2,'08132932882',NULL,1),(10,'13010276','Mila Sarmila','Bandung','1975-04-03','Bandung',3,2,'08734736535',NULL,2),(11,'13010289','Mimin Sarbini','Garut','1975-04-03','Bandung',3,2,'081826736634',NULL,2),(12,'13010291','Nani Fitriani','Bandung','1975-04-03','Bandung',3,2,'0812636526',NULL,2),(13,'13010299','Harbini','Bandung','1975-04-03','Bandung',3,2,'08122248845',NULL,2),(14,'13010300','Asep Rusnandar','Bandung','1975-04-03','Bandung',3,2,'0816366222',NULL,1),(15,'13010302','Wiwid Himawan','Bandung','1975-04-03','Bandung',3,2,'081636436636',NULL,1),(16,'13010306','Agus Hermawan','Bandung','1975-04-03','Bandung',3,2,'08127834383',NULL,1),(17,'13010390','Didin Supriadi','Bandung','1975-04-03','Bandung',3,2,'0812637463',NULL,1),(19,'13010401','Nunu Nugraha','Bandung','0000-00-00','Bandung',3,2,'085222466585',NULL,1),(20,'13010401','Ade Rifai','Bandung','0000-00-00','bogor',3,2,'0813221799',NULL,1),(28,'12345678','Andrew Brian Osmond','KEBUMEN','2011-11-12','Jl. Sudirman Bandung',4,2,'081802769072',' bw.JPG',1);

/*Table structure for table `inbox` */

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `inbox` */

insert  into `inbox`(`UpdatedInDB`,`ReceivingDateTime`,`Text`,`SenderNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`RecipientID`,`Processed`) values ('2011-12-26 01:49:55','2011-11-30 07:12:53','0059006F0075007200200069002D00470052004100430049004100530020004100630063006F0075006E007400200068006100730020006200650065006E0020006100630074006900760061007400650064002E000A0055007300650072006E0061006D0065003A002000310030003800360030003700330036002D0033000A00500061007300730077006F00720064003A0020006B00700062007900630061000A005B004E004F002D005200450050004C0059005D00200053004900530046004F00200049005400540045004C004B004F004D','IT TELKOM','Default_No_Compression','','+6221000006',-1,'Your i-GRACIAS Account has been activated.\nUsername: 10860736-3\nPassword: kpbyca\n[NO-REPLY] SISFO ITTELKOM',1,'','true'),('2011-12-26 01:49:55','2011-12-26 01:41:54','004B006F00200061006E00640072006500770020006D006500740020006E006100740061006C0020006C0067002000790061002C002C000A0054007500680061006E0020006200650072006B006100740069002000730065006C0061006C007500200073006500670061006C0061002000730069007300690020006B0065006800690064007500700061006E0020006B006F0032002C006800650068006500680065000A006200650072006B00610068002000640061006C0065006D000A005E005E','+6285722805105','Default_No_Compression','','+62816124',-1,'Ko andrew met natal lg ya,,\nTuhan berkati selalu segala sisi kehidupan ko2,hehehe\nberkah dalem\n^^',2,'','true'),('2011-12-26 01:49:55','2006-08-23 04:11:51','4E2D5B894FE14E1A63D04F9B514D62B562BC3001514D62C54FDD4E2A4EBA5C0F989D8D376B3E670D52A1FF0C5FEB901F7B804FBFFF0C5F535929653E6B3E3002603B90E8FF1A6DF153574E2D8DEF5174534E592753A6516B697C00208BE660C581F475350030003700350035002D00380033003700350038003000300030','620150720001','Unicode_No_Compression','','+8613800755500',-1,'中安信业提供免抵押、免担保个人小额贷款服务，快速简便，当天放款。总部：深南中路兴华大厦八楼 详情致电0755-83758000',3,'','true'),('2011-12-26 01:49:55','2006-08-23 04:59:02','6C11822A6DF157334E03661F822A7A7A7279572866915047671F95F4FF0C63A851FA6691671F56FD518556FD964572794EF7673A7968300165C56E38554652A156E24F537968FF0C70ED7EBFFF1A0030003700350035002D00380033003600320035003900390039FF08591A7EBFFF096B228FCE6765753554A88BE2300198848BA2514D8D3990017968','+8613631221235','Unicode_No_Compression','','+8613800756500',-1,'民航深圳七星航空特在暑假期间，推出暑期国内国际特价机票、旅游商务团体票，热线：0755-83625999（多线）欢迎来电咨询、预订免费送票',4,'','true'),('2011-12-26 01:49:55','2006-09-24 04:05:33','4E00683754C18D284E00534A623F4EF7FF0C4E1C839E9EC46C5F003500304E075E737C739AD85C1A793E533A51788303002D4E2D60E091D158EB67CF5C71FF0C4E8C671F82B15EAD7F8E5885300182B156ED516C5BD330017A7A4E2D5EAD96626D0B623F65B054C14E0A5E02202675358BDD0030003700360039FF0D00380033003800340039003800380038','626277019','Unicode_No_Compression','','+8613800755500',-1,'一样品质一半房价，东莞黄江50万平米高尚社区典范-中惠金士柏山，二期花庭美墅、花园公寓、空中庭院洋房新品上市…电话0769－83849888',5,'','true'),('2011-12-26 01:49:55','2006-09-24 05:27:44','4F605FEB8FC7676554270021','+8613926500830','Unicode_No_Compression','','+8613800755500',-1,'你快过来吧!',6,'','true'),('2011-12-26 01:49:55','2006-09-24 06:13:26','534E7FD45E976E2999A863D0793AFF1A003100306708003165E58D774EA48B665C064E0A8DEF6267884C5BF94EA45F3A9669768468C067E5FF0C003000365E7400376708003165E5524D5DF28D2D4E704FDD966976848F664E3B8BF7628A4FDD5355539F4EF6968F8F665E264E0AFF0C4EE5514D88AB4EA48B667F5A6B3E548C62638F663002','07558922099','Unicode_No_Compression','','+8613800755500',-1,'华翔店温馨提示：10月1日起交警将上路执行对交强险的检查，06年7月1日前已购买保险的车主请把保单原件随车带上，以免被交警罚款和扣车。',7,'','true'),('2011-12-26 01:49:55','2006-09-26 07:07:22','67975148751F91125148751FFF0C002000204E0D597D610F601DFF0C4ECA59294E4B4EA4661362115C1165364E860024003500310030FF0C0020002059734EBA661F7E3D4EF6657870BA00320032003900300020007800200024003200380020003D0020002400360034003100320030002000206A21584A003300354EF60020003D00200024','+8613602645033','Unicode_No_Compression','050003010301','+8613800755500',-1,'林先生鄒先生，  不好意思，今天之交易我少收了$510，  女人星總件數為2290 x $28 = $64120  模塊35件 = $',8,'','true'),('2011-12-26 01:49:55','2006-09-26 07:07:32','0034003900300020002066285929004D0043003300380038002000310039003900374EF600206B206B3E00240033003900300030002000207E3D8CA86B3E70BA002400360038003500310030002C0020621153EA65364E86002400360038003000300030002C0020002052DE7169628A00240035003100305B5890325DE555469280884C5361','+8613602645033','Unicode_No_Compression','050003010302','+8613800755500',-1,'490  昨天MC388 1997件 欠款$3900  總貨款為$68510, 我只收了$68000,  勞煩把$510存進工商銀行卡',9,'','true'),('2011-12-26 01:49:55','2006-09-26 07:07:41','865F003A002000200039003500350038003800300034003000300030003100330034003400330032003000350039','+8613602645033','Unicode_No_Compression','050003010303','+8613800755500',-1,'號:  9558804000134432059',10,'','true'),('2011-12-26 01:49:55','2006-09-24 08:14:41','5982679C4F604EEC80FD591F6DF151656C9F901AFF0C5F7C6B644E8689E35BF965B97684771F6B63970089815E7680FD53D65F974E0081F476848BDDFF0C4F604EEC5C064F1A975E5E385E78798FFF0C62104E3A7FA1715E65C14EBA76844E005BF95440FF01000D56DE590D004E66F4591A','03507792','Unicode_No_Compression','','+8613800200500',-1,'如果你们能够深入沟通，彼此了解对方的真正需要并能取得一致的话，你们将会非常幸福，成为羡煞旁人的一对呀！\r回复N更多',11,'','true'),('2011-12-26 01:49:55','2006-09-24 08:14:41','56DE590D003167E5770BFF0860A8768459D36C0F62117684540D5B5759D3540D914D5BF94E3A60A85206679060A8548C72314EBA76845408914D596579D8002176F463A556DE590D0031753759D3540DFF098FD94E2A59D3540D62408574542B7684596579D8FF0C56DE590D003267E5770BFF08597359D3540D598200318C225EAD5CF000325F206CCA829D','03507792','Unicode_No_Compression','','+8613800200500',-1,'回复1查看（您的姓氏我的名字姓名配对为您分析您和爱人的合配奥秘!直接回复1男姓名）这个姓名所蕴含的奥秘，回复2查看（女姓名如1谢庭峰2张泊芝',12,'','true'),('2011-12-26 01:49:55','2006-09-24 08:14:44','56DE590D003167E5770BFF0860A8768459D36C0F62117684540D5B5759D3540D914D5BF94E3A60A85206679060A8548C72314EBA76845408914D596579D8002176F463A556DE590D0031753759D3540DFF098FD94E2A59D3540D62408574542B7684596579D8FF0C56DE590D003267E5770BFF08597359D3540D598200318C225EAD5CF000325F206CCA829D','+8613928437288','Unicode_No_Compression','','+8613800755500',-1,'回复1查看（您的姓氏我的名字姓名配对为您分析您和爱人的合配奥秘!直接回复1男姓名）这个姓名所蕴含的奥秘，回复2查看（女姓名如1谢庭峰2张泊芝',13,'','true'),('2011-12-26 01:49:55','2006-09-24 08:24:07','5DEE4E0D591A003100300030','+8613632768099','Unicode_No_Compression','','+8613800755500',-1,'差不多100',14,'','true'),('2011-12-26 01:49:55','2006-09-24 23:41:50','522B9A7B8DB3FF0C68A660F389814E0D505C8FFD9010FF1B522B8BA48F93FF0C90688FC79ED1591C624D670965E551FAFF1B89818BB04F4FFF0C6210529F5C3157284E0B4E006B65FF1B8DEF5F8882E6FF0C6C576C34662F67007F8E76844E66FF1B5C3D60C56B22547C002C76F87EA65DC55CF05171821EFF01','+8613481710984','Unicode_No_Compression','','+8613800770500',-1,'别驻足，梦想要不停追逐；别认输，遨过黑夜才有日出；要记住，成功就在下一步；路很苦，汗水是最美的书；尽情欢呼,相约巅峰共舞！',15,'','true'),('2011-12-26 01:49:55','2006-09-25 06:18:56','51E070B9','+8613928437288','Unicode_No_Compression','','+8613800755500',-1,'几点',16,'','true'),('2011-12-26 01:49:55','2006-09-26 07:13:56','0052004600200053005700490054004300480020004900430020003A004800570053003400300038','+8613902988689','Default_No_Compression','','+8613800755500',-1,'RF SWITCH IC :HWS408',17,'','true'),('2011-12-26 01:49:55','2006-09-26 11:26:24','6E298B2663D0793AFF1A003100306708003165E58D774EA48B664E2567E54EA45F3A9669FF0C672A630989C45B9A529E74065C0688AB62D68F6630017F5A6B3EFF0C62954FDD70ED7EBFFF1A00380038003800340035003100310034FF0C4E704EA45F3A9669900153554E0A95E8FF0C62954FDD55464E1A8F66966990016C7D8F6699996C3430016C275427','555588288','Unicode_No_Compression','','+8613800755500',-1,'温謦提示：10月1日起交警严查交强险，未按规定办理将被拖车、罚款，投保热线：88845114，买交强险送单上门，投保商业车险送汽车香水、氧吧',18,'','true'),('2011-12-26 01:49:55','2006-09-27 01:17:21','5F8862B16B49FF0C8BF7514853D190018F66724C53F7780181F300300038003600360036FF0C4F8B5982FF1A004300540057005A7CA4004200300031003200330034002053D1900181F30030003800360036003600286CE8FF1A6BCF6B2153EA67E54E008F868F660029','08666','Unicode_No_Compression','','+8613800755500',-1,'很抱歉，请先发送车牌号码至08666，例如：CTWZ粤B01234 发送至08666(注：每次只查一辆车)',19,'','true'),('2011-12-26 01:49:55','2006-09-27 01:19:40','4F6076848F66724C662F201C0042002F00460042003000370033201D30028BF78F9351658F66724C7C7B578BFF0C9EC4724C8F668F935165004300540057005A0041300184DD724C8F668F935165004300540057005A004230019ED1724C8F668F935165004300540057005A0043FF0C53D1900181F300300038003600360036','08666','Unicode_No_Compression','','+8613800755500',-1,'你的车牌是“B/FB073”。请输入车牌类型，黄牌车输入CTWZA、蓝牌车输入CTWZB、黑牌车输入CTWZC，发送至08666',20,'','true'),('2011-12-26 01:49:55','2006-09-27 01:21:25','0042002F0046004200300037003367098FDD7AE0002C901A77E5535553F7003A0052004A00580033003000380034002C65F695F4003A00320030003000360030003400320039003100350030003700330030002C573070B9003A6DF153574E2D8DEF002C987976EE003A0042003300320038002E0041003B901A77E5535553F7003A0052004A005200360037','08666','Unicode_No_Compression','','+8613800755500',-1,'B/FB073有违章,通知单号:RJX3084,时间:20060429150730,地点:深南中路,项目:B328.A;通知单号:RJR67',21,'','true'),('2011-12-26 01:49:55','2006-09-27 01:21:26','00370039002C65F695F4003A00320030003000360030003400320039003200310035003400300030002C573070B9003A9999871C6E56531773AF002C987976EE003A0043003300350030002E0041','08666','Unicode_No_Compression','','+8613800755500',-1,'79,时间:20060429215400,地点:香蜜湖北环,项目:C350.A',22,'','true'),('2011-12-26 01:49:55','2006-09-27 05:35:25','8001677F002C4EF7683C8B8A4E0D4E860021','+8613751111951','Unicode_No_Compression','','+8613800755500',-1,'老板,价格變不了!',23,'','true'),('2011-12-26 01:49:55','2006-09-27 05:35:49','621195EE4E0095EE','+8613751111951','Unicode_No_Compression','','+8613800755500',-1,'我问一问',24,'','true'),('2011-12-26 01:49:55','2006-09-27 05:36:13','67975148751F002C5C0D65B967096CE25C0E673A677F957765B95F6290A372477D044E8C5343002C898100330030514352306DF157330021','+8613751111951','Unicode_No_Compression','','+8613800755500',-1,'林先生,對方有波導机板長方形那片約二千,要30元到深圳!',25,'','true'),('2011-12-26 01:49:55','2006-09-27 07:07:57','4E004E2A4EBA751F75C557285BB6FF0C6CA14EBA966AFF0C6CA1753589C6770BFF0C597D95F7597D65E0804AFF0C966A6211804A804A5427','106621601610','Unicode_No_Compression','','+8613800755500',-1,'一个人生病在家，没人陪，没电视看，好闷好无聊，陪我聊聊吧',26,'','true'),('2011-12-26 01:49:55','2006-09-27 07:23:04','5E7F6C7D4E3075309AD85C4273B0573A552E002251EF7F8E745E002273B08F66002159275174901A5546518D73B000224E0E4F174E0D540C0022002C003967080032003865E55F004E1A76DB5178002C53575C7167084EAE6E7E755459275174901A55466F147ECE002266F47CBE5F690021002270ED7EBF00320036003400360030003000300030','0680208111019','Unicode_No_Compression','','+8613800755500',-1,'广汽丰田高层现场售\"凯美瑞\"现车!大兴通商再现\"与众不同\",9月28日开业盛典,南山月亮湾畔大兴通商演绎\"更精彩!\"热线26460000',27,'','true'),('2011-12-26 02:03:22','2006-09-26 07:07:32','0034003900300020002066285929004D0043003300380038002000310039003900374EF600206B206B3E00240033003900300030002000207E3D8CA86B3E70BA002400360038003500310030002C0020621153EA65364E86002400360038003000300030002C0020002052DE7169628A00240035003100305B5890325DE555469280884C5361','+8613602645033','Unicode_No_Compression','050003010302','+8613800755500',-1,'490  昨天MC388 1997件 欠款$3900  總貨款為$68510, 我只收了$68000,  勞煩把$510存進工商銀行卡',28,'','false'),('2012-01-01 01:17:18','2006-09-26 07:07:41','865F003A002000200039003500350038003800300034003000300030003100330034003400330032003000350039','+8613602645033','Unicode_No_Compression','050003010303','+8613800755500',-1,'號:  9558804000134432059',29,'','false');

/*Table structure for table `kasus` */

DROP TABLE IF EXISTS `kasus`;

CREATE TABLE `kasus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `nis` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `kasus` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` text COLLATE latin1_general_ci,
  `kirimsms` enum('0','1') COLLATE latin1_general_ci DEFAULT '0',
  `idtahun` tinyint(2) DEFAULT NULL,
  `sem` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `kasus` */

insert  into `kasus`(`id`,`tanggal`,`nis`,`kasus`,`keterangan`,`kirimsms`,`idtahun`,`sem`) values (1,'2011-12-24','11408001','Menyontek','Menyontek ','0',1,1),(2,'2011-12-31','11408001','Menyontek','Menyontek','1',2,1),(3,'2011-12-31','11408001','Berkelahi','Berkelahi dengan teman sekelas','1',2,1);

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `idtahun` int(5) DEFAULT NULL,
  `idkelas` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nis`,`idtahun`,`idkelas`) values (8,'11408001',1,1),(5,'11408002',1,2),(6,'11408003',1,1),(9,'11408001',2,10),(11,'11408002',2,10),(12,'11408003',2,11),(13,'11408005',2,9),(14,'11408004',2,9);

/*Table structure for table `mp` */

DROP TABLE IF EXISTS `mp`;

CREATE TABLE `mp` (
  `ID` bigint(11) NOT NULL AUTO_INCREMENT,
  `KDMP` varchar(10) DEFAULT NULL,
  `MP` varchar(100) DEFAULT NULL,
  `PROG` varchar(15) DEFAULT NULL,
  `TINGKAT` smallint(6) DEFAULT NULL,
  `BOBOT` int(255) DEFAULT NULL,
  `KATEGORI` varchar(15) DEFAULT NULL,
  `KURIKULUM` varchar(4) DEFAULT NULL,
  `ALIAS` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `mp` */

insert  into `mp`(`ID`,`KDMP`,`MP`,`PROG`,`TINGKAT`,`BOBOT`,`KATEGORI`,`KURIKULUM`,`ALIAS`) values (1,'1101','PENDIDIKAN PERKAWINAN','IPA',1,NULL,'INTI','2004','PKW'),(2,'1102','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','-',1,NULL,'INTI','2004','PKN'),(3,'1103','BAHASA DAN SASTRA INDONESIA','-',1,NULL,'INTI','2004','IND'),(4,'1104','SEJARAH NASIONAL DAN SEJARAH UMUM','-',1,NULL,'INTI','2004','SEJ'),(6,'1106','BAHASA INGGRIS','-',1,NULL,'INTI','2004','BIG'),(7,'1107','MATEMATIKA','-',1,NULL,'INTI','2004','MTK'),(8,'1108','FISIKA','-',1,NULL,'IPA','2004','FIS'),(9,'1109','BIOLOGI','-',1,NULL,'IPA','2004','BIO'),(10,'1110','KIMIA','-',1,NULL,'IPA','2004','KIM'),(11,'1111','EKONOMI','-',1,NULL,'IPS','2004','EKN'),(12,'1112','GEOGRAFI','-',1,NULL,'IPS','2004','GEO'),(13,'1113','PENDIDIKAN SENI','-',1,NULL,'INTI','2004','SEN'),(14,'1114','KOMPUTER','-',1,NULL,'LOKAL','2004','KMP'),(15,'1115','BAHASA SUNDA','-',1,NULL,'LOKAL','2004','SND'),(16,'2101','PENDIDIKAN AGAMA','-',2,NULL,'INTI','2004','AGM'),(17,'2102','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','-',2,NULL,'INTI','2004','PKN'),(18,'2103','BAHASA DAN SASTRA INDONESIA','-',2,NULL,'INTI','2004','BID'),(19,'2104','SEJARAH NASIONAL DAN SEJARAH UMUM','-',2,NULL,'INTI','2004','SEJ'),(20,'2105','PENDIDIKAN JASMANI DAN KESEHATAN','-',2,NULL,'INTI','2004','PJS'),(21,'2106','BAHASA INGGRIS','-',2,NULL,'INTI','2004','ING'),(22,'2107','MATEMATIKA','-',2,NULL,'INTI','2004','MTK'),(23,'2108','FISIKA','-',2,NULL,'IPA','2004','FIS'),(24,'2109','BIOLOGI','-',2,NULL,'IPA','2004','BIO'),(25,'2110','KIMIA','-',2,NULL,'IPA','2004','KIM'),(26,'2111','EKONOMI','-',2,NULL,'IPS','2004','EKN'),(27,'2112','GEOGRAFI','-',2,NULL,'IPS','2004','GEO'),(28,'2113','PENDIDIKAN SENI','-',2,NULL,'INTI','2004','SEN'),(29,'2114','KOMPUTER','-',2,NULL,'LOKAL','2004','KMP'),(30,'2115','BAHASA SUNDA','-',2,NULL,'LOKAL','2004','SND'),(31,'3201','PENDIDIKAN AGAMA','IPA',3,NULL,'INTI','2004','AGM'),(32,'3202','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','IPA',3,NULL,'INTI','2004','PKN'),(33,'3203','BAHASA DAN SASTRA INDONESIA','IPA',3,NULL,'INTI','2004','IND'),(34,'3204','SEJARAH NASIONAL DAN SEJARAH UMUM','IPA',3,NULL,'INTI','2004','SEJ'),(35,'3205','PENDIDIKAN JASMANI DAN KESEHATAN','IPA',3,NULL,'INTI','2004','PJS'),(36,'3206','BAHASA INGGRIS','IPA',3,NULL,'INTI','2004','ING'),(37,'3207','MATEMATIKA','IPA',3,NULL,'IPA','2004','MTK'),(38,'3208','FISIKA','IPA',3,NULL,'IPA','2004','FIS'),(39,'3209','BIOLOGI','IPA',3,NULL,'IPA','2004','BIO'),(40,'3210','KIMIA','IPA',3,NULL,'IPA','2004','KIM'),(41,'3211','KOMPUTER','IPA',3,NULL,'IPA','2004','KMP'),(42,'3301','PENDIDIKAN AGAMA','IPS',3,NULL,'INTI','2004','AGM'),(43,'3302','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','IPS',3,NULL,'INTI','2004','PKN'),(44,'3303','BAHASA DAN SASTRA INDONESIA','IPS',3,NULL,'INTI','2004','IND'),(45,'3304','SEJARAH NASIONAL DAN SEJARAH UMUM','IPS',3,NULL,'INTI','2004','SEJ'),(46,'3305','PENDIDIKAN JASMANI DAN KESEHATAN','IPS',3,NULL,'INTI','2004','PJS'),(47,'3306','BAHASA INGGRIS','IPS',3,NULL,'INTI','2004','ING'),(48,'3307','EKONOMI','IPS',3,NULL,'IPS','2004','EKN'),(49,'3308','SOSIOLOGI','IPS',3,NULL,'IPS','2004','SOS'),(50,'3309','TATA NEGARA','IPS',3,NULL,'IPS','2004','TTN'),(51,'3310','ANTROPOLOGI','IPS',3,NULL,'IPS','2004','ATR'),(52,'3311','KOMPUTER','IPS',3,NULL,'IPS','2004','KMP'),(53,'3401','PENDIDIKAN AGAMA','BAHASA',3,NULL,'INTI','2004','AGM'),(54,'3402','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','BAHASA',3,NULL,'INTI','2004','PKN'),(55,'3403','BAHASA DAN SASTRA INDONESIA','BAHASA',3,NULL,'INTI','2004','IND'),(56,'3404','SEJARAH NASIONAL DAN SEJARAH UMUM','BAHASA',3,NULL,'INTI','2004','SEJ'),(57,'3405','PENDIDIKAN JASMANI DAN KESEHATAN','BAHASA',3,NULL,'INTI','2004','PJS'),(58,'3406','BAHASA INGGRIS','BAHASA',3,NULL,'INTI','2004','ING'),(59,'3407','BAHASA ASING LAINNYA','BAHASA',3,NULL,'IPS','2004','BAL'),(60,'3408','KOMPUTER','BAHASA',3,NULL,'IPS','2004','KMP');

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) DEFAULT NULL,
  `kdmp` varchar(10) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `idtahun` int(4) NOT NULL,
  `sem` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `nilai` */

insert  into `nilai`(`id`,`nis`,`kdmp`,`nilai`,`status`,`nip`,`idtahun`,`sem`) values (7,'11408001','1109',90,NULL,'13010215',1,1),(6,'11408001','1107',80,NULL,'13010306',1,1),(8,'11408001','1115',65,NULL,'13010390',1,1),(9,'11408001','2107',60,NULL,'13010201',2,1),(10,'11408001','2111',50,NULL,'13010390',2,1);

/*Table structure for table `outbox` */

DROP TABLE IF EXISTS `outbox`;

CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `outbox` */

/*Table structure for table `outbox_multipart` */

DROP TABLE IF EXISTS `outbox_multipart`;

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `outbox_multipart` */

/*Table structure for table `pengampu` */

DROP TABLE IF EXISTS `pengampu`;

CREATE TABLE `pengampu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) NOT NULL,
  `idmp` varchar(11) NOT NULL,
  `idtahun` int(3) DEFAULT NULL,
  `idkelas` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pengampu` */

insert  into `pengampu`(`id`,`nip`,`idmp`,`idtahun`,`idkelas`) values (8,'13010215','1109',1,1),(7,'13010306','1107',1,1),(6,'13010201','2107',1,6),(5,'13010201','1103',1,2),(9,'13010390','1115',1,1),(10,'13010205','1103',2,9),(11,'13010205','1106',2,9),(12,'13010201','2107',2,10),(13,'13010390','2111',2,10);

/*Table structure for table `phones` */

DROP TABLE IF EXISTS `phones`;

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '0',
  `Signal` int(11) NOT NULL DEFAULT '0',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `phones` */

insert  into `phones`(`ID`,`UpdatedInDB`,`InsertIntoDB`,`TimeOut`,`Send`,`Receive`,`IMEI`,`Client`,`Battery`,`Signal`,`Sent`,`Received`) values ('','2012-01-01 01:20:19','2012-01-01 01:07:15','2012-01-01 01:20:29','yes','yes','000002502156728','Gammu 1.27.93, Windows Server 2007, GCC 4.4, MinGW 3.13',0,90,1,1);

/*Table structure for table `potonganpulsa` */

DROP TABLE IF EXISTS `potonganpulsa`;

CREATE TABLE `potonganpulsa` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `biayapotong` mediumint(9) DEFAULT NULL,
  `stat_potong_pulsa` tinyint(4) DEFAULT '0',
  `kirim_sms_absen` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `potonganpulsa` */

insert  into `potonganpulsa`(`id`,`biayapotong`,`stat_potong_pulsa`,`kirim_sms_absen`) values (1,700,1,1);

/*Table structure for table `profilakademik` */

DROP TABLE IF EXISTS `profilakademik`;

CREATE TABLE `profilakademik` (
  `tahun` varchar(4) COLLATE latin1_general_ci DEFAULT NULL,
  `semester` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_sekolah` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `alamat` text COLLATE latin1_general_ci,
  `telp` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `profilakademik` */

insert  into `profilakademik`(`tahun`,`semester`,`nama_sekolah`,`alamat`,`telp`) values ('2011','1','Andrew School of Academy','Jl. Sudirman Bandung','081802769072');

/*Table structure for table `pulsa` */

DROP TABLE IF EXISTS `pulsa`;

CREATE TABLE `pulsa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pulsa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pulsa` */

/*Table structure for table `redaksionalsms` */

DROP TABLE IF EXISTS `redaksionalsms`;

CREATE TABLE `redaksionalsms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `redaksionalsms` */

insert  into `redaksionalsms`(`id`,`isi`) values (1,'%Siswa% melakukan pelanggaran %jenis% pada %tgl% hari ini. Mohon dievaluasi.');

/*Table structure for table `ref_agama` */

DROP TABLE IF EXISTS `ref_agama`;

CREATE TABLE `ref_agama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ref_agama` */

insert  into `ref_agama`(`id`,`nama`) values (1,'Budha'),(2,'Hindu'),(3,'Islam'),(4,'Katholik'),(5,'Kristen');

/*Table structure for table `ref_jabatan` */

DROP TABLE IF EXISTS `ref_jabatan`;

CREATE TABLE `ref_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_jabatan` */

insert  into `ref_jabatan`(`id`,`nama`) values (1,'Guru'),(2,'Kepala Sekolah');

/*Table structure for table `ref_jk` */

DROP TABLE IF EXISTS `ref_jk`;

CREATE TABLE `ref_jk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_jk` */

insert  into `ref_jk`(`id`,`nama`) values (1,'L'),(2,'P');

/*Table structure for table `refkelas` */

DROP TABLE IF EXISTS `refkelas`;

CREATE TABLE `refkelas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tingkat` smallint(6) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `walikls` varchar(50) DEFAULT NULL,
  `tahun` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `refkelas` */

insert  into `refkelas`(`id`,`tingkat`,`program`,`kelas`,`walikls`,`tahun`) values (1,1,'-','I-1','Asep Rusnandar',1),(2,1,'-','I-2','Agus Hermawan',1),(3,1,'-','I-3','Bambang Siswoyo',1),(4,2,'-','II-1','Hilman Juniawan',1),(5,2,'-','II-2','Herawati',1),(6,2,'-','II-3','Hari Lubis',1),(7,3,'IPA','III-IPA-1','Harbini',1),(8,3,'IPS','III-IPS-1','Ina Kurniawati',1),(9,1,'-','I-1','Andrew Brian Osmond',2),(10,2,'-','II-1','Lukman Jatnika',2),(11,3,'IPA','III-IPA-1','Mimin Sarbini',2),(12,3,'IPS','III-IPS-1','Sinta Lisnawati',2);

/*Table structure for table `semester` */

DROP TABLE IF EXISTS `semester`;

CREATE TABLE `semester` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `nama_semester` varchar(10) NOT NULL,
  `status_semester` enum('aktif','tidak aktif') DEFAULT 'tidak aktif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `semester` */

insert  into `semester`(`id`,`nama_semester`,`status_semester`) values (1,'I','aktif'),(2,'II','tidak aktif');

/*Table structure for table `sentitems` */

DROP TABLE IF EXISTS `sentitems`;

CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `sentitems` */

insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2011-12-26 01:47:16','0000-00-00 00:00:00','2011-12-26 01:47:16',NULL,'007400650073007400200053004D0053002E','088806615695','Default_No_Compression','','+62818445009',-1,'test SMS.',1,'',1,'SendingOKNoReport',-1,51,255,''),('2011-12-26 01:47:40','0000-00-00 00:00:00','2011-12-26 01:47:40',NULL,'007400650073007400200053004D0053002E','088806615695','Default_No_Compression','','+62818445009',-1,'test SMS.',2,'',1,'SendingOKNoReport',-1,52,255,''),('2011-12-26 01:47:48','0000-00-00 00:00:00','2011-12-26 01:47:48',NULL,'00410079006F00200073006100610074006E00790061002000620065007200740065006D0075','088806615695','Default_No_Compression','','+62818445009',-1,'Ayo saatnya bertemu',3,'',1,'SendingOKNoReport',-1,53,255,''),('2011-12-26 01:47:56','0000-00-00 00:00:00','2011-12-26 01:47:56',NULL,'00530065006C0061006D006100740020007300690061006E0067002E0020004B0061006D00690020006D0065006E0067006800610072006100700020006B0065006800610064006900720061006E00200062006100700061006B0020006900620075002000730065006B0061006C00690061006E002000640061006C0061006D002000610063006100720061002000540065006D007500200041006B006200610072002C00200033003100200044006500730065006D00620065007200200032003000310032002000700075006B0075006C002000300030002E00300030002E00200041006B0061006E002000640069006200610068006100730020006D0065006E00670065006E006100690020006B007500720069006B0075006C0075006D002000730065006D0065007300740065007200200064006500700061006E002E','088806615695','Default_No_Compression','','+62818445009',-1,'Selamat siang. Kami mengharap kehadiran bapak ibu sekalian dalam acara Temu Akbar, 31 Desember 2012 pukul 00.00. Akan dibahas mengenai kurikulum semester depan.',4,'',1,'SendingOKNoReport',-1,54,255,''),('2011-12-26 01:48:04','0000-00-00 00:00:00','2011-12-26 01:48:04',NULL,'00530065006C0061006D006100740020007300690061006E0067002E0020004B0061006D00690020006D0065006E0067006800610072006100700020006B0065006800610064006900720061006E00200062006100700061006B0020006900620075002000730065006B0061006C00690061006E002000640061006C0061006D002000610063006100720061002000540065006D007500200041006B006200610072002C00200033003100200044006500730065006D00620065007200200032003000310032002000700075006B0075006C002000300030002E00300030002E00200041006B0061006E002000640069006200610068006100730020006D0065006E00670065006E006100690020006B007500720069006B0075006C0075006D002000730065006D0065007300740065007200200064006500700061006E002E','088806615695','Default_No_Compression','','+62818445009',-1,'Selamat siang. Kami mengharap kehadiran bapak ibu sekalian dalam acara Temu Akbar, 31 Desember 2012 pukul 00.00. Akan dibahas mengenai kurikulum semester depan.',5,'',1,'SendingOKNoReport',-1,55,255,''),('2011-12-26 01:53:57','0000-00-00 00:00:00','2011-12-26 01:53:57',NULL,'00530065006C0061006D006100740020004E006100740061006C00200032003000310031002000640061006E00200054006100680075006E0020004200610072007500200032003000310032002E','088806615695','Default_No_Compression','','+62818445009',-1,'Selamat Natal 2011 dan Tahun Baru 2012.',8,'',1,'SendingOKNoReport',-1,56,255,''),('2011-12-26 01:54:04','0000-00-00 00:00:00','2011-12-26 01:54:04',NULL,'00530065006C0061006D006100740020004E006100740061006C00200032003000310031002000640061006E00200054006100680075006E0020004200610072007500200032003000310032002E','088806615695','Default_No_Compression','','+62818445009',-1,'Selamat Natal 2011 dan Tahun Baru 2012.',9,'',1,'SendingOKNoReport',-1,57,255,''),('2012-01-01 01:09:21','0000-00-00 00:00:00','2012-01-01 01:09:21',NULL,'004200750064006900200053006900790068006100620075006400640069006E0020006D0065006E0079006F006E00740065006B002000700061006400610020007300610061007400200075006C0061006E00670061006E00200075006D0075006D002E','088806615695','Default_No_Compression','','+62818445009',-1,'Budi Siyhabuddin menyontek pada saat ulangan umum.',12,'',1,'SendingOKNoReport',-1,147,255,'');

/*Table structure for table `set_absen` */

DROP TABLE IF EXISTS `set_absen`;

CREATE TABLE `set_absen` (
  `kode_jam` varchar(6) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `jam_awal` time DEFAULT '00:00:00',
  `jam_akhir` time DEFAULT '00:00:00',
  PRIMARY KEY (`kode_jam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `set_absen` */

insert  into `set_absen`(`kode_jam`,`status`,`jam_awal`,`jam_akhir`) values ('JM','MASUK','11:00:00','13:00:00'),('JT','TERLAMBAT','13:01:00','13:16:00'),('JA','ALFA','08:01:01','11:25:00'),('JP','KELUAR','19:00:00','00:00:00');

/*Table structure for table `setting_ulangan` */

DROP TABLE IF EXISTS `setting_ulangan`;

CREATE TABLE `setting_ulangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsem` int(11) NOT NULL,
  `idtahun` int(11) NOT NULL,
  `ulangan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `setting_ulangan` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `NIS` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `NAMA` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `TMPLHR` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `TGLLHR` date DEFAULT NULL,
  `ALAMAT` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `AGAMA` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NAMAAYAH` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `PEKERJAANAYAH` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NAMAIBU` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `PEKERJAANIBU` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ALAMAT2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NOHP1` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `TGLREG` date DEFAULT NULL,
  `TELP` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `AKTIF` tinyint(1) DEFAULT NULL,
  `JK` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Photo` blob,
  PRIMARY KEY (`NIS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`NIS`,`NAMA`,`TMPLHR`,`TGLLHR`,`ALAMAT`,`AGAMA`,`NAMAAYAH`,`PEKERJAANAYAH`,`NAMAIBU`,`PEKERJAANIBU`,`ALAMAT2`,`tahun`,`NOHP1`,`TGLREG`,`TELP`,`AKTIF`,`JK`,`Photo`) values ('11408001','Budi Siyhabuddin','BANDUNG','2011-12-24','Bandung','3','Makruf Siyhabuddin','Wiraswasta','Ummu Salamah','Ibu Rumah Tangga','Bandung','2012','085849004000',NULL,'088806615695',NULL,'1',''),('11408002','Ratna Mayasari','BANDUNG','2011-12-25','Bandung','2','Bapak Ratna','bapak','Ibu Ratna','Ibu Rumah Tangga','Bandung','2012','085212345678',NULL,'088806615695',NULL,'2',''),('11408003','Hurianti Idho','BANDUNG','2011-12-25','Bandung','1','Bapak Ratna','bapak','Ibunya','Ibu Rumah Tangga','Bandung','2012','085849004000',NULL,'088806615695',NULL,'2',''),('11408005','Rizko Hanggoro','Bandung','2001-03-15','Jl. Moh Toha No 1 Bandung','1','Hanggo Hanggoro','Swasta','Hanggi Hanggoro','Ibu Rumah Tangga','Bandung','2008','0817234565',NULL,'0821221223',NULL,'1',''),('11408004','Rizky Hanggoro','Bandung','2001-03-15','Jl. Moh Toha No 1 Bandung','1','Hanggo Hanggoro','Swasta','Hanggi Hanggoro','Ibu Rumah Tangga','Bandung','2008','0817234565',NULL,'0821221223',NULL,'1','');

/*Table structure for table `sms` */

DROP TABLE IF EXISTS `sms`;

CREATE TABLE `sms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `phone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `isi` text COLLATE latin1_general_ci,
  `status` smallint(6) DEFAULT '0',
  `user` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `flag` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sms` */

/*Table structure for table `spp` */

DROP TABLE IF EXISTS `spp`;

CREATE TABLE `spp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `idkelas` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `bulan` smallint(6) DEFAULT NULL,
  `tahun` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `tglbayar` date DEFAULT NULL,
  `keterangan` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `idsem` int(5) DEFAULT NULL,
  `idtahun` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `spp` */

insert  into `spp`(`id`,`nis`,`idkelas`,`nilai`,`bulan`,`tahun`,`tglbayar`,`keterangan`,`idsem`,`idtahun`) values (1,'11408005',9,20000,1,'2012','2012-01-19',NULL,1,2),(2,'11408004',9,20000,1,'2012','2012-01-19',NULL,1,2),(3,'11408001',10,25000,1,'2012','2012-01-19',NULL,1,2),(4,'11408003',11,25000,2,'2012','2012-01-30',NULL,1,2);

/*Table structure for table `tahunajaran` */

DROP TABLE IF EXISTS `tahunajaran`;

CREATE TABLE `tahunajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(9) NOT NULL,
  `mulai` date NOT NULL,
  `akhir` date NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `statusnya` enum('aktif','tidak aktif') DEFAULT 'tidak aktif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tahunajaran` */

insert  into `tahunajaran`(`id`,`tahun`,`mulai`,`akhir`,`semester`,`statusnya`) values (1,'2012/2013','2012-07-09','2012-12-22',1,'aktif'),(2,'2013/2014','2013-07-08','2014-07-19',0,'tidak aktif'),(3,'2012/2013','2012-07-16','2013-07-08',1,'tidak aktif');

/*Table structure for table `ujian` */

DROP TABLE IF EXISTS `ujian`;

CREATE TABLE `ujian` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TANGGAL` date DEFAULT NULL,
  `HARI` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `ALIASHARI` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `JAM` time DEFAULT NULL,
  `MP` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `ALIAS` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `TINGKAT` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `PROGRAM` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `TAHUN` int(4) DEFAULT NULL,
  `SEM` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `ujian` */

insert  into `ujian`(`ID`,`TANGGAL`,`HARI`,`ALIASHARI`,`JAM`,`MP`,`ALIAS`,`TINGKAT`,`PROGRAM`,`TAHUN`,`SEM`) values (3,'2012-01-09','SENIN','SEN','07:00:00','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','PKW','1','IPA',2,1),(4,'2012-01-09','SENIN','SEN','07:00:00','BAHASA DAN SASTRA INDONESIA','AGM','2','-',2,1),(5,'2012-01-09','SENIN','SEN','07:00:00','SEJARAH NASIONAL DAN SEJARAH UMUM','AGM','3','IPA',2,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `stat` enum('0','1') DEFAULT '0',
  `levels` enum('0','1') DEFAULT '0',
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`nip`,`passwd`,`stat`,`levels`,`lastlogin`) values (1,10860736,'21232f297a57a5a743894a0e4a801fc3','1','1','2011-10-12 20:07:06');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
