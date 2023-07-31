
<ul class="list-checked list-checked-bg-success online-list">
	<?php if(!empty($online_users)):?>
	<?php foreach($online_users as $key => $val):?>
	<li class="list-checked-item online-list-text"><?= $val->name;?></li>
	<?php endforeach;?>
	<?php else:?>
	<li class="text-center">no users online</li>
	<?php endif;?>
</ul>