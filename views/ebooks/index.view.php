<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main class="container mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <form id="searchForm" method="GET" action="/ebooks/search" class="flex items-center mb-6">
                <input type="text" id="searchQuery" name="query" placeholder="Search..." class="border border-gray-300 rounded-md py-2 px-4 mr-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Search</button>
            </form>

            <div id="searchResults" class="search-results"></div>

            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($ebooks as $ebook) : ?>
                    <li class="ebook-item border border-gray-300 rounded-lg shadow-md">
                        <div class="image-container overflow-hidden">
                            <?php
                            $ebook_id = $ebook['id'];
                            require base_path('Http/controllers/upload/display.php');
                            ?>
                        </div>
                        <div class="p-4 ebook-details">
                            <h3 class="ebook-title text-lg font-semibold mb-2">
                                <a href="/ebook?id=<?= $ebook['id'] ?>" class="ebook-link"><?= htmlspecialchars($ebook['title']) ?></a>
                            </h3>

                        </div>
                        <div id="gonnaBeOnTheBottom">
                            <div class="ebook-details mx-4">
                                <p class="ebook-author mb-2"><?= 'Autor: ' . htmlspecialchars($ebook['author']) ?></p>
                                <p class="ebook-price"><?= 'Preço: R$' . number_format($ebook['price'], 2) ?></p>

                            </div>
                        </div>

                        <div class="ebook-actions p-4">
                            <form method="POST" action="/cart" class="flex items-center">
                                <input type="hidden" name="ebook_id" value="<?= $ebook['id'] ?>">
                                <input type="number" name="quantity" value="1" min="1" class="quantity-input border border-gray-300 rounded-md px-2 py-1 mr-2 w-16">
                                <button type="submit" class="add-to-cart-btn bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var query = $('#searchQuery').val(); // Get the search query from the input field

            $.ajax({
                url: 'http://localhost:3000/ebooks/search', // URL of the server-side script to handle the search
                type: 'GET',
                data: {
                    query: query
                }, // Data to be sent to the server
                success: function(response) {
                    // Handle the response from the server
                    $('#searchResults').html(response); // Update the search results container with the response
                },
                error: function(xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<?php require base_path('views/partials/footer.php') ?>