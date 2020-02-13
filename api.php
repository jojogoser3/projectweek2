<?php

class Functions
{

    private $ch;

    public function run(){
        $this->connect();
        $this->category();
        $this->random();
    }

    public function connect()
    {

        function __construct()
        {
            $this->output = $output;
            $this->ch = $ch;
        }

        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://paulvandillen.cb04.shopworks-clients.nl/sales-channel-api/v1/category");
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ["sw-access-key:SWSCU1G0RG4YWLRXC1VKZUVQVW"]);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        $myApiData = curl_exec($this->ch);
        curl_close($this->ch);
        $this->output = json_decode($myApiData, true);

       

    }

    public function category()
    {

        $category = array();

        echo "<pre>";
        foreach ($this->output['data'] as $value) {

            $category = $value['translated']['name'];

            echo '<a href="product.php">' . $category . '</a><br>';

        }
        
    }

    public function random()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://paulvandillen.cb04.shopworks-clients.nl/sales-channel-api/v1/product");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["sw-access-key:SWSCU1G0RG4YWLRXC1VKZUVQVW"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $myApiData = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($myApiData, true);
        
        $id_list = [];
        
        echo "<pre>";
        
        foreach ($output['data'] as $value) {
            array_push($id_list, $value['id']);
        }
        
        $random_product_id = $id_list [random_int(0, count($id_list) -1)];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://paulvandillen.cb04.shopworks-clients.nl/sales-channel-api/v1/product/" . $random_product_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["sw-access-key:SWSCU1G0RG4YWLRXC1VKZUVQVW"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $myApiData = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($myApiData, true);
        
        var_dump($output);
    }

}

$category = new Functions;
$category->run();
