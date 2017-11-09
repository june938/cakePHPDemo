<?php 
class CatDescription extends AppModel { 

	public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'cat_id'
        )
    );
} 
