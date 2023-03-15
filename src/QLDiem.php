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


	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['name'])) {
			$this->name = trim($data['name']);
		}

		if (isset($data['phone'])) {
			$this->phone = preg_replace('/\D+/', '', $data['phone']);
		}

		if (isset($data['notes'])) {
			$this->notes = trim($data['notes']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->name) {
			$this->errors['name'] = 'Invalid name.';
		}

		if (strlen($this->phone) < 10 || strlen($this->phone) > 11) {
			$this->errors['phone'] = 'Invalid phone number.';
		}

		if (strlen($this->notes) > 255) {
			$this->errors['notes'] = 'Notes must be at most 255 characters.';
		}

		return empty($this->errors);
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
				$query= "SELECT * FROM tkgv WHERE msgv = :msgv AND matkhau = :matkhau";
				$stmt = $this->db->prepare($query);
				$stmt->execute(
					array(
						'msgv' => $_POST["taikhoan"],
						'matkhau' => $_POST["matkhau"],
                        
					)
				);
				$count = $stmt->rowCount();
				if($count>0){
					$_SESSION["msgv"]= $_POST["taikhoan"];
					header('location: lopphutrach.php');
				}
			}
            if(isset($_POST["taikhoan"])&& isset($_POST["matkhau"]) && $_POST["quyen"]== 'tkhs'){
				$query= "SELECT * FROM tkhs WHERE mshs = :mshs AND matkhau = :matkhau";
				$stmt = $this->db->prepare($query);
				$stmt->execute(
					array(
						'mshs' => $_POST["taikhoan"],
						'matkhau' => $_POST["matkhau"],
                        
					)
				);
				$count = $stmt->rowCount();
				if($count>0){
					$_SESSION["mshs"]= $_POST["taikhoan"];
					header('location: tracuudiem.php');
				}
			}
		}
	}

    public function lopphutrach(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT tenlop, lh.mlop FROM giangday gd JOIN lophoc lh WHERE gd.mlop = lh.mlop AND msgv = '1';");
        $stmt->execute();
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
            'mlop' => $this->mlop
        ] = $row;
        return $this;
    }


    public function dslop(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT hs.mshs, hoten, ngaysinh, gioitinh, mlop FROM chitietlop ctlop JOIN hocsinh hs WHERE ctlop.mshs = hs.mshs AND mlop = :mlop");
        $stmt->execute(
            array(
                'mlop' => $_REQUEST['mlop']
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
            'mlop' => $this->mlop

        ] = $row;
        return $this;
    }

    public function nhapdiemlop(){
        $qld = [];
        $stmt = $this->db->prepare("SELECT hs.mshs, hoten, ngaysinh, mlop FROM chitietlop JOIN hocsinh hs WHERE mlop = :mlop");
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
            'mlop' => $this->mlop
        ] = $row;
        return $this;
    }

    
    public function mongd(){
        $stmt = $this->db->prepare("SELECT tenmon, mmon FROM giangday gd JOIN monhoc mh WHERE gd.mmon = mh.mamon AND msgv='1'");
        $stmt->execute();

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

    public function gettenhs(){
        $stmt = $this->db->prepare("SELECT hoten FROM hocsinh WHERE mshs=:mshs");
        $stmt->execute(
            array(
                'mshs'=>$_SESSION['mshs']
            )
        );

        $row = $stmt->fetch();
        $_SESSION['hoten'] = $row['hoten'] ;
        
    }

    public function diemtin(){
        $stmt = $this->db->prepare("SELECT * FROM chitietdiem WHERE mdiem = (SELECT mdiem FROM diem WHERE mshs = :mshs AND mmon = 'tin' AND mnamhoc = :mnamhoc AND hocky = :hocky)");
        $stmt->execute(array(
            'mshs' => $_SESSION['mshs'],
            'mnamhoc' => $this->mnamhoc,
            'hocky' => $this->hocky
        ));

        while ($row = $stmt->fetch()) {
        $qldiem = new QLDiem($this->db);
        $qldiem->fillFromDB4($row);
        $qld[] = $qldiem;
        return $qld;
        }
    }

    protected function fillFromDB4(array $row){
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
            $stmt = $this->db->prepare("SELECT msgv, hoten, ngaysinh, gioitinh, tenmon FROM giaovien JOIN monhoc WHERE chuyenmon = mamon");
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

    public function xoagv(){
        $stmt = $this->db->prepare("DELETE FROM giaovien WHERE msgv = :msgv");
        $stmt->execute(
            array(
                'msgv'=> $_REQUEST['msgv']
            )
        );
        
        header('location: xoagiaovien.php');
    }

}