<div id="content3">
<div class="list">
<?php foreach ($products as $product): ?>
    <a class="item item-thumbnail-left" href="#">
      <img src="<?php echo $this->escapeHtml("/salon/".$id."/".$product->getProdphoto1()); ?>">
      <h2><?php echo $this->escapeHtml($product->getProdtitle()); ?></h2>
      <p style="color:red"><?php echo $this->escapeHtml($product->getProdoriginal()); ?></p>
    </a>
<?php endforeach; ?>
</div>
</div>