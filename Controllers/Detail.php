<?php

class Detail extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        $title = $this->TitleHandle($param, 1) ?? $this->View("Error");
        $detail = $this->Model("Products")->getProductDetailName($title);
        if ($detail) {
            $detail['type'] = $detail['category_id'] == 1 ? "Laptop" : "Laptop";
            $gallery = $this->Model("Products")->getProductGallery($detail['id']);
            $this->View("Detail", [
                "detail" => $detail,
                "gallery" => $gallery
            ]);
            $this->Model("Usages")->ProductViewCount($detail['id']);
        } else {
            $this->View("Error");
        }
    }
}
