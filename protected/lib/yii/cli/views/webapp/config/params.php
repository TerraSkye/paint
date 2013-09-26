<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/../../../common/config/params.php'),
		array(
        'siteType'=>'Contest',
        'label'=>'Soty2012',
	)
);
