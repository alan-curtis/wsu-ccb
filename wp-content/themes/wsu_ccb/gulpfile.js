'use strict';

// Array of Javascript files to concatenate and minify
var js_concat = [
  './node_modules/bootstrap/dist/js/bootstrap.min.js',
  './assets/scripts/theme.js',
  './assets/scripts/main.js',
];


//---------------------------------------------------------------------------------------------
// Load the dependencies
//---------------------------------------------------------------------------------------------
const sass = require('gulp-sass')(require('sass'));
var gulp          = require('gulp'),
    sourcemaps    = require('gulp-sourcemaps'),
    postcss       = require('gulp-postcss'),
    uglify        = require('gulp-uglify'),
    rename        = require('gulp-rename'),
    autoprefixer  = require('autoprefixer'),
    concat        = require('gulp-concat'),
    runSequence   = require('gulp4-run-sequence'),
    gutil         = require('gulp-util');


//---------------------------------------------------------------------------------------------
// TASK: sass
//---------------------------------------------------------------------------------------------
gulp.task('sass', function () {
  return gulp.src('./assets/scss/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'expanded',
      precision: 10
    }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./assets/css'));
});

//---------------------------------------------------------------------------------------------
// TASK: sass-deploy
//---------------------------------------------------------------------------------------------
gulp.task('sass-deploy', function () {
  return gulp.src('./assets/scss/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'expanded',
      precision: 10
    }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./assets/css'));
});

//---------------------------------------------------------------------------------------------
// TASK: postcss
//---------------------------------------------------------------------------------------------
gulp.task('postcss',  function () {
  return gulp.src('./assets/css/*.css')
    .pipe(sourcemaps.init())
    .pipe(postcss([autoprefixer()]))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./assets/css'));
});

//---------------------------------------------------------------------------------------------
// TASK: scripts
//---------------------------------------------------------------------------------------------
gulp.task('scripts',  function() {
  return gulp.src(js_concat)
    .pipe(concat('all.js'))
    .pipe(gulp.dest('./assets/scripts/concat'));
});

//---------------------------------------------------------------------------------------------
// TASK: uglify
//---------------------------------------------------------------------------------------------
gulp.task('uglify', function () {
  return gulp.src('./assets/scripts/concat/all.js')
    .pipe(uglify())
    //.on('error', function (err) { gutil.log(gutil.colors.red('[Error]'), err.toString()); })
    .pipe(rename({
      suffix: ".min",
      extname: ".js"
    }))
    .pipe(gulp.dest('./assets/js'));
    
});


//---------------------------------------------------------------------------------------------
// DEVELOPMENT/WATCH TASK: Run `gulp watch`
// This is the development task. It is the task you will primarily use. It will watch
// for changes in your sass files, and recompile new CSS when it sees changes. It
// will do the same for javascript files as well.
//---------------------------------------------------------------------------------------------
gulp.task('watch',  function (done) {
  // SCSS
  gulp.watch('./assets/scss/**/*.scss',
    function(done){ runSequence('sass', 'postcss')
    done();
  });
  // JS
  gulp.watch('./assets/scripts/*.js',
    function(done){ runSequence('scripts', 'uglify')
    done();
  });
  done();
});
//---------------------------------------------------------------------------------------------
// PRODUCTION TASK: Run `gulp deploy`
// This is the production task, It will clean out all of the specified directories,
// compile and minify your sass, concatencate and minify your script.
//---------------------------------------------------------------------------------------------
gulp.task('deploy',
  function(done){ runSequence('sass-deploy', 'postcss', 'scripts', 'uglify')

  done();
});
