<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/params.php'),
	array(
		'debug' => true,
		'contest' => 'soty2012'
	)
);
