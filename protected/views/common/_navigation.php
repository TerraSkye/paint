<?php /**
 * @var $this CController
 */
?>
	<div class="navbar">
		<div class="navbar-inner">
			<?php $this->widget('common.widgets.bootstrap.TbMenu', array(
				'items' => $this->menu
			)); ?>
			<?php $this->widget('common.widgets.bootstrap.TbMenu', array(
				'htmlOptions'=>array('class'=>'pull-right'),
				'items' => array(
					array(
						'label' => Yii::t('text', 'Help'),
						'url' => $this->createAbsoluteUrl('contact/help'),
						'active' => (strpos($this->route, 'contact/help')) !== false,
					),
				)
			)); ?>
		</div>
	</div>


<?php $this->widget('common.widgets.bootstrap.TbBreadcrumbs',
	array('links' => $this->breadcrumbs,
		'homeLink' => CHtml::link(Yii::t('text', 'Profiel'),  'profile/contact/index'),
	)
); ?>