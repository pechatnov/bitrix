const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const gulpIf = require('gulp-if');

const isProd = process.env.NODE_ENV === 'production';

const paths = {
  scss: 'local/templates/main/src/scss/**/*.scss',
  js: 'local/templates/main/src/js/**/*.js',
  cssDest: 'local/templates/main/build',
  jsDest: 'local/templates/main/build'
};

function styles() {
  return gulp
    .src('local/templates/main/src/scss/app.scss')
    .pipe(gulpIf(!isProd, sourcemaps.init()))
    .pipe(
      sass({
        outputStyle: isProd ? 'compressed' : 'expanded'
      }).on('error', sass.logError)
    )
    .pipe(concat('app.css'))
    .pipe(gulpIf(!isProd, sourcemaps.write('.')))
    .pipe(gulp.dest(paths.cssDest));
}

function scripts() {
  return gulp
    .src(['local/templates/main/src/js/components/**/*.js', 'local/templates/main/src/js/app.js'])
    .pipe(gulpIf(!isProd, sourcemaps.init()))
    .pipe(
      babel({
        presets: ['@babel/preset-env']
      })
    )
    .pipe(concat('app.js'))
    .pipe(gulpIf(isProd, uglify()))
    .pipe(gulpIf(!isProd, sourcemaps.write('.')))
    .pipe(gulp.dest(paths.jsDest));
}

function watchFiles() {
  gulp.watch(paths.scss, styles);
  gulp.watch(paths.js, scripts);
}

const build = gulp.series(gulp.parallel(styles, scripts));

exports.styles = styles;
exports.scripts = scripts;
exports.watch = watchFiles;
exports.build = build;
exports.default = build;

