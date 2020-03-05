var gulp = require('gulp'),
    path = require('path'),
    del = require('del'),
    $ = require('gulp-load-plugins')(),
    gulpsync = $.sync(gulp),
    browserSync = require('browser-sync'),
    reload = browserSync.reload;

// ignore everything that begins with underscore
var ignored_files = '!**/_*.*';

//  Edit here the modules scripts
//  that will be used in the pages
var pageScripts = [
    'js/modules/utils.js',
    'js/modules/play-animations.js',
    'js/pages.init.js'
];

var jadeCompileAll = false;

// SOURCES CONFIG
var source = {
    scripts: {
        app: ['js/modules/*.js', 'js/app.init.js'],
        pages: pageScripts
    },
    templates: {
        app: {
            files: ['jade/*.jade', '!jade/layout/*', '!jade/partials/*'],
            watch: ['jade/**/*.jade', '!jade/pages/*', '!jade/layout/page-layout.jade']
        },
        pages: {
            files: ['jade/pages/*'],
            watch: ['jade/pages/*', 'jade/layout/page-layout.jade']
        }
    },
    styles: {
        app: {
            main: ['less/app.less', '!less/pages/*.less', '!less/themes/*.less'],
            dir: 'less',
            watch: ['less/*.less', 'less/**/*.less', '!less/pages/*.less', '!less/themes/*.less']
        },
        themes: {
            main: ['less/themes/*.less', ignored_files],
            dir: 'less/themes',
            watch: ['less/themes/*.less']
        },
        pages: {
            main: ['less/pages/*.less', ignored_files],
            dir: 'less/pages',
            watch: ['less/pages/*.less']
        }
    },
    bootstrap: {
        main: 'less/bootstrap/bootstrap.less',
        dir: 'less/bootstrap',
        watch: ['less/bootstrap/*.less']
    }
};

// BUILD TARGET CONFIG
var build = {
    scripts: {
        app: {
            main: 'app.js',
            dir: '../app/js'
        },
        pages: {
            main: 'pages.js',
            dir: '../app/js'
        }
    },
    styles: '../app/css',
    templates: {
        app: '..',
        pages: '../pages'
    }
};


// Error handler
function handleError(err) {
    console.log(err.toString());
    this.emit('end');
}


//---------------
// TASKS
//---------------


// JS APP
gulp.task('scripts:app', function() {
    // Minify and copy all JavaScript (except vendor scripts)
    return gulp.src(source.scripts.app)
        //.pipe($.uglify())  /* UNCOMMENT TO MINIFY * /
        .pipe($.concat(build.scripts.app.main))
        .pipe(gulp.dest(build.scripts.app.dir))
        .pipe(reload({
            stream: true
        }));
});

// JS PAGES
gulp.task('scripts:pages', function() {
    // Minify and copy all JavaScript (except vendor scripts)
    return gulp.src(source.scripts.pages)
        //.pipe($.uglify())  /* UNCOMMENT TO MINIFY * /
        .pipe($.concat(build.scripts.pages.main))
        .pipe(gulp.dest(build.scripts.pages.dir))
        .pipe(reload({
            stream: true
        }));
});

// LESS
gulp.task('styles:app', function() {
    return gulp.src(source.styles.app.main)
        .pipe($.less({
            paths: [source.styles.app.dir]
        }))
        .on("error", handleError)
        .pipe(gulp.dest(build.styles))
        .pipe(reload({
            stream: true
        }));
});

// LESS PAGES
gulp.task('styles:pages', function() {
    return gulp.src(source.styles.pages.main)
        .pipe($.less({
            paths: [source.styles.pages.dir]
        }))
        .on("error", handleError)
        .pipe(gulp.dest(build.styles))
        .pipe(reload({
            stream: true
        }));
});

// LESS THEMES
gulp.task('styles:themes', function() {
    return gulp.src(source.styles.themes.main)
        .pipe($.less({
            paths: [source.styles.themes.dir]
        }))
        .on("error", handleError)
        .pipe(gulp.dest(build.styles))
        .pipe(reload({
            stream: true
        }));
});

// BOOSTRAP
gulp.task('bootstrap', function() {
    return gulp.src(source.bootstrap.main)
        .pipe($.less({
            paths: [source.bootstrap.dir]
        }))
        .on("error", handleError)
        .pipe(gulp.dest(build.styles))
        .pipe(reload({
            stream: true
        }));
});

// JADE
gulp.task('templates:app', function() {
    return gulp.src(source.templates.app.files)
        .pipe($.if( !jadeCompileAll, $.changed(build.templates.app, {
            extension: '.html'
            })
        ))
        .pipe($.jade())
        .on("error", handleError)
        .pipe($.htmlPrettify({
            indent_char: ' ',
            indent_size: 3,
            unformatted: ['a', 'sub', 'sup', 'b', 'i', 'u']
        }))
        .pipe(gulp.dest(build.templates.app))
        .pipe(reload({
            stream: true
        }));;
});

// JADE
gulp.task('templates:pages', function() {
    return gulp.src(source.templates.pages.files)
        .pipe($.if( !jadeCompileAll, $.changed(build.templates.pages, {
            extension: '.html'
            })
        ))
        .pipe($.jade())
        .on("error", handleError)
        .pipe($.htmlPrettify({
            indent_char: ' ',
            indent_size: 3,
            unformatted: ['a', 'sub', 'sup', 'b', 'i', 'u']
        }))
        .pipe(gulp.dest(build.templates.pages))
        .pipe(reload({
            stream: true
        }));;
});


//---------------
// WATCH
//---------------

// Rerun the task when a file changes
gulp.task('watch', function() {

    gulp.watch(source.scripts.app, ['scripts:app']);
    gulp.watch(source.scripts.pages, ['scripts:pages']);
    gulp.watch(source.styles.app.watch, ['styles:app']);
    gulp.watch(source.styles.themes.watch, ['styles:themes']);
    gulp.watch(source.styles.pages.watch, ['styles:pages']);
    gulp.watch(source.bootstrap.watch, ['bootstrap']);
    gulp.watch(source.templates.pages.watch, ['templates:pages'])
        .on('change', checkJadeCompileMoe);
    gulp.watch(source.templates.app.watch, ['templates:app'])
        .on('change', checkJadeCompileMoe);

});

// Serve files with auto reaload
gulp.task('browsersync', function() {
    log('Starting BrowserSync..');

    browserSync({
        notify: false,
        server: {
            baseDir: '..'
        }
    });

});

//---------------
// CLEAN
//---------------

// Remove all files from the build paths
gulp.task('clean', function(done) {
    var delconfig = [].concat(
        build.scripts.app.dir,
        build.scripts.pages.dir,
        build.styles,
        build.templates.pages,
        build.templates.app + '/*.html'
    );

    log('Cleaning: ' + $.util.colors.blue(delconfig));
    // force: clean files outside current directory
    del(delconfig, {
        force: true
    }, done);
});

//---------------
// DEFAULT TASK
//---------------

gulp.task('default', gulpsync.sync([
    'scripts:app',
    'scripts:pages',
    'bootstrap',
    'styles:app',
    'styles:themes',
    'styles:pages',
    'templates:app',
    'templates:pages',
    'watch'
]));

gulp.task('serve', gulpsync.sync([
    'default',
    'browsersync'
]), done);


function done() {

    log('************');
    log('* All Done * You can start editing your code, BrowserSync will update your browser after any change..');
    log('************');

}

// log to console
function log(msg) {
    $.util.log($.util.colors.blue(msg));
}

function checkJadeCompileMoe(file) {
    // If file is partial or layout set a flag to recompile all
    jadeCompileAll = false;
    var fname = path.dirname(file.path);
    if (fname.indexOf('partials') > -1 || fname.indexOf('layout') > -1)
        jadeCompileAll = true;
}