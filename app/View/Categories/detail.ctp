<section class="content-header">
    <h1 style="margin-bottom: 40px;">
        <?php if(isset($Cat_Detail)){echo "Edit"; } else{echo "Create";}?> Category
    </h1>
</section>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Basic Information</h3>
    </div>    
<?php
echo $this->Form->create("Category"); ?>
    <div class="box-body">

<?=$this->Form->hidden("Category.id", array('value'=>isset($Cat_Detail['Category']['id'])? $Cat_Detail['Category']['id'] : "" ));?>

        <div class="form-group"> 
            <label class="col-sm-2 control-label">Parent Category</label>     
<?=$this->Form->select("Category.parent_id",$Cat_list, array('value'=>isset($Cat_Detail['Category']['parent_id'])? $Cat_Detail['Category']['parent_id'] : "" ,"style" => "width:40%",'class'=>"form-control")); ?>
        </div>   
        <div class="form-group">        
            <label class="col-sm-2 control-label">Status</label>     
<?=$this->Form->select("Category.status",array('1'=>'Active','0'=>'Inactive'),array('class'=>"form-control","style" => "width:20%" ,'label'=>false,'value'=>isset($Cat_Detail['Category']['status'])? $Cat_Detail['Category']['status'] : ""));?>
        </div>  
    </div>
</div>

<?php
$count_lang = 0;
foreach($lang_list as $each_lang){ ?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?='Language: '.$each_lang;?></h3>
    </div>
    <div class="box-body">
<?php
    echo $this->Form->hidden("CatDescription.".$count_lang.".id", array('value'=>isset($Cat_Detail['CatDescription'][$each_lang])? $Cat_Detail['CatDescription'][$each_lang]['id'] : "" ));
    echo $this->Form->hidden("CatDescription.".$count_lang.".lang", array('value'=>$each_lang));
?>
        <div class="form-group"> 
            <label class="col-sm-2 control-label">Title</label>     
    <?=$this->Form->input("CatDescription.".$count_lang.".title", array('value'=>isset($Cat_Detail['CatDescription'][$each_lang])? $Cat_Detail['CatDescription'][$each_lang]['title'] : "" ,'class'=>"form-control",'label'=>false)); ?>
        </div>  
        <div class="form-group"> 
            <label class="col-sm-2 control-label">Description</label>     
    <?=$this->Form->input("CatDescription.".$count_lang.".desc", array('value'=>isset($Cat_Detail['CatDescription'][$each_lang])? $Cat_Detail['CatDescription'][$each_lang]['desc'] : "", 'class'=>"form-control",'label'=>false,'type'=>'textarea'));?>
        </div>
    <?php $count_lang++;?>
    </div> 
</div>
<?php }?>
<input type='submit' class='btn btn-primary' value='Save'>
<?php  echo $this->Html->link(
                               'Cancel', array('controller' => 'categories', 'action' => 'index' ),                                      array('class'=>'btn btn-default')); ?>
<?php echo $this->Form->end(); ?>

