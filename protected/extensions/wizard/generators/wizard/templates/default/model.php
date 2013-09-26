<?php
$attributes = array();
sort($fields);
foreach ($fields as $field) {
	$attributes[$field] = array(
		$field,
		substr($field, 0, 1) == "_" ? substr($field, 1) : $field,
		substr($field, 0, 1) == "_" ? "private" : "public",
		((strpos($field, '_date') !== false) ? "CDateTime" : (strpos($field, '_id') !== false ? "integer" : "string")),
	);

}

?>


<?php echo "<?php\n"; ?>
/**
* Created by Yii Wizard Generator.
* Date: <?php echo date('Y-m-d') . "\n" ?>
*
<?php foreach ($attributes as $attribute) {
	list($field, $alias, $access, $type) = $attribute;
	echo "* @property $type $field\n";
}?>
**/


class <?php echo substr($action, 0, 1) == "_" ? ucfirst(substr($action, 1)) : ucfirst($action) ?> extends CFormModel{

<?php foreach ($attributes as $attribute) {
	list($field, $alias, $access, $type) = $attribute;
	echo "\t$access $$field \n";
}?>


	public function rules(){
		//todo this is a method stub.
		return CMap::mergeArray(parent::rules(), array(
		array('<?php foreach ($attributes as $attribute) {
			list(, $alias) = $attribute;
			echo "$alias, ";
		}?>','safe'),
		);
	}

	public function attributeNames(){
		$class = new ReflectionClass(get_class($this));
		$names = array();

		foreach ($class->getProperties() as $property) {
			$name = $property->getName();
			$method = ucfirst(substr($name, 1));
			if ($property->isPrivate() && !$property->isStatic()) {
				if (substr_count($name, '_', 0, 1) && $class->hasMethod("get$method") && $class->hasMethod("set$method"))
					$names[] = substr($name, 1);
			}
		}
		return CMap::mergeArray(parent::attributeNames(), $names);
	}

	public function attributeLabels(){
		$class = new ReflectionClass(get_class($this));
		$names = array();

		foreach ($class->getProperties() as $property) {
			$name = $property->getName();
			$method = ucfirst(substr($name, 1));
			if ($property->isPrivate() && !$property->isStatic()) {
				if (substr_count($name, '_', 0, 1) && $class->hasMethod("get$method") && $class->hasMethod("set$method"))
					$names[substr($name, 1)] = Yii::t('text',substr($name, 1));
			}else if($property->isPublic() && !$property->isStatic())
				$names[$name]=Yii::t('text',$name);
		}
		return $names;
	}

<?php foreach ($attributes as $attribute) {
	list($field, $alias, $access, $type) = $attribute;
	if ($access !== "private")
		continue;
	?>

	public function set<?php echo ucfirst($alias) ?>($value){
		$this-><? echo $field ?> = $value;
	}

	public function get<?php echo ucfirst($alias) ?>(){
		return $this-><? echo $field ?>;
	}
<?php } ?>
}