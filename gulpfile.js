const gulp = require( 'gulp' );
const rename = require( 'gulp-rename' );
const sass = require( 'gulp-sass' );
const autoprefixer = require( 'gulp-autoprefixer' );
const sourcemaps = require( 'gulp-sourcemaps' );

const webpack = require('webpack');
const webpackStream = require('webpack-stream');

const styleSRC = 'assets/css/style.scss'; // Path to main .scss file.
const styleDestination = './assets/css/'; // Path to place the compiled CSS file.
const styleWatch = 'assets/css/**/*.scss'; // Path to all *.scss files inside css folder and inside them.

const styleeditorSRC = 'assets/css/style-editor.scss'; // Path to main .scss file.
const styleeditorDestination = './'; // Path to place the compiled CSS file.
const styleeditorWatch = 'assets/css/style-editor.scss'; // Path to all *.scss files inside css folder and inside them.

const jsSRC = 'assets/js/script.js'; // Path to JS scripts folder.
const jsDestination = './assets/js/'; // Path to place the compiled JS scripts file.
const jsWatch = 'assets/js/script.js'; // Path to all JS files.

gulp.task( 'styles', () => {
    return gulp.src( styleSRC )
        .pipe( sourcemaps.init() )
        .pipe( sass( {
            errLogToConsole: true,
            outputStyle: 'compact'
        } ) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer( {
            browsers: browsers_list,
            cascade: false
        } ) )
        // .pipe( rename( { suffix: '.min' } ) )
        .pipe( sourcemaps.write( './' ) )
        .pipe( gulp.dest( styleDestination ) );
} );

gulp.task( 'style-editor', () => {
    return gulp.src( styleeditorSRC )
        .pipe( sourcemaps.init() )
        .pipe( sass( {
            errLogToConsole: true,
            outputStyle: 'compact'
        } ) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer( {
            browsers: browsers_list,
            cascade: false
        } ) )
        // .pipe( rename( { suffix: '.min' } ) )
        .pipe( sourcemaps.write( './' ) )
        .pipe( gulp.dest( styleeditorDestination ) );
} );

gulp.task( 'scripts', () => {
    return gulp.src( jsSRC )
        .pipe( webpackStream( {
            module: {
                rules: [
                  	{
						test: /\.(js|jsx)$/,
						exclude: /(node_modules)/,
						loader: 'ify-loader',
                  	},
                ],
			},
			mode: 'development',
            output: {
                filename: 'script.min.js'
            }
        } ), webpack )
        .pipe( gulp.dest( jsDestination ) );
});

gulp.task (
	'default',
	gulp.parallel( 'styles', 'style-editor', 'scripts', () => {
        gulp.watch( styleWatch, gulp.series( 'styles' ) );
        gulp.watch( styleeditorWatch, gulp.series( 'style-editor' ) );
		gulp.watch( jsWatch, gulp.series( 'scripts' ) );
	} )
);

var browsers_list = [
    'last 2 version',
    '> 1%',
    'ie >= 11',
    'last 1 Android versions',
    'last 1 ChromeAndroid versions',
    'last 2 Chrome versions',
    'last 2 Firefox versions',
    'last 2 Safari versions',
    'last 2 iOS versions',
    'last 2 Edge versions',
    'last 2 Opera versions'
];