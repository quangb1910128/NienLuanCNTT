<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem điểm theo môn học</title>
</head>
<body>
<div>
        <a href="lopphutrach.php">Lớp phụ trách</a>
        <a href="lopchunhiem.php">Lớp chủ nhiệm</a>
    </div>
    <div>
        <h3>Lớp: 10A1</h3>
    </div>
    <div>
        <form action="xemdiemtheomon.php" method="get">
            Chọn môn học:     
            <select name="monhoc" id="">
                <option value="Toán học">Toán</option>
                <option value="Vật Lý">Lý</option>
                <option value="Hóa học">Hóa</option>
                <option value="Sinh học">Sinh</option>
                <option value="Ngữ văn">Văn</option>
                <option value="Lịch sử">Sử</option>
                <option value="Địa lý">Địa</option>
            </select>
            Chọn học kỳ:
            <select name="hocky" id="">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <input type="submit" value="Xác nhận">
        </form>
    </div>
    <br>
    <div>
        Bảng điểm môn <b>Toán </b> học kì <b>1</b> năm học <b>2022-2023</b>
    </div>
    <br>
    <table border="1" width="500">
        <tbody>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Điểm miệng</th>
                <th colspan="3">Điểm 15p</th>
                <th colspan="3">Điểm 1 tiết</th>
                <th>Học kỳ</th>
                <th>TBM</th>
            </tr>
             <tr>
                <td>1</td>
                <td>Đoàn Minh Quang</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
             </tr>
             <tr>
                <td>2</td>
                <td>Nguyễn Văn Đạt</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
             </tr>
        </tbody>
    </table>
</body>
</html>