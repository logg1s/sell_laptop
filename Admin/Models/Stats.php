<?php
class Stats extends DB
{
    public function TongKhachHang()
    {
        $qr = "select count(*) from user where role_id = '1'";
        return $this->command($qr)->fetch_array()[0];
    }
    public function TongSanPham()
    {
        $qr = "select count(*) from product where num > '0'";
        return $this->command($qr)->fetch_array()[0];
    }
    public function TongDonHang()
    {
        $qr = "SELECT count(*) FROM `orders`";
        return $this->command($qr)->fetch_array()[0];
    }
    public function DaBan()
    {
        $qr = "SELECT count(*) FROM orders where status = '2'";
        return $this->command($qr)->fetch_array()[0];
    }
    public function SapHetHang()
    {
        $qr = "select count(*) from product where num <= '5' and num > '0'";
        return $this->command($qr)->fetch_array()[0];
    }
    public function HetHang()
    {
        $qr = "select count(*) from product where num < 1";
        return $this->command($qr)->fetch_array()[0];
    }
    public function DonHangHuy()
    {
        $qr = "select count(*) from orders where status in('-1', '100')";
        return $this->command($qr)->fetch_array()[0];
    }
    public function ChoXuLi()
    {
        $qr = "select count(*) from orders where status = '0'";
        return $this->command($qr)->fetch_array()[0];
    }

    public function TongLuotTruyCap()
    {
        $qr = "select count(*) from web_usage";
        return $this->command($qr)->fetch_array()[0];
    }
    public function TongLuotTruyCapTrongNgay()
    {
        $qr = "select count(*) from web_usage where day(now()) = day(datetime) and year(now()) = year(datetime)";
        return $this->command($qr)->fetch_array()[0];
    }
    public function LuotTruyCapTungThang()
    {
        // $qr = "SELECT CONCAT('Tháng ', m.month) AS Thang, IFNULL(u.SoLuong, 0) AS SoLuong
        // FROM (
        //     SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
        //     UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        // ) AS m
        // LEFT JOIN (
        //     SELECT MONTH(datetime) AS month, COUNT(*) AS SoLuong
        //     FROM web_usage
        //     WHERE YEAR(NOW()) = YEAR(datetime)
        //     GROUP BY month
        // ) AS u ON m.month = u.month;";
        $qr = "SELECT CONCAT('Tháng ', m.month) AS Thang, IFNULL(u.SoLuong, 0) AS SoLuong, ifnull(u.maxViews,0) maxView,  ifnull(u.day,0) as Ngay
        FROM (
            SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
            UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        ) AS m
        LEFT JOIN (
            select B.month, SoLuong, maxViews, day from (SELECT A.month, sum(A.dayviews) as SoLuong, max(A.dayviews) as maxViews
            FROM (select month(datetime) month, day(datetime), count(*) dayviews from web_usage where year(datetime) = year(now()) group by month, day(datetime)) as A GROUP by A.month) as B, (select month(datetime) month, day(datetime) day, count(*) dayviews from web_usage where year(datetime) = year(now()) group by month, day) as C where C.month = B.month and C.dayviews = maxViews and SoLuong in (select count(*) SoLuong from web_usage where year(datetime) = year(now()) group by month(datetime))
            ) as u on m.month = u.month;";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }



    /*
        hang thang
        
        SELECT CONCAT('Tháng ', m.month) AS Thang, IFNULL(u.SoLuong, 0) AS SoLuong, ifnull(u.maxViews,0) maxView,  ifnull(u.day,0) as Ngay
        FROM (
            SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
            UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        ) AS m
        LEFT JOIN (
            select B.month, SoLuong, maxViews, day from (SELECT A.month, sum(A.dayviews) as SoLuong, max(A.dayviews) as maxViews
            FROM (select month(datetime) month, day(datetime), count(*) dayviews from web_usage where year(datetime) = year(now()) group by month, day(datetime)) as A GROUP by A.month) as B, (select month(datetime) month, day(datetime) day, count(*) dayviews from web_usage where year(datetime) = year(now()) group by month, day) as C where C.month = B.month and C.dayviews = maxViews and SoLuong in (select count(*) SoLuong from web_usage where year(datetime) = year(now()) group by month(datetime))
            ) as u on m.month = u.month;*/
    public function TongThuNhap()
    {
        // $qr = "select id, title, thumbnail, num, price_in, num*price_in as tiennhap, selled, price_out, selled * price_out as tienban, ( selled * price_out - num*price_in) as thunhap from product where year(now()) = year(created_at)";
        $qr = "SELECT product.id, product.title, product.thumbnail, product.num, 
        (ifnull(A.sum_num, 0) + product.num) as total_num,  
       product.price_in, (ifnull(A.sum_num,0) + product.num)*product.price_in as tiennhap, 
       ifnull(A.sum_num,0) as selled, IFNULL(A.sum_tienban, 0) as sum_tienban,(IFNULL(A.sum_tienban, 0) - (ifnull(A.sum_num,0) + product.num)*product.price_in) as thunhap 
FROM product 
LEFT JOIN (SELECT product_id, sum(num) as sum_num, sum(total_money) as sum_tienban 
           FROM orders where status = '2'
           GROUP BY product_id) as A ON A.product_id = product.id order by thunhap desc;";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function CongTongThuNhap()
    {
        // $qr = "select sum(num) as TongNhap, sum(price_in) as TongGiaNhap, sum(num*price_in) as TongTienNhap, sum(selled) as TongBan, sum(price_out) as TongGiaBan, sum(selled * price_out) as TongTienBan, sum(selled * price_out - num*price_in) as TongThuNhap from (select id, title, num, price_in, num*price_in as tiennhap, selled, price_out, selled * price_out as tienban, ( selled * price_out - num*price_in) as thunhap from product where year(now()) = year(created_at)) as A";
        $qr = "select sum(tiennhap) as TongTienNhap, sum(sum_tienban) as TongTienBan, sum(thunhap) as TongThuNhap from (SELECT product.id, product.title, product.thumbnail, product.num, 
        (ifnull(A.sum_num,0) + product.num) as total_num,  
       product.price_in, (ifnull(A.sum_num,0) + product.num)*product.price_in as tiennhap, 
       ifnull(A.sum_num,0) as selled, IFNULL(A.sum_tienban, 0) as sum_tienban,(IFNULL(A.sum_tienban, 0) - (ifnull(A.sum_num,0) + product.num)*product.price_in) as thunhap 
FROM product 
LEFT JOIN (SELECT product_id, sum(num) as sum_num, sum(total_money) as sum_tienban 
           FROM orders where status = '2'
           GROUP BY product_id) as A ON A.product_id = product.id) as B;";
        return $this->command($qr)->fetch_assoc();
    }
    public function ThuNhapHangThang()
    {
        // $qr = "SELECT CONCAT('Tháng ', t.month) AS Thang, COALESCE(SUM(p.tiennhap), 0) AS Von, COALESCE(SUM(p.tienban), 0) AS ThuNhap, COALESCE(SUM(p.tienban - p.tiennhap), 0) AS TongThuNhap
        // FROM (
        //   SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
        //   UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        // ) t
        // LEFT JOIN (
        //   SELECT id, title, MONTH(created_at) AS month, num, price_in, num * price_in AS tiennhap, selled, price_out, selled * price_out AS tienban, (selled * price_out - num * price_in) AS thunhap
        //   FROM product
        //   WHERE YEAR(NOW()) = YEAR(created_at)
        // ) p ON t.month = p.month
        // GROUP BY CONCAT('Tháng ', t.month);";
        $qr = "SELECT CONCAT('Tháng ', t.month) AS Thang, COALESCE(SUM(p.tiennhap), 0) AS Von, COALESCE(SUM(p.sum_tienban), 0) AS ThuNhap, COALESCE(SUM(p.thunhap), 0) AS TongThuNhap
        FROM (
          SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
         UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        ) t
        LEFT JOIN (SELECT ifnull(A.month,month(now())) as month ,product.id, product.title, product.thumbnail, product.num, 
       (ifnull(A.sum_num,0) + product.num) as total_num,  
      product.price_in, (ifnull(A.sum_num,0) + product.num)*product.price_in as tiennhap, 
      ifnull(A.sum_num,0) as selled, ifnull(A.sum_tienban,0) as sum_tienban, (ifnull(A.sum_tienban,0) - (ifnull(A.sum_num,0) + product.num)*product.price_in) as thunhap 
FROM product
LEFT JOIN (SELECT month(finish_date) as month, product_id, sum(num) as sum_num, sum(total_money) as sum_tienban 
          FROM orders where status = '2'
          GROUP BY month(finish_date), product_id) as A ON A.product_id = product.id) as p on t.month = p.month GROUP BY CONCAT('Tháng ', t.month);";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }

    public function SanPhamDaBanTrongNgay()
    {
        $qr = "select id, category.name as category_name, thumbnail, title, orders.price, sum(orders.num) as num, sum(total_money) as income, product.num as remain from orders, product, category where status = '2' and product_id = id and category.category_id = product.category_id and year(finish_date) = year(now()) and day(finish_date) = day(now()) group by id, price order by income desc";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function ThuNhapTrongNgay()
    {
        $qr = "select sum(total_money) as tntn from orders where status = '2' and year(now()) = year(finish_date) and day(now()) = day(finish_date)";
        return $this->command($qr)->fetch_assoc();
    }
    // public function TopLuotXem()
    // {
    //     $qr = "select product.*, name as category_name from product, category where product.category_id = category.category_id and product.selled > 0 order by selled desc limit 5";
    //     return $this->command($qr)->fetch_all((MYSQLI_ASSOC));
    // }
    public function SanPhamDaHet()
    {
        $qr = "select product.id, product.thumbnail, product.title, product.view, product.num, name as category_name, ifnull(A.sum_num,0) as selled, (ifnull(A.sum_money,0) - (product.num+ifnull(A.sum_num,0))*product.price_in) as income from product, category, (select product_id, sum(num) as sum_num,sum(total_money) as sum_money from orders where status = '2' group by product_id) as A where product.category_id = category.category_id and product.num < 1 and A.product_id = product.id order by income desc;";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
}
