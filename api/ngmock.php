<?php

class Hero {
public $id;
public $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

$Heroes = array();

for ($i = 0; $i<10; $i++) {
    $hero = new Hero();
    $hero->setId(10+$i);
    $hero->setName("name_".$i);
    array_push($Heroes,$hero);
}

echo json_encode($Heroes);