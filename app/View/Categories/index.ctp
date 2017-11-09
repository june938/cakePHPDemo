
<h2>Categories</h1>

<?php  echo $this->Html->link(
                               'Create', array('controller' => 'categories', 'action' => 'create' ), array('class'=>'btn btn-primary')); ?>
<div class="form-group" style="margin-top: 30px;">
    <form method="POST">
        <input type="text" name="search" title="search" size="50" placeholder="Search Category Name in English"/> <input type="submit" value="Search">
    </form>
</div>


<?php if (isset($cat) && !empty($cat)) {?>
<div class="box box-primary">  
    <div class="box-body">
        <table class="table table-bordered table-hover dataTable">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Status</th>
            <th>Action</th>
            </thead>
	<?php foreach($cat as $eachrow) {?>
            <?php if(!empty($eachrow['CatDescription'])) {?>
            <tr>

                <td><?=$eachrow['Category']['id']?></td>
                <td><?=$eachrow['CatDescription'][0]['title']?></td>
                <td><?= isset($eachrow['CategoryParent']['CatDescription'][0]['title'])? $eachrow['CategoryParent']['CatDescription'][0]['title']: "" ?></td>
                <td><?php if($eachrow['Category']['status'] == 1) {echo 'Active';} else {echo 'Inactive';}?></td>
                <td>
 <?php
                       echo $this->Html->link(
                               'Edit', array('controller' => 'categories', 'action' => 'edit', $eachrow['Category']['id']),                                       array('class'=>'btn btn-primary','style'=>'margin-right:10px')); 
                       echo $this->Html->link(
                               'Delete',
                               array('controller' => 'categories', 'action' => 'delete', $eachrow['Category']['id']),
                               array('confirm'=>"Confirm to delete？", 'class'=>'btn btn-warning')); ?>
                </td>
            </tr>
        <?php }}?>
        </table>
<?php } ?>
    </div>
</div>

