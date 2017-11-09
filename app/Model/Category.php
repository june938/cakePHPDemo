<?php

class Category extends AppModel {

    public $actsAs = array('Containable');
    public $hasMany = [
        'CatDescription' => array(
            'className' => 'CatDescription',
            'foreignKey' => 'cat_id',
            'conditions' => array('CatDescription.status' => '1'),
            'dependent' => true
        )
    ];
    public $hasOne = [
        'CatDescriptionEn' => array(
            'className' => 'CatDescription',
            'foreignKey' => 'cat_id',
            'conditions' => array('CatDescriptionEn.status' => '1', 'CatDescriptionEn.lang' => 'en'),
            'dependent' => true
        )
    ];
    public $belongsTo = array(
        'CategoryParent' => array(
            'className' => 'CategoryParent',
            'foreignKey' => 'parent_id'
        )
    );

}
