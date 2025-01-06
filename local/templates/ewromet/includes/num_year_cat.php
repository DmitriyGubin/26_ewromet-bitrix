<?php 

$nums = Return_All_Fields_Props(
    Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
    Array()
)[0]['props'];

//debug($nums);

?>

<div class="numbers <?= $class; ?>">
	<div class="number_item first">
		<div class="about_num">Наименований в каталоге</div>
		<div class="num dark_blue"><?= $nums['ITEMS']['VALUE']; ?></div>
	</div>

	<div class="number_item">
		<div class="about_num">Год основания компани</div>
		<div class="num"><?= $nums['YEAR']['VALUE']; ?></div>
	</div>
</div> 