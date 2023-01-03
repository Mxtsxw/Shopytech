<?php $this->_t = 'Shopytech - '; ?>



<div class="card">
    <form action="/">
        <!-- Default checkbox -->
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
        <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
        </div>

        <!-- Checked checkbox -->
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked/>
        <label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
        </div>
    </form>
</div>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach($categories as $category) : ?>       
    <?php $this->_t .= $category->name(); ?>
    <?php endforeach; ?>
</div>