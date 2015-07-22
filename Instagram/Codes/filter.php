<?php

class filter {
    private $filterId;
    private $filterName;
    private $strength = 100;

    public function setFilterId($id) {
        $this->filterId = $id;
    }

    public function setFilterName($name) {
        $this->filterName = $name;
    }

    function getFilterStrength() {
        return $this->strength ."\n". $this->filterId ."\n". $this->filterName ;
    }
}

$_fp = fopen("php://stdin","r");
$f = new filter;
$f->setFilterName('Crema');
$f->setFilterId(1);
echo $f->getFilterStrength();
?>

