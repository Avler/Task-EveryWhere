<?php get_header(); ?>

<div class="container mx-auto my-10 flex flex-col justify-center items-center"">
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