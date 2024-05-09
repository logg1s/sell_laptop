<?php
class Products extends DB
{
    public function getProduct($category = 1)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and product.category_id = '$category' and num > '0' and deleted = '0' order by selled desc";
        return $this->command($qr) ?? false;
    }

    public function getProductDetailID($id)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and product.num > '0' and product.id = '$id'
        ";
        return $this->command($qr) ?? false;
    }
    public function getProductDetailName($name)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and num > '0' and product.title = '$name'
        ";
        return $this->command($qr)->fetch_assoc() ?? false;
    }
    public function SearchProduct($content)
    {
        $qr = "SELECT * FROM product, product_details WHERE product.id = product_details.product_id and (MATCH(title, description) AGAINST ('$content' IN NATURAL LANGUAGE MODE) or product.title like '%$content%')";
        try {
            return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
        } catch (Exception) {
            return false;
        }
    }
    public function GetManufacturerLaptop()
    {
        $qr = "select DISTINCT manufacturer from product_details where type='Laptop'";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }

    public function GetProductLaptop(
        $manufacturer,
        $price,
        $screen,
        $cpu,
        $ram,
        $gpu,
        $storage,
        $sort
    ) {
        $qr = "select * from product, product_details where product.id = product_id and product.category_id = '1' and num > '0'  and deleted = '0' and type='Laptop' $manufacturer $price $screen $cpu $ram $gpu $storage $sort";
        try {
            return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
        } catch (Exception) {
            return false;
        }
    }

    public function UpdateNum($id, $action = 'num - 1')
    {
        $qr = "update product set num = $action where id = '$id' and num >= '0'";
        return $this->command($qr);
    }
    public function getAllSupplier()
    {
        $qr = 'select * from supplier';
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllProduct($where = "")
    {
        $qr = "select product.*, product_details.*, category.* from product, product_details ,category where product.category_id = category.category_id and product.id = product_details.product_id $where order by id desc";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllCategory()
    {
        $qr = 'select category_id, name as category_name from category';
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function delete($id)
    {
        $qr = "delete from product where id = '$id'";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function deleteall()
    {
        $qr = "delete from product";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function updateProduct($id, $category_id, $title, $price_in, $price, $price_out, $num, $thumbnail, $description, $supplier)
    {
        $qr = "update product set category_id = '$category_id', title='$title', price_in = '$price_in', price='$price', price_out = '$price_out', num='$num', thumbnail = '$thumbnail', description='$description', supplier_id = $supplier ,updated_at = default where id = '$id'";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function updateProductDetail(
        $id,
        $manufacturer,
        $screen,
        $cpu,
        $ram,
        $gpu,
        $storage,
        $weight,
        $os,
        $promotion,
        $type
    ) {
        $qr = "update product_details set manufacturer ='$manufacturer',screen =$screen, cpu ='$cpu',ram =$ram, gpu ='$gpu', storage =$storage, weight = $weight, os='$os', promotion = '$promotion', type = '$type'  where product_id = '$id'";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function hideshow($id, $status)
    {
        $qr = "update product set deleted = '$status' where id = '$id'";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }

    public function insertProduct(
        $danhmuc,
        $tensanpham,
        $gianhap,
        $giagoc,
        $giaban,
        $soluong,
        $hinhanh,
        $mota,
        $nhacungcap
    ) {
        try {
            $qr = "insert into product (category_id, title, price_in, price, price_out, num, thumbnail, description,created_at, supplier_id) values('$danhmuc','$tensanpham','$gianhap','$giagoc','$giaban','$soluong','$hinhanh','$mota', default, $nhacungcap)";
            return $this->command($qr);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertProductDetail(
        $nhasanxuat,
        $manhinh,
        $cpu,
        $ram,
        $gpu,
        $storage,
        $weight,
        $os,
        $promotion,
        $type
    ) {
        $last_id = $this->command("select id from product order by id desc")->fetch_assoc()["id"] ?? '1';
        // return $last_id['id'];
        $qr = "insert into product_details (product_id, manufacturer, screen, cpu, ram, gpu, storage, weight, os, promotion, type) values( 
        '$last_id',
        '$nhasanxuat',
        $manhinh,
        '$cpu',
        $ram,
        '$gpu',
        $storage,
        $weight,
        '$os',
        '$promotion',
        '$type')";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function hot($id, $hot){
        $qr = "update product set hot = '$hot' where id = '$id'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception){
            return false;
        }
    }
    public function hideshowAll($deleted){
        $qr = "update product set deleted = '$deleted'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception){
            return false;
        }
    }
    public function hotAll($hot){
        $qr = "update product set hot = '$hot'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception){
            return false;
        }
    }
}
