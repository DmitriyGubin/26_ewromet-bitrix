<?php 

$nums = Return_All_Fields_Props(
    Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y"),
    Array()
)[0]['props'];

?>

<div class="num_item <?= $class; ?>">
   <div class="num dark_blue"><?= $nums['ITEMS']['VALUE']; ?></div>
   <div class="about_num_item">наименований <br>
   товаров в каталоге</div>
</div>

<div class="num_item little">
   <div class="num dark_blue"><?= $nums['CLIENTS']['VALUE']; ?></div>
   <div class="about_num_item">довольных <br> клиентов</div>
</div>

<div class="num_item big">
   <div class="num"><?= $nums['CARS']['VALUE']; ?></div>
   <div class="about_num_item">отгруженных вагонов <br> металла за месяц</div>
</div>

<div class="num_item last_mobile big">
   <div class="num dark_blue"><?= $nums['AREAS']['VALUE']; ?></div>
   <div class="about_num_item">площадь производственных <br> и складских помещений</div>
</div>

<div class="num_item perse">
   <div class="num dark_blue"><?= $nums['PEOPLE']['VALUE']; ?></div>
   <div class="about_num_item">человека работает <br> в штате компании</div>
</div>

<div class="num_item little">
   <div class="num dark_blue"><?= $nums['OLD']['VALUE']; ?></div>
   <div class="about_num_item">года на рынке <br> <span>металлопроката</span></div>
</div>
