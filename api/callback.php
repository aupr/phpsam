<?php




    httpRESTMethod::get(function ($request){
        return "iam from get fnc: $request";
    });

    //echo file_get_contents('php://input');

    echo '<br><br><br>';

    class A{
        public $name;
        public $age;
    }


    class B{
        public $type;
        public $size;
    }

    $AO = new A();
    $AO->name = "Aman";
    $AO->age = 26;

    $BO = new B();
    $BO->size = 10;
    $BO->type = $AO;

    $CO = array($BO, $BO, $BO);

    echo json_encode($CO);


    echo "<pre>";

    var_dump($dec = json_decode('[{"type":{"name":"Aman","age":26},"size":10},{"type":{"name":"Aman","age":26},"size":10},{"type":{"name":"Aman","age":26},"size":10}]'));
    echo "decoded json objects\n";
    echo $dec[0]->type->name;

    echo "\n";

    var_dump($_SERVER);
