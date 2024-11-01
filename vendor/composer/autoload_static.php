<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0845a37dc46d14b939ac3ea41181ef5
{
    public static $classMap = array (
        'ComposerAutoloaderInite0845a37dc46d14b939ac3ea41181ef5' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInite0845a37dc46d14b939ac3ea41181ef5' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Wptrove' => __DIR__ . '/../..' . '/includes/class-wptrove.php',
        'Wptrove_Activator' => __DIR__ . '/../..' . '/includes/class-wptrove-activator.php',
        'Wptrove_Admin' => __DIR__ . '/../..' . '/admin/class-wptrove-admin.php',
        'Wptrove_Blocks' => __DIR__ . '/../..' . '/admin/class-wptrove-blocks.php',
        'Wptrove_Deactivator' => __DIR__ . '/../..' . '/includes/class-wptrove-deactivator.php',
        'Wptrove_Fetch_Posts' => __DIR__ . '/../..' . '/admin/partials/rest/v1/class-wptrove-fetch-posts.php',
        'Wptrove_I18n' => __DIR__ . '/../..' . '/includes/class-wptrove-i18n.php',
        'Wptrove_Loader' => __DIR__ . '/../..' . '/includes/class-wptrove-loader.php',
        'Wptrove_Moderate_Posts' => __DIR__ . '/../..' . '/admin/partials/rest/v1/class-wptrove-moderate-posts.php',
        'Wptrove_Post_Types' => __DIR__ . '/../..' . '/admin/class-wptrove-post-types.php',
        'Wptrove_Public' => __DIR__ . '/../..' . '/public/class-wptrove-public.php',
        'Wptrove_REST_Aux' => __DIR__ . '/../..' . '/admin/partials/rest/v1/class-wptrove-rest-aux.php',
        'Wptrove_REST_V1' => __DIR__ . '/../..' . '/admin/class-wptrove-rest-v1.php',
        'Wptrove_Settings_Control' => __DIR__ . '/../..' . '/admin/partials/settings/class-wptrove-settings-control.php',
        'Wptrove_Testimonial_Blocks' => __DIR__ . '/../..' . '/admin/features/testimonials/class-wptrove-testimonial-blocks.php',
        'Wptrove_Testimonials' => __DIR__ . '/../..' . '/admin/partials/rest/v1/testimonials/class-wptrove-testimonials.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite0845a37dc46d14b939ac3ea41181ef5::$classMap;

        }, null, ClassLoader::class);
    }
}
