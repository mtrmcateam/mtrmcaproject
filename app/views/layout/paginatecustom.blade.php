<!--<div class="pagination">
            <ul>
              <li class="previous"><a href="{{ $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><i class="icon left arrow"></i> Previous</a></li>
              @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
				<li><a href="{{ $paginator->getUrl($i) }}" class="item{{ ($paginator->getCurrentPage() == $i) ? ' active' : '' }}">{{ $i }}</a></li>
				@endfor
              <li class="next"><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}"> Next <i class="icon right arrow"></i></a></li>
            </ul>
</div>
-->

<center class="uk-margin-top">
	<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
	?>
 	<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="uk-pagination">
	<?php echo $presenter->render(); ?>
	</ul>
	<?php endif; ?>
</center>




