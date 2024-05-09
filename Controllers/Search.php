<?php
class Search extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        if (!empty($_REQUEST['q'])) {
            $value = trim($_REQUEST['q']);
            if (!empty($value)) {
                $data = $this->Model("Products")->SearchProduct($value);
            } else $data = [];
            $search = $value;
            $this->View("SearchResult", [
                "result" => $data,
                "search" => $search
            ]);
        } else $this->View("Error");
    }
}
