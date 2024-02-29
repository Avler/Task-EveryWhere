<?php get_header(); ?>

<div class="container mx-auto my-10 flex flex-col justify-center items-center"">
    <div class="add-book-button-container my-4">
        <button id="addBookButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Dodaj nową książkę
        </button>
    </div>
    <div class="container mx-auto p-4">
        <form action="<?php echo site_url('/books'); ?>" method="get" class="flex flex-wrap gap-4 justify-center">
            <div class="flex flex-col">
                <label for="author" class="mb-2 text-sm font-semibold text-gray-700">Autor:</label>
                <input type="text" id="author" name="author" value="<?php echo esc_attr(get_query_var('author')); ?>" class="border border-gray-300 rounded-md p-2">
            </div>
            <div class="flex flex-col">
                <label for="genre" class="mb-2 text-sm font-semibold text-gray-700">Gatunek:</label>
                <input type="text" id="genre" name="genre" value="<?php echo esc_attr(get_query_var('genre')); ?>" class="border border-gray-300 rounded-md p-2">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Filtruj</button>
            </div>
        </form>
    </div>

    <div id="addBookForm" class="hidden">
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

            <input type="hidden" name="action" value="add_book">
            <input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-title">
                    Tytuł książki
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-title" type="text" name="book_title" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-author">
                    Autor książki
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-author" type="text" name="book_author" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-year">
                    Rok wydania
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-year" type="number" name="book_year" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-genre">
                    Gatunek
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-genre" type="text" name="book_genre" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-description">
                    Opis książki
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-description" name="book_description" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book-cover">
                    Zdjęcie okładki
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="book-cover" type="file" name="book_cover" required>
            </div>
            <div class="flex items-center justify-center ">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Dodaj książkę
                </button>
            </div>
        </form>
    </div>
    <h1 class="text-3xl font-bold my-8">Archiwum książek</h1>
    <div class="flex flex-wrap gap-4 justify-center">
    <?php while ( have_posts() ) : the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-center items-center">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div >
                            <?php the_post_thumbnail('full', ['class' => 'max-w-[300px] max-h-[400px]']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-gray-600 text-sm">
                            Autor: <span ><?php the_field('autor_ksiazki'); ?></span><br>
                            Rok wydania: <span ><?php the_field('rok_wydania'); ?></span><br>
                            Gatunek: <span ><?php the_field('gatunek'); ?></span>
                        </div>
                    </div>
                </div>
        </a>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>