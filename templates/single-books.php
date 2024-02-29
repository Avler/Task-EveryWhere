<?php get_header(); ?>

<div class="flex flex-col items-center justify-center my-10">
    <a href="<?php echo get_post_type_archive_link('books'); ?>" class="mt-4 text-indigo-600 hover:text-indigo-800 transition duration-300 hover:text-indigo-600">
    <button id="backBookButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Powrót do archiwum książek
        </button> 
    </a>
    <div class=" flex items-center justify-center bg-white rounded-lg shadow-lg">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="flex flex-col  md:flex-row items-center md:items-start gap-4 p-4">
                <?php if ( has_post_thumbnail() ) {
                    echo '<div class="flex-shrink-0">';
                    the_post_thumbnail('medium', ['class' => 'rounded-lg shadow-lg']);
                    echo '</div>';
                } ?>
            </div>
            <div class="p-4 ">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h1>
                <p class="text-xl text-gray-700 mb-2"><strong class="font-semibold">Autor:</strong> <?php the_field('autor_ksiazki'); ?></p>
                <p class="text-lg text-gray-600 mb-2"><strong class="font-semibold">Rok wydania:</strong> <?php the_field('rok_wydania'); ?></p>
                <p class="text-lg text-gray-600"><strong class="font-semibold">Gatunek:</strong> <?php the_field('gatunek'); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="p-4 prose prose-sm sm:prose-base max-w-[400px] lg:prose-lg">
        <h2 class="p-4 text-2xl text-gray-800">Krótki opis książki </h2>
                <?php the_content(); ?>
    </div>
</div>


<?php get_footer(); ?>