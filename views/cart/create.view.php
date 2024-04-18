<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="container mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="col-span-full">

                    <div id="searchResults" class="search-results">
                        <ul class="ebooks-list">
                            <?php $total_cost = 0 ?>

                            <?php foreach ($cart as $item) : ?>
                                <?php $total_cost += $item['cost'] ?>

                                <li class="cart-item flex justify-between items-center border-b border-gray-300 py-4">
                                    <div class="flex items-center">
                                        <div class="cart-item-image mr-4 object-cover rounded">
                                            <?php
                                            $ebook_id = $item['ebook_id'];
                                            require base_path('Http/controllers/upload/display.php');
                                            ?>
                                        </div>
                                        <div class="cart-item-details">
                                            <p class="cart-item-title">
                                                <a href="/ebook?id=<?= $item['ebook_id'] ?>" class="ebook-link"><?= $item['ebook_title'] ?></a>
                                            </p>
                                            <p class="cart-item-price">Preço: R$<?= number_format($item['cost'], 2) ?></p>
                                        </div>
                                    </div>
                                    <div class="cart-item-actions">
                                        <form method="POST" action="/cart/update" class="mr-2">
                                            <input type="hidden" name="ebook_id" value="<?= $item['ebook_id'] ?>">
                                            <input type="number" id="quantity" name="quantity" min="1" value="<?= $item['quantity'] ?>" class="quantity-input mr-2 text-sm border border-gray-300 rounded-md px-2 py-1">
                                            <button type="submit" class="add-to-cart-btn py-1 px-2 text-sm">Atualizar</button>
                                        </form>
                                        <form method="POST" action="/cart/remove">
                                            <input type="hidden" name="ebook_id" value="<?= $item['ebook_id'] ?>">

                                            <button type="submit" class="remove-cart-btn py-1 px-2 text-sm text-base bg-red-600 hover:bg-red-700">Remover</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="flex justify-end mt-6">
                        <p class="ebook-title font-semibold text-lg">Valor Total: R$<?= number_format($total_cost, 2) ?></p>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="/ebooks" class="text-blue-500 hover:underline mr-4">Continuar Comprando</a>
                        <a href="#" class="checkout-btn bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md">Finalizar Compra</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>