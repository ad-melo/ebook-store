<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>
            Hello, <?= $_SESSION['user']['email'] ?? 'Guest' ?>. Welcome to the Home page.
        </p>

        <div class="mt-6">
            <form action="/upload" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="ebook_id" class="block text-sm font-medium text-gray-700">Ebook ID:</label>
                    <input type="number" id="ebook_id" name="ebook_id" min="1" value="1" class="quantity-input mr-2 text-sm border border-gray-300 rounded-md px-2 py-1">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Select Image:</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full">
                </div>
                <div>
                    <input type="submit" value="Upload Image" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                </div>
            </form>
        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>