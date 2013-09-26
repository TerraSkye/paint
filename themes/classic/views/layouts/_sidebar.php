<div class="right-login">
    <h2>Menu</h2>

    <?php $this->widget('application.widgets.bootstrap.TbMenu', array(
    'type'=>'list', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>true, // whether this is a stacked menu
    'items'=>$this->menu
)); ?>

</div>