<?php

class CategoryParent extends AppModel {

    public $actsAs = array('Containable');
    public $useTable = 'categories';
    public $hasMany = [
        'CatDescription' => array(
            'className' => 'CatDescription',
            'foreignKey' => 'cat_id',
            'conditions' => array('CatDescription.status' => '1','CatDescription.lang' => 'en' ),
            'dependent' => true
        )
    ];

}
