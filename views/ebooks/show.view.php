<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="col-span-full">
                    <div id="image-container" class="h-18 w-18">
                        <?php
                        $ebook_id = $ebook['id'];
                        require_once base_path('Http/controllers/upload/display.php');
                        ?>
                    </div>
                    <p class="ebook-author mt-6">
                        <?= 'Autor: ' . htmlspecialchars($ebook['author']) ?>
                    </p>
                    <p class="mt-6">
                        <?= 'Descrição: ' . htmlspecialchars($ebook['description']) ?>
                    </p>
                    <p class="ebook-price mt-6">
                        <?= 'Preço: R$' . number_format($ebook['price'], 2) ?>
                    </p>
                    <form method="POST" action="/cart">
                        <input type="hidden" name="ebook_id" value="<?= $ebook['id'] ?>">
                        <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                        <button type="submit" class="add-to-cart-btn">Adicionar ao carrinho</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>