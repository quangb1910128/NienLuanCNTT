<?php
namespace CT446\qld;
class QLDiem
{
	private $db;

	private $mshs = -1;
    private $msgv = -1;
    private $mchitietlop = -1;
    private $mchunhiem = -1;
    private $mdiem = -1;
    private $mgd = -1;
    private $mmon;
    public $mnamhoc = 2023;
    public $hocky = 1;
    public $diemtbhk1 = NULL;
    public $diemtbhk2 = NULL;
	private $errors = [];

	public function getmlop()
	{
		return $this->mlop;
	}

    public function getmshs()
	{
		return $this->mshs;
	}

    public function getmsgv()
	{
		return $this->msgv;
	}

    public function getmmon()
	{
		return $this->mmon;
	}

    public function getmgd()
	{
		return $this->mgd;
	}

    public function getmchunhiem()
	{
		return $this->mchunhiem;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}


	public function getValidationErrors()
	{
		return $this->errors;
	}

    public function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        $str ='';
        for( $i = 0; $i < $length; $i++ ) {
        $str .=  $chars[ rand( 0, $size - 1 ) ];
         }
        return $str;
    }

    public function login(){
		if(isset($_POST["submit"])){
			if(isset($_POST["taikhoan"])&& isset($_POST["matkhau"]) && $_POST["quyen"]== 'tkgv'){
				$query= "SELECT * FROM tkgv JOIN giaovien gv ON gv.msgv = tkgv.msgv WHERE tkgv.msgv = :msgv AND matkhau = :matkhau";
				$stmt = $this->db->prepare($query);
				$stmt->execute(
					array(
						'msgv' => $_POST["taikhoan"],
						'matkhau' => $_POST["matkhau"],
                        
					)
				);
                $row = $stmt->fetch();
				$count = $stmt->rowCount();
				if($count>0){
					$_SESSION["msgv"]= $_POST["taikhoan"];
                    $_SESSION["hoten"]= $row['hoten'];
					header('location: lopphutrach.php');
				}
			}
            if(isset($_POST["taikhoan"])&& isset($_POST["matkhau"]) && $_POST["quyen"]== 'tkhs'){
				$query= "SELECT * FROM tkhs JOIN hocsinh hs ON hs.mshs = tkhs.mshs WHERE tkhs.mshs = :mshs AND matkhau = :matkhau";
				$stmt = $this->db->prepare($query);
				$stmt->execute(
					array(
						'mshs' => $_POST["taikhoan"],
						'matkhau' => $_POST["matkhau"]
                        
					)
				);
                $row = $stmt->fetch();
				$count = $stmt->rowCount();
				if($count>0){
					$_SESSION["mshs"]= $_POST["taikhoan"];
					$_SESSION["hotenhs"]= $row['hoten'];
                    header('location: tracuudiem.php');
				}
			}
		}
	}

    public function lopphutrach(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT tenlop, lh.mlop, COUNT(ctl.mlop) as siso FROM giangday gd JOIN lophoc lh JOIN chitietlop ctl ON gd.mlop = lh.mlop AND lh.mlop= ctl.mlop WHERE gd.msgv = :msgv GROUP BY ctl.mlop;");
        $stmt->execute(array(
            'msgv'=> $_SESSION['msgv']
        ));
        while ($row = $stmt->fetch()) {
            $qldiem = new QLDiem($this->db);
            $qldiem->fillFromDB($row);
            $qld[] = $qldiem;
            }
        return $qld;
    }


    protected function fillFromDB(array $row){
        [
            'tenlop' => $this->tenlop,
            'mlop' => $this->mlop,
            'siso' => $this->siso
        ] = $row;
        return $this;
    }

    public function gettenlop($malop){
        $stmt = $this->db->prepare("SELECT tenlop FROM lophoc WHERE mlop = '$malop'");
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['tenlop'];
    }


    public function dsdiem(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT * FROM chitietlop ctlop JOIN hocsinh hs JOIN diem d JOIN chitietdiem ctd ON ctlop.mshs = hs.mshs AND d.mshs = hs.mshs AND d.mdiem = ctd.mdiem WHERE mlop = :mlop AND d.msgv = :msgv");
        $stmt->execute(
            array(
                'mlop' => $_REQUEST['mlop'],
                'msgv' => $_SESSION['msgv']
            )
            );
        while ($row = $stmt->fetch()) {
            $qldiem = new QLDiem($this->db);
            $qldiem->fillFromDB1($row);
            $qld[] = $qldiem;
            }
        return $qld;
    }
    protected function fillFromDB1(array $row){
        [
            'mshs' => $this->mshs,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'mlop' => $this->mlop,
            'M' => $this->m,
            '15p1' => $this->p15_1,
            '15p2' => $this->p15_2,
            '15p3' => $this->p15_3,
            '1t1' => $this->t1_1,
            '1t2' => $this->t1_2,
            '1t3' => $this->t1_3,
            'hk' => $this->hk,
            'tbhk' => $this->tbhk


        ] = $row;
        return $this;
    }

    public function dslop(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT * FROM chitietlop ctlop JOIN hocsinh hs ON ctlop.mshs = hs.mshs WHERE mlop = :mlop");
        $stmt->execute(
            array(
                'mlop' => $_REQUEST['mlop']
            )
            );
        while ($row = $stmt->fetch()) {
            $qldiem = new QLDiem($this->db);
            $qldiem->fillFromDB2($row);
            $qld[] = $qldiem;
            }
        return $qld;
    }
    protected function fillFromDB2(array $row){
        [
            'mshs' => $this->mshs,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'mlop' => $this->mlop
        ] = $row;
        return $this;
    }

    
    public function mongd(){
        $stmt = $this->db->prepare("SELECT tenmon, gd.mmon FROM giangday gd JOIN monhoc mh WHERE gd.mmon = mh.mmon AND msgv=:msgv");
        $stmt->execute(array(
            'msgv'=> $_SESSION['msgv']
        ));

        while($row = $stmt->fetch()){
            $_SESSION['mmon'] = $row['mmon'] ;
            $_SESSION['tenmon'] = $row['tenmon'] ;
        }
    }

    public function diemcanhan(){
        $stmt = $this->db->prepare("SELECT * FROM chitietdiem WHERE mdiem = (SELECT mdiem FROM diem WHERE mshs = :mshs AND msgv = :msgv and mmon = :mmon AND mnamhoc = :mnamhoc AND hocky = :hocky)");
        $stmt->execute(array(
            'mshs' => $_REQUEST['mshs'],
            'msgv' => $_SESSION['msgv'],
            'mmon' => $_SESSION['mmon'],
            'mnamhoc' => $this->mnamhoc,
            'hocky' => $this->hocky
        ));

        $row = $stmt->fetch();
        $_SESSION['mdiem'] = $row['mdiem'];
        $qldiem = new QLDiem($this->db);
        $qldiem->fillFromDB3($row);
        $qld[] = $qldiem;
        return $qld;
    }

    protected function fillFromDB3(array $row){
        [   
            'mdiem' => $this->mdiem,
            'M' => $this->m,
            '15p1' => $this->p15_1,
            '15p2' => $this->p15_2,
            '15p3' => $this->p15_3,
            '1t1' => $this->t1_1,
            '1t2' => $this->t1_2,
            '1t3' => $this->t1_3,
            'hk' => $this->hk,
            'tbhk' => $this->tbhk

        ] = $row;
        return $this;
    }

    public function luudiem2(){
        if(isset($_POST["15p1"])){
            $qld = [];
            $x = array(
                $_SESSION['mdiem'],
                $_POST["M"],
                $_POST["15p1"],
                $_POST["15p2"],
                $_POST["15p3"],
                $_POST["1t1"],
                $_POST["1t2"],
                $_POST["1t3"],
                $_POST["hk"]
            );
            $y = array(
                'mdiem',
                'M',
                '15p1',
                '15p2',
                '15p3',
                '1t1',
                '1t2',
                '1t3',
                'hk',
            );
            $sum = 0;
            $dem = 0;
            for ( $i =1 ; $i < count($x) ; $i++  ) {
                if ($x[$i] !=''){
                    $stmt = $this->db->prepare("UPDATE chitietdiem
                        SET $y[$i] = '$x[$i]'  WHERE $y[0] = '$x[0]'");
                    $stmt->execute();
                    if($i==5 || $i==6 || $i==7){
                        $sum += $x[$i]*2;
                        $dem += 2;
                    }
                    if($i==8){
                        $sum += $x[$i]*3;
                        $dem +=3;
                    }
                    else {
                        $sum += $x[$i];
                        $dem ++;
                    }
                }
                
                else{
                    $stmt = $this->db->prepare("UPDATE chitietdiem SET $y[$i] = NULL WHERE $y[0] = '$x[0]'");
                    $stmt->execute();    
                }
            }
            $tbhk='';
            if($sum>0)
                $tbhk = round($sum/$dem,2);
            if($tbhk >=0 && $tbhk <= 10){    
                $stmt2 = $this->db->prepare("UPDATE chitietdiem
                    SET tbhk = '$tbhk'  WHERE $y[0] = '$x[0]'");
                $stmt2->execute();
            }else {
                $stmt = $this->db->prepare("UPDATE chitietdiem SET tbhk = NULL WHERE $y[0] = '$x[0]'");
                    $stmt->execute();
            }
        }
    }
    public function luuSession(){
        if(isset ($_REQUEST['mshs'])){
            $_SESSION['mshs']= $_REQUEST['mshs'];
            $_SESSION['hotenhs']= $_REQUEST['hoten'];
        }
    }
    
    public function gettenhs($maso){
        $stmt = $this->db->prepare("SELECT hoten FROM hocsinh WHERE mshs=$maso");
        $stmt->execute();

        $row = $stmt->fetch();
        return $row['hoten'];
        
    }

    public function hienthidiem1($maso){
        $stmt = $this->db->prepare("SELECT mh.mmon,tenmon, M, 15p1,15p2,15p3,1t1,1t2,1t3,hk,tbhk FROM diem d JOIN chitietdiem ctd JOIN monhoc mh on d.mdiem=ctd.mdiem AND d.mmon = mh.mmon WHERE mshs = $maso AND mnamhoc = :mnamhoc AND hocky = 1");
        $stmt->execute(array(
            'mnamhoc' => $this->mnamhoc
        ));
        $count = $stmt->rowCount();
        if($count>0){
            $dem=0;
            $tong=0;
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB4($row);
                $qld[] = $qldiem;
                $dem++;
                $tong += $row['tbhk'];
            }
            $this->diemtbhk1= $tong/$dem;
            return $qld;
        }else return 1;
    }

    protected function fillFromDB4(array $row){
        [   
            'tenmon'=> $this->tenmon,
            'mmon' => $this->mmon,
            'M' => $this->m,
            '15p1' => $this->p15_1,
            '15p2' => $this->p15_2,
            '15p3' => $this->p15_3,
            '1t1' => $this->t1_1,
            '1t2' => $this->t1_2,
            '1t3' => $this->t1_3,
            'hk' => $this->hk,
            'tbhk' => $this->tbhk

        ] = $row;
        return $this;
    }

    public function hienthidiem2($maso){
        $stmt = $this->db->prepare("SELECT mh.mmon,tenmon, M, 15p1,15p2,15p3,1t1,1t2,1t3,hk,tbhk FROM diem d JOIN chitietdiem ctd JOIN monhoc mh on d.mdiem=ctd.mdiem AND d.mmon = mh.mmon WHERE mshs = $maso AND mnamhoc = :mnamhoc AND hocky = 2");
        $stmt->execute(array(
            'mnamhoc' => $this->mnamhoc
        ));
        $count = $stmt->rowCount();
        if($count>0){
            $dem=0;
            $tong=0;
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB4($row);
                $qld[] = $qldiem;
                $dem++;
                $tong += $row['tbhk'];
            }
            $this->diemtbhk2= $tong/$dem;
            return $qld;
        }
        else{
            return 1;
        }
    }

    public function hienthidiem3($maso){
        $stmt = $this->db->prepare("SELECT mh.mmon,tenmon, M, 15p1,15p2,15p3,1t1,1t2,1t3,hk,tbhk FROM diem d JOIN chitietdiem ctd JOIN monhoc mh on d.mdiem=ctd.mdiem AND d.mmon = mh.mmon WHERE mshs = $maso AND mnamhoc = :mnamhoc AND hocky = 1");
        $stmt->execute(array(
            'mnamhoc' => $this->mnamhoc
        ));
        $count = $stmt->rowCount();
        if($count>0){
            $dem=0;
            $tong=0;
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB4($row);
                $qld[] = $qldiem;
                $dem++;
                $tong += $row['tbhk'];
            }
            $this->diemtbhk1= $tong/$dem;
            return $qld;
        }else return 1;
    }


    public function hienthidiem4($maso){
        $stmt = $this->db->prepare("SELECT mh.mmon,tenmon, M, 15p1,15p2,15p3,1t1,1t2,1t3,hk,tbhk FROM diem d JOIN chitietdiem ctd JOIN monhoc mh on d.mdiem=ctd.mdiem AND d.mmon = mh.mmon WHERE mshs = $maso AND mnamhoc = :mnamhoc AND hocky = 2");
        $stmt->execute(array(
            'mnamhoc' => $this->mnamhoc
        ));
        $count = $stmt->rowCount();
        if($count>0){
            $dem=0;
            $tong=0;
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB9($row);
                $qld[] = $qldiem;
                $dem++;
                $tong += $row['tbhk'];
            }
            $this->diemtbhk2= $tong/$dem;
            return $qld;
        }
        else{
            return 1;
        }
    }

    public function taomdiem(){
        $stmt = $this->db->prepare("SELECT * FROM diem WHERE mshs= :mshs AND mmon=:mmon AND mnamhoc=:mnamhoc AND hocky=:hocky AND msgv=:msgv");
        $stmt->execute(array(
            'mshs'=>$_REQUEST['mshs'],
            'mmon'=> $_SESSION['mmon'],
            'mnamhoc'=> $this->mnamhoc,
            'hocky'=> $this->hocky,
            'msgv'=> $_SESSION['msgv']
        ));
        $count = $stmt->rowCount();
        if($count==0){
            $stmt = $this->db->prepare("INSERT INTO diem (mshs, mmon, mnamhoc, hocky, msgv) VALUES (:mshs, :mmon, :mnamhoc, :hocky, :msgv)");
            $stmt->execute(array(
                'mshs'=>$_REQUEST['mshs'],
                'mmon'=> $_SESSION['mmon'],
                'mnamhoc'=> $this->mnamhoc,
                'hocky'=> $this->hocky,
                'msgv'=> $_SESSION['msgv']
            ));



            $stmt = $this->db->prepare("SELECT mdiem FROM diem WHERE mshs = :mshs AND msgv = :msgv AND mmon = :mmon AND mnamhoc = :mnamhoc AND hocky = :hocky");
            $stmt->execute(array(
                'mshs'=>$_REQUEST['mshs'],
                'mmon'=> $_SESSION['mmon'],
                'mnamhoc'=> $this->mnamhoc,
                'hocky'=> $this->hocky,
                'msgv'=> $_SESSION['msgv']
            ));
            $count = $stmt->rowCount();
            while ($row = $stmt->fetch()) {
                $md['mdiem'] = $row['mdiem'];
            }
            $count = $stmt->rowCount();
            if($count>0){
                $stmt = $this->db->prepare("INSERT INTO chitietdiem (mdiem) VALUES (:mdiem)");
                $stmt->execute(
                    array(
                        'mdiem'=> $md['mdiem']
                    )
                );
            }
        }   
    }

    public function dslopcn(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT * FROM chunhiem cn JOIN chitietlop ctl JOIN hocsinh hs ON ctl.mlop = cn.mlop AND ctl.mshs = hs.mshs WHERE msgv = :msgv AND cn.mnamhoc =:mnamhoc; ");
        $stmt->execute(
            array(
                'msgv' => $_SESSION['msgv'],
                'mnamhoc' => $this->mnamhoc
            )
            );
        while ($row = $stmt->fetch()) {
            $qldiem = new QLDiem($this->db);
            $qldiem->fillFromDB14($row);
            $qld[] = $qldiem;
            }
        return $qld;
    }
    protected function fillFromDB14(array $row){
        [
            'mshs' => $this->mshs,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'mlop' => $this->mlop
        ] = $row;
        return $this;
    }

    public function getlopcn(){
        $stmt = $this->db->prepare("SELECT tenlop, chunhiem.mlop FROM chunhiem JOIN lophoc ON chunhiem.mlop = lophoc.mlop WHERE msgv = :msgv");
        $stmt->execute(array(
            'msgv'=> $_SESSION['msgv']
        ));

        while($row = $stmt->fetch()){
            $_SESSION['mlopcn'] = $row['mlop'] ;
            $_SESSION['tenlopcn'] = $row['tenlop'] ;
        }
    }

    public function dsdiemtheomon($malop, $mamon, $hky){
        $qld = [];
        $stmt = $this->db->prepare("SELECT * FROM chitietlop ctl JOIN diem d JOIN chitietdiem ctd JOIN hocsinh hs ON ctl.mshs = d.mshs AND ctd.mdiem = d.mdiem AND hs.mshs = d.mshs WHERE mlop='$malop' AND d.mnamhoc = :mnamhoc AND hocky = $hky AND d.mmon = '$mamon'");
        $stmt->execute(
            array(
                'mnamhoc' => $this->mnamhoc
            )
        );
        while ($row = $stmt->fetch()) {
            $qldiem = new QLDiem($this->db);
            $qldiem->fillFromDB15($row);
            $qld[] = $qldiem;
        }
        return $qld;
    }
    protected function fillFromDB15(array $row){
        [   
            'mshs' => $this->mshs,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'mlop' => $this->mlop,
            'M' => $this->m,
            '15p1' => $this->p15_1,
            '15p2' => $this->p15_2,
            '15p3' => $this->p15_3,
            '1t1' => $this->t1_1,
            '1t2' => $this->t1_2,
            '1t3' => $this->t1_3,
            'hk' => $this->hk,
            'tbhk' => $this->tbhk

        ] = $row;
        return $this;
    }

    function gettenmon($mamon){
        $stmt = $this->db->prepare("SELECT * FROM monhoc WHERE mmon = '$mamon'");
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['tenmon'];
    }
    
    // Trang quản trị
    public function loginquantri(){
		if(isset($_POST["submit"])){
			if(isset($_POST["taikhoan"])&& isset($_POST["matkhau"])){
				$query= "SELECT * FROM tkquantri WHERE taikhoan = :taikhoan AND matkhau = :matkhau";
				$stmt = $this->db->prepare($query);
				$stmt->execute(
					array(
						'taikhoan' => $_POST["taikhoan"],
						'matkhau' => $_POST["matkhau"],
                        
					)
				);
				$count = $stmt->rowCount();
				if($count>0){
					$_SESSION["quantri"]= $_POST["taikhoan"];
					header('location: quantri.php');
				}
			}
		}
	}

    public function dsgv(){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT msgv, hoten, ngaysinh, gioitinh, tenmon FROM giaovien JOIN monhoc WHERE chuyenmon = mmon");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB5($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }
    protected function fillFromDB5(array $row){
        [
            'msgv' => $this->msgv,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'tenmon' => $this->chuyenmon

        ] = $row;
        return $this;
    }

    public function luugv(){
        if(isset($_POST["submit"])){
            $stmt = $this->db->prepare("INSERT INTO giaovien (hoten, ngaysinh, gioitinh, diachi, chuyenmon) VALUES (:hoten, :ngaysinh, :gioitinh, :diachi, :chuyenmon)");
            $stmt->execute(
                array(
                    'hoten'=> $_POST['hoten'],
                    'ngaysinh'=> $_POST['ngaysinh'],
                    'gioitinh'=> $_POST['gioitinh'],
                    'diachi'=> $_POST['diachi'],
                    'chuyenmon'=> $_POST['chuyenmon'],
                )
            );
        }
    }

    public function themtk(){
        if(isset($_POST["submit"])){
            $mk = $this->rand_string(6);
            $stmt = $this->db->prepare("SELECT msgv FROM giaovien WHERE hoten = :hoten AND ngaysinh = :ngaysinh");
            $stmt->execute(
                array(
                    'hoten'=> $_POST['hoten'],
                    'ngaysinh'=> $_POST['ngaysinh']
                )
            );
            while ($row = $stmt->fetch()) {
                $ms['msgv'] = $row['msgv'];
            }
            $stmt = $this->db->prepare("INSERT INTO tkgv(msgv, matkhau) VALUES (:msgv, :matkhau)");
            $stmt->execute(
                array(
                    'msgv'=> $ms['msgv'],
                    'matkhau' => $mk
                )
            );
            header('location: qlgiaovien.php');
        }
    }

    public function themtkgv($msgv){
            $mk = $this->rand_string(6);
            $stmt = $this->db->prepare("INSERT INTO tkgv(msgv, matkhau) VALUES (:msgv, :matkhau)");
            $stmt->execute(
                array(
                    'msgv'=> $msgv,
                    'matkhau' => $mk
                )
            );
    }

    public function xoagv(){
        $stmt = $this->db->prepare("DELETE FROM giaovien WHERE msgv = :msgv");
        $stmt->execute(
            array(
                'msgv'=> $_REQUEST['msgv']
            )
        );
        
        header('location: xoagiaovien.php');
    }

    public function laychuyenmon(){
        $stmt = $this->db->prepare("SELECT chuyenmon FROM giaovien WHERE msgv = :msgv");
        $stmt->execute(array(
            'msgv'=>$_REQUEST['msgv']
        ));
        $row = $stmt->fetch();
        return $row['chuyenmon'];
    }

    public function dslophocchuaphanconggd($chuyenmon){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT mlop, tenlop FROM lophoc WHERE mlop = ANY (SELECT mlop FROM lophoc EXCEPT (SELECT mlop FROM giangday WHERE mmon = :mmon))");
            $stmt->execute(array(
                'mmon'=> $chuyenmon
            ));
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB6($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }

    protected function fillFromDB6(array $row){
        [
            'mlop'=> $this->mlop,
            'tenlop' => $this->tenlop

        ] = $row;
        return $this;
    }

    public function dslophocdaphanconggd($chuyenmon){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT mgd, gd.mlop,tenlop,gv.hoten FROM giangday gd JOIN lophoc lh JOIN giaovien gv ON gd.mlop = lh.mlop AND gd.msgv= gv.msgv WHERE mmon = :mmon");
            $stmt->execute(array(
                'mmon'=> $chuyenmon
            ));
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB7($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }

    protected function fillFromDB7(array $row){
        [
            'mlop'=> $this->mlop,
            'tenlop' => $this->tenlop,
            'hoten' => $this->hoten,
            'mgd' => $this->mgd

        ] = $row;
        return $this;
    }

    public function phanconggd($chuyenmon){
        $stmt = $this->db->prepare("INSERT INTO giangday (msgv, mlop, mnam, mmon) VALUES (:msgv, :mlop, :mnam, :mmon)");
        $stmt->execute(array(
            'msgv'=>$_REQUEST['msgv'],
            'mlop'=>$_REQUEST['mlop'],
            'mnam'=>$this->mnamhoc,
            'mmon'=>$chuyenmon
        ));
        header('location: phanconggd.php?msgv=' . $_REQUEST['msgv']);
    }

    public function huyphanconggd(){
        $stmt = $this->db->prepare("DELETE FROM giangday WHERE giangday.mgd = :mgd");
        $stmt->execute(array(
            'mgd'=>$_REQUEST['mgd']
        ));
        header('location: phanconggd.php');
    }

    // public function dslophocchuaphancongcn(){
    //     if(isset($_SESSION["quantri"])){
    //         $qld = [];
    //         $stmt = $this->db->prepare("SELECT lophoc.mlop, lophoc.tenlop, COUNT(chitietlop.mlop) AS siso FROM chitietlop JOIN lophoc ON  lophoc.mlop = chitietlop.mlop  WHERE chitietlop.mlop= any (SELECT mlop FROM chitietlop GROUP BY chitietlop.mlop EXCEPT (SELECT mlop FROM chunhiem))GROUP BY chitietlop.mlop");
    //         $stmt->execute();
    //         while ($row = $stmt->fetch()) {
    //             $qldiem = new QLDiem($this->db);
    //             $qldiem->fillFromDB8($row);
    //             $qld[] = $qldiem;
    //             }
    //         return $qld;
    //     }
    //     else{
    //         header('location: loginquantri.php');
    //     }
    // }

    // protected function fillFromDB8(array $row){
    //     [
    //         'mlop'=> $this->mlop,
    //         'tenlop' => $this->tenlop,
    //         'siso' => $this->siso

    //     ] = $row;
    //     return $this;
    // }

    public function dshocsinh(){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT hocsinh.mshs, hoten, ngaysinh, gioitinh, diachi, lophoc.tenlop FROM hocsinh JOIN chitietlop JOIN lophoc ON hocsinh.mshs = chitietlop.mshs AND chitietlop.mlop = lophoc.mlop");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB10($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
    }

    protected function fillFromDB10(array $row){
        [
            'mshs'=> $this->mshs,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh' => $this->gioitinh,
            'diachi' => $this->diachi,
            'tenlop' => $this->tenlop,

        ] = $row;
        return $this;
    }

    public function dslophocchuaphancongcn(){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT * FROM lophoc WHERE mlop != All (SELECT mlop FROM chunhiem)");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB11($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }

    protected function fillFromDB11(array $row){
        [
            'tenlop' => $this->tenlop,
            'mlop' => $this->mlop
        ] = $row;
        return $this;
    }

    public function dslophocdaphancongcn(){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT tenlop, hoten, chunhiem.mchunhiem FROM chunhiem JOIN giaovien JOIN lophoc ON giaovien.msgv = chunhiem.msgv AND lophoc.mlop = chunhiem.mlop ");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB12($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }

    protected function fillFromDB12(array $row){
        [
            'tenlop' => $this->tenlop,
            'hoten' => $this->hoten,
            'mchunhiem' => $this->mchunhiem

        ] = $row;
        return $this;
    }

    public function phancongcn(){
        $stmt = $this->db->prepare("SELECT * FROM chunhiem WHERE msgv = :msgv AND mnamhoc = :mnamhoc");
        $stmt->execute(array(
            'msgv'=>$_REQUEST['msgv'],
            'mnamhoc'=>$this->mnamhoc
        ));
        $row = $stmt->fetch();
		$count = $stmt->rowCount();
        if($count==0){
            $stmt = $this->db->prepare("INSERT INTO chunhiem (msgv, mlop, mnamhoc) VALUES (:msgv, :mlop, :mnamhoc)");
            $stmt->execute(array(
                'msgv'=>$_REQUEST['msgv'],
                'mlop'=>$_REQUEST['mlop'],
                'mnamhoc'=>$this->mnamhoc
            ));
            
        }
        header('location: phancongcn.php?msgv=' . $_REQUEST['msgv']);
    }

    public function huyphancongcn(){
        $stmt = $this->db->prepare("DELETE FROM chunhiem WHERE mchunhiem = :mchunhiem");
        $stmt->execute(array(
            'mchunhiem'=>$_REQUEST['mchunhiem']
        ));
        header('location: phancongcn.php?msgv=' . $_REQUEST['msgv']);
    }

    public function alllop(){
        if(isset($_SESSION["quantri"])){
            $qld = [];
            $stmt = $this->db->prepare("SELECT chitietlop.mlop, COUNT(chitietlop.mlop) as siso, tenlop FROM chitietlop JOIN lophoc on lophoc.mlop = chitietlop.mlop GROUP by mlop");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $qldiem = new QLDiem($this->db);
                $qldiem->fillFromDB13($row);
                $qld[] = $qldiem;
                }
            return $qld;
        }
        else{
            header('location: loginquantri.php');
        }
    }

    protected function fillFromDB13(array $row){
        [
            'tenlop' => $this->tenlop,
            'mlop' => $this->mlop,
            'siso' => $this->siso,
            'mlop' => $this->mlop

        ] = $row;
        return $this;
    }

    public function gettengv($maso){
        $stmt = $this->db->prepare("SELECT hoten FROM giaovien WHERE msgv=:msgv");
        $stmt->execute(array(
            'msgv'=>$maso
        ));
        $row = $stmt->fetch();
        return $row['hoten'];
    }

}