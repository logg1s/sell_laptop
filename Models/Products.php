<?php
class Products extends DB
{
    public function getProduct($category = 1)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and product.category_id = '$category' and deleted = '0' and num > '0' order by created_at desc";
        return $this->command($qr) ?? false;
    }

    public function getProductDetailID($id)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and product.num > '0' and product.id = '$id' and deleted = '0'
        ";
        return $this->command($qr) ?? false;
    }
    public function getProductDetailName($name)
    {
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and product.title = '$name' and deleted = '0'
        ";
        return $this->command($qr)->fetch_assoc() ?? false;
    }
    public function getProductGallery($id){
        $qr = "select * from gallery where product_id = '$id'";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function SearchProduct($content)
    {
        $qr = "SELECT * FROM product, product_details WHERE product.id = product_details.product_id and (MATCH(title, description) AGAINST ('$content' IN NATURAL LANGUAGE MODE) or product.title like '%$content%') and deleted = '0'";
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
        try{
            return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
        }
        catch(Exception){
            return false;
        }
    }

    public function UpdateNum($id, $action = 'num - 1'){
        $qr = "update product set num = $action where id = '$id' and num >= '0'";
        return $this->command($qr);
    }
    public function getHot(){
        $qr = "select * from product, product_details, category where product.id = product_id and product.category_id = category.category_id and deleted = '0' and num > '0' and hot = '1' order by view desc ";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
}
