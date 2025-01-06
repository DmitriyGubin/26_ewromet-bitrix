<?php 
$partners = Return_All_Fields_Props(
	Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y"),
	Array()
);
  //debug($partners);
?>

<div class="company_box slider grid">
	<?php foreach ($partners as $par_item): ?>
		<div class="company_item">
			<img src="<?= CFile::GetPath($par_item['fields']['PREVIEW_PICTURE']); ?>">
		</div>
	<?php endforeach; ?>
</div>

<script type="text/javascript">
	
	if(screen.width < 750)
	{
		$('.company_box.slider').slick({
			dots: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
			prevArrow: '<div class="prev-photo"><svg width="11" height="21" viewBox="0 0 11 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 1L1 10.5L10.5 20" stroke="#121419"/></svg></div>',
			nextArrow: '<div class="next-photo"><svg width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L10.5 10.5L1 20" stroke="#121419"/></svg></div>'
		});
	}
	
</script>